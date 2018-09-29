<?php
/**
 * Dump Server plugin for Craft CMS 3.x
 *
 * Brings Symfony’s Var-Dump Server to Craft
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2018 Superbig
 */

namespace superbig\dumpserver\variables;

use superbig\dumpserver\console\Dumper;
use superbig\dumpserver\DumpServer;

use Craft;
use Symfony\Component\VarDumper\Dumper\ContextProvider\RequestContextProvider;
use Symfony\Component\VarDumper\Dumper\ContextProvider\SourceContextProvider;
use Symfony\Component\VarDumper\Server\Connection;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @author    Superbig
 * @package   DumpServer
 * @since     1.0.0
 */
class DumpServerVariable
{
    // Public Methods
    // =========================================================================

    /**
     * @param null $optional
     *
     * @return string
     */
    public function dump($data = null)
    {
        $host = DumpServer::$plugin->getSettings()->host;

        $connection = new Connection($host, [
            'request' => new RequestContextProvider($this->app['request']),
            'source'  => new SourceContextProvider('utf-8', Craft::getAlias('@web')),
        ]);

        VarDumper::setHandler(function($var) use ($connection) {
            (new Dumper($connection))->dump($var);
        });
    }
}
