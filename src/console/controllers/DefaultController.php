<?php
/**
 * Dump Server plugin for Craft CMS 3.x
 *
 * Brings Symfony’s Var-Dump Server to Craft
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2018 Superbig
 */

namespace superbig\dumpserver\console\controllers;

use superbig\dumpserver\console\BaseController;
use superbig\dumpserver\DumpServer;

use Craft;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\VarDumper\Command\Descriptor\CliDescriptor;
use Symfony\Component\VarDumper\Command\Descriptor\DumpDescriptorInterface;
use Symfony\Component\VarDumper\Command\Descriptor\HtmlDescriptor;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;
use yii\base\InvalidArgumentException;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * Default Command
 *
 * @author    Superbig
 * @package   DumpServer
 * @since     1.0.0
 */
class DefaultController extends BaseController
{
    /** @var \Symfony\Component\VarDumper\Server\DumpServer */
    protected $server;
    protected $descriptors;
    protected $format;

    // Public Methods
    // =========================================================================

    public function options($actionID)
    {
        return ['format'];
    }

    public function init()
    {
        parent::init();

        // https://stackoverflow.com/a/51950035/293401
        $host              = DumpServer::$plugin->getSettings()->host;
        $this->server      = new \Symfony\Component\VarDumper\Server\DumpServer($host);
        $this->descriptors = [
            'cli'  => new CliDescriptor(new CliDumper()),
            'html' => new HtmlDescriptor(new HtmlDumper()),
        ];

    }

    /**
     * Handle dump-server/default console commands
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $io     = new SymfonyStyle($this->consoleInput, $this->output);
        $format = $this->format ?? 'cli';

        /** @var $descriptor DumpDescriptorInterface */
        if (!$descriptor = $this->descriptors[ $format ] ?? null) {
            throw new InvalidArgumentException(sprintf('Unsupported format "%s".', $format));
        }

        $errorIo = $io->getErrorStyle();

        $errorIo->title('Craft Var Dump Server');
        $this->server->start();
        $errorIo->success(sprintf('Server listening on %s', $this->server->getHost()));
        $errorIo->comment('Quit the server with CONTROL-C.');

        $this->server->listen(function(Data $data, array $context, int $clientId) use ($descriptor, $io) {
            $descriptor->describe($io, $data, $context, $clientId);
        });
    }
}
