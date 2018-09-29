<?php
/**
 * Dump Server plugin for Craft CMS 3.x
 *
 * Brings Symfony’s Var-Dump Server to Craft
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2018 Superbig
 */

namespace superbig\dumpserver;

use superbig\dumpserver\services\DumpServerService as DumpServerServiceService;
use superbig\dumpserver\variables\DumpServerVariable;
use superbig\dumpserver\twigextensions\DumpServerTwigExtension;
use superbig\dumpserver\models\Settings;

use Craft;
use craft\base\Plugin;
use craft\services\Plugins;
use craft\events\PluginEvent;
use craft\console\Application as ConsoleApplication;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;

/**
 * Class DumpServer
 *
 * @author    Superbig
 * @package   DumpServer
 * @since     1.0.0
 *
 * @property  DumpServerServiceService $dumpServerService
 * @method  Settings getSettings()
 */
class DumpServer extends Plugin
{
    // Static Properties
    // =========================================================================

    /**
     * @var DumpServer
     */
    public static $plugin;

    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $schemaVersion = '1.0.0';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Craft::$app->view->registerTwigExtension(new DumpServerTwigExtension());

        if (Craft::$app instanceof ConsoleApplication) {
            $this->controllerNamespace = 'superbig\dumpserver\console\controllers';
        }

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function(Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('dumpServer', DumpServerVariable::class);
            }
        );


        Craft::info(
            Craft::t(
                'dump-server',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    // Protected Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    protected function createSettingsModel()
    {
        return new Settings();
    }
}
