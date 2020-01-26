<?php
/**
 * Created by PhpStorm.
 * User: jonathan.beltrao
 */

namespace App\v1\Config;


class DB
{

    /**
     * @return array
     */
    public static function getEloquentMysqlConfig() : array
    {
        return [
            'driver' => 'mysql',
            'host' => 'db',
            'database' => 'challenge',
            'username' => 'root',
            'password' => 'root',
            'port' => '3306',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ];
    }

    /**
     * @return array
     */
    public static function getEloquentTestingConfig()
    {
        return [
            'driver' => 'sqlite',
            'database' => ':memory:'
        ];
    }

    /**
     * @return array
     */
    public static function getPhinxMysqlConfig()
    {
        return [
            'adapter' => 'mysql',
            'host' => 'localhost',
            'name' => 'challenge',
            'user' => 'root',
            'pass' => 'root',
            'port' => '3336',
            'charset'   => 'utf8'
        ];
    }

    /**
     * @return array
     */
    public static function getPhinxTestingConfig()
    {
        return [
            'adapter' => 'sqlite',
            'memory' => true
        ];
    }
}
