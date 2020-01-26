<?php
/**
 * Created by PhpStorm.
 * User: jonathan.beltrao
 */

namespace Test\v1\Config;


use App\v1\Config\Settings;
use Tests\BaseTestCase;

class SettingsTest extends BaseTestCase {
    /**
     * Test the get method to get settings
     */
    public function testGet()
    {
        $settings = Settings::get();

        $this->assertIsArray($settings);

        $this->assertArrayHasKey('settings', $settings);
        $this->assertArrayHasKey('renderer', $settings['settings']);
        $this->assertArrayHasKey('db', $settings['settings']);
    }
}