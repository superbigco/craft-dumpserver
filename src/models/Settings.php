<?php
/**
 * Dump Server plugin for Craft CMS 3.x
 *
 * Brings Symfony’s Var-Dump Server to Craft
 *
 * @link      https://superbig.co
 * @copyright Copyright (c) 2018 Superbig
 */

namespace superbig\dumpserver\models;

use superbig\dumpserver\DumpServer;

use Craft;
use craft\base\Model;

/**
 * @author    Superbig
 * @package   DumpServer
 * @since     1.0.0
 */
class Settings extends Model
{
    // Public Properties
    // =========================================================================

    /**
     * @var string
     */
    public $host = 'tcp://127.0.0.1:9912';

    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['host', 'string'],
            ['host', 'default', 'value' => 'tcp://127.0.0.1:9912'],
        ];
    }
}
