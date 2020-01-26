<?php

use App\v1\Request\Core\RequestInterface;
use App\v1\Request\AddressRequest;
use Tests\BaseTestCase;
use Illuminate\Support\MessageBag;
Use App\v1\Model\Address;

/**
 * Created by PhpStorm.
 * User: jonathan.beltrao
 */
class AddressRequestTest extends BaseTestCase
{
    /**
     * @var RequestInterface $requestManager
     */
    private $requestManager;

    public function setUp(): void
    {
        parent::setUp();

        $this->requestManager = new AddressRequest($this->getContainer());
    }

    /**
     * Testing get rules method
     */
    public function testGetRules()
    {
        $data = $this->requestManager->getRules();

        $this->assertIsArray($data);

        $this->assertArrayHasKey('street', $data);
        $this->assertArrayHasKey('number', $data);
        $this->assertArrayHasKey('complement', $data);
        $this->assertArrayHasKey('neighborhood', $data);
        $this->assertArrayHasKey('city', $data);
        $this->assertArrayHasKey('state', $data);
        $this->assertArrayHasKey('zipcode', $data);
    }

    /**
     * Test validation method without any params
     */
    public function testValidateWithoutAnyParams()
    {
        $validator = $this->requestManager->validate([]);
        $errors = $validator->errors()->messages();

        $this->assertTrue($validator->fails());

        $this->assertIsArray($errors);
        $this->assertArrayHasKey('street', $errors);
        $this->assertArrayHasKey('number', $errors);
        $this->assertArrayHasKey('neighborhood', $errors);
        $this->assertArrayHasKey('city', $errors);
        $this->assertArrayHasKey('state', $errors);
        $this->assertArrayHasKey('zipcode', $errors);

        $this->assertNotEmpty($errors['street']);
        $this->assertNotEmpty($errors['number']);
        $this->assertNotEmpty($errors['neighborhood']);
        $this->assertNotEmpty($errors['city']);
        $this->assertNotEmpty($errors['state']);
        $this->assertNotEmpty($errors['zipcode']);
    }

    /**
     * Test validate with fail
     */
    public function testValidateWithFail()
    {
        /** @var Illuminate\Validation\Validator $validator */
        $validator = $this->requestManager->validate([]);

        /** @var MessageBag $errors */
        $errors = $validator->errors();

        $this->assertTrue($validator->fails());
        $this->assertFalse($validator->passes());

        $this->assertInstanceOf(MessageBag::class, $errors);
        $this->assertTrue($errors->has(['street', 'number', 'neighborhood', 'city', 'state', 'zipcode']));
    }

    /**
     * Test validate method with success
     */
    public function testValidateWithSuccess()
    {
        /** @var Illuminate\Validation\Validator $validator */
        $validator = $this->requestManager->validate(
            [
                'street' => 'Rua',
                'number' => 10,
                'neighborhood' => 'bairro',
                'city' => 'cidade',
                'state' => 'ST',
                'zipcode' => 58025650,
            ]
        );

        $this->assertFalse($validator->fails());
        $this->assertTrue($validator->passes());
    }
}