<?php
/**
 * Created by PhpStorm.
 * User: jonathan.beltrao
 */

namespace App\v1\Config;

class Settings
{
    /**
     * Get settings array
     * @return array
     */
    public static function get() : array
    {
        return [
            'settings' => [
                'displayErrorDetails' => true,
                'addContentLengthHeader' => false,

                // Renderer settings
                'renderer' => [
                    'template_path' => __DIR__ . '/../../../templates/',
                ],

                // Database settings
                'db' => DB::getEloquentMysqlConfig(),
            ],

            'paths' => [
                'migrations' => __DIR__ . '/../../../db/migrations'
            ],

            'migration_base_class' => '\App\v1\Migration\Migration',
            'environments' => [
                'default_migration_table' => 'phinxlog',
                'default_database' => 'default',
                'default' => DB::getPhinxMysqlConfig(),
                'testing' => DB::getPhinxTestingConfig()
            ]
        ];
    }
}
