<?php
/**
 * Created by PhpStorm.
 * User: jonathan.beltrao
 */

namespace App\v1\Util;


class Env
{
    const TESTING = 'testing';

    /**
     * @return bool
     */
    public static function isTestingEnv() : bool
    {
        return getenv('APPLICATION_ENV') == self::TESTING;
    }
}
