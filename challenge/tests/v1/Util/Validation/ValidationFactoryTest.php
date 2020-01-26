<?php

/**
 * Created by PhpStorm.
 * User: jonathan.beltrao
 */
class ValidationFactoryTest extends \Tests\BaseTestCase
{
    /**
     * Test setup translator method
     */
    public function testSetupTranslator()
    {
        $validatorFactory = new \App\v1\Util\Validation\ValidationFactory($this->getContainer());
        $this->assertInstanceOf(\Illuminate\Translation\Translator::class, $validatorFactory->setupTranslator());
    }
}