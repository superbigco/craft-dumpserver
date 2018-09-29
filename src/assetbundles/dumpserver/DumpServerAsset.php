<?php
/**
 * Dump Server plugin for Craft CMS 3.x
 *
 * Brings Symfony’s Var-Dump Server to Craft
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2018 Superbig
 */

namespace superbig\dumpserver\assetbundles\DumpServer;

use Craft;
use craft\web\AssetBundle;
use craft\web\assets\cp\CpAsset;

/**
 * @author    Superbig
 * @package   DumpServer
 * @since     1.0.0
 */
class DumpServerAsset extends AssetBundle
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->sourcePath = "@superbig/dumpserver/assetbundles/dumpserver/dist";

        $this->depends = [
            CpAsset::class,
        ];

        $this->js = [
            'js/DumpServer.js',
        ];

        $this->css = [
            'css/DumpServer.css',
        ];

        parent::init();
    }
}
