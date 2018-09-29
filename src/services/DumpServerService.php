<?php
/**
 * Dump Server plugin for Craft CMS 3.x
 *
 * Brings Symfony’s Var-Dump Server to Craft
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2018 Superbig
 */

namespace superbig\dumpserver\services;

use superbig\dumpserver\DumpServer;

use Craft;
use craft\base\Component;

/**
 * @author    Superbig
 * @package   DumpServer
 * @since     1.0.0
 */
class DumpServerService extends Component
{
    // Public Methods
    // =========================================================================

    /*
     * @return mixed
     */
    public function exampleService()
    {
        $result = 'something';
        // Check our Plugin's settings for `someAttribute`
        if (DumpServer::$plugin->getSettings()->someAttribute) {
        }

        return $result;
    }
}
