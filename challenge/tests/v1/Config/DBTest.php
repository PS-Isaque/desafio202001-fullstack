<?php
/**
 * Created by PhpStorm.
 * User: jonathan.beltrao
 */

namespace Test\v1\Config;


use App\v1\Config\DB;
use Tests\BaseTestCase;

class DBTest extends BaseTestCase
{

    /**
     * Test getting eloquent mysql config
     */
    public function testGetEloquentMysqlConfig()
    {
        $config = DB::getEloquentMysqlConfig();

        $this->assertIsArray($config);
        $this->assertArrayHasKey('driver', $config);
        $this->assertArrayHasKey('host', $config);
        $this->assertArrayHasKey('database', $config);
        $this->assertArrayHasKey('username', $config);
        $this->assertArrayHasKey('password', $config);
        $this->assertArrayHasKey('port', $config);
        $this->assertArrayHasKey('charset', $config);
        $this->assertArrayHasKey('collation', $config);
        $this->assertArrayHasKey('prefix', $config);
    }

    /*
     * Test getting eloquent testing config
     */
    public function testGetEloquentTestingConfig()
    {
        $config = DB::getEloquentTestingConfig();

        $this->assertIsArray($config);
        $this->assertArrayHasKey('driver', $config);
        $this->assertArrayHasKey('database', $config);
    }

    /**
     * Test getting phinx mysql config
     */
    public function testGetPhinxMysqlConfig()
    {
        $config = DB::getPhinxMysqlConfig();

        $this->assertIsArray($config);
        $this->assertArrayHasKey('adapter', $config);
        $this->assertArrayHasKey('host', $config);
        $this->assertArrayHasKey('name', $config);
        $this->assertArrayHasKey('user', $config);
        $this->assertArrayHasKey('pass', $config);
        $this->assertArrayHasKey('port', $config);
        $this->assertArrayHasKey('charset', $config);
    }

    public function testGetPhinxTestingConfig()
    {
        $config = DB::getPhinxTestingConfig();

        $this->assertIsArray($config);

        $this->assertArrayHasKey('adapter', $config);
        $this->assertArrayHasKey('memory', $config);
    }
}