<?php
/**
 * Dump Server plugin for Craft CMS 3.x
 *
 * Brings Symfony’s Var-Dump Server to Craft
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2018 Superbig
 */

namespace superbig\dumpserver\console;

use superbig\dumpserver\DumpServer;

use Craft;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;
use yii\base\InvalidArgumentException;
use yii\console\Controller;

/**
 * Default Command
 *
 * @author    Superbig
 * @package   DumpServer
 * @since     1.0.0
 */
class BaseController extends Controller
{
    /** @var \Symfony\Component\VarDumper\Server\DumpServer */
    protected $consoleInput;
    protected $output;

    // Public Methods
    // =========================================================================

    public function init()
    {
        parent::init();

        $this->consoleInput  = new StringInput('');
        $this->output = new ConsoleOutput();
    }

    /**
     * @param int $count
     *
     * @return ProgressBar
     */
    public function makeProgressBar($count = 0)
    {
        return new ProgressBar($this->output, $count);
    }
}
