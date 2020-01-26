<?php

use App\v1\Model\Address;
use Slim\Http\StatusCode;
use Tests\BaseTestCase;

/**
 * Created by PhpStorm.
 * User: jonathan.beltrao
 */
class AddressControllerTest extends BaseTestCase
{

    private $addressId;

    public function setUp(): void
    {
        parent::setUp();
        parent::runMigration();

        $address = new Address();
        $address->setStreet('Rua TEste');
        $address->setNumber(12);
        $address->setComplement('complemento');
        $address->setNeighborhood('Bairro dos Estados');
        $address->setCity('João Pessoa meu amor');
        $address->setState('PB');
        $address->setZipcode(58025650);
        $address->save();
        $this->addressId = $address->getId();
    }

    public function testCreateWithInvalidParameters()
    {
        $response = $this->runApp('POST', '/api/v1/address/create', []);
        $responseData = json_decode($response->getBody());

        $this->assertEquals(StatusCode::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertIsObject($responseData);
        $this->assertObjectHasAttribute('message', $responseData);
        $this->assertObjectHasAttribute('errors', $responseData);

        $this->assertObjectHasAttribute('street', $responseData->errors);
        $this->assertObjectHasAttribute('number', $responseData->errors);
        $this->assertObjectHasAttribute('neighborhood', $responseData->errors);
        $this->assertObjectHasAttribute('city', $responseData->errors);
        $this->assertObjectHasAttribute('state', $responseData->errors);
        $this->assertObjectHasAttribute('zipcode', $responseData->errors);
    }

    public function testCreateWithValidParams()
    {
        $data = [
            'street' => 'Rua',
            'number' => '123',
            'complement' => 'complemento',
            'neighborhood' => 'Baairro',
            'city' => 'cidade',
            'state' => 'ST',
            'zipcode' => '00000000'
        ];

        $response = $this->runApp('POST', '/api/v1/address/create', $data);
        $responseData = json_decode($response->getBody());

        $this->assertEquals(StatusCode::HTTP_OK, $response->getStatusCode());

        $this->assertIsObject($responseData);
        $this->assertObjectHasAttribute('id', $responseData);
        $this->assertObjectHasAttribute('street', $responseData);
        $this->assertObjectHasAttribute('number', $responseData);
        $this->assertObjectHasAttribute('complement', $responseData);
        $this->assertObjectHasAttribute('neighborhood', $responseData);
        $this->assertObjectHasAttribute('city', $responseData);
        $this->assertObjectHasAttribute('state', $responseData);
        $this->assertObjectHasAttribute('zipcode', $responseData);
        $this->assertObjectHasAttribute('created_at', $responseData);
        $this->assertObjectHasAttribute('updated_at', $responseData);


        $this->assertNotEmpty($responseData->street);
        $this->assertNotEmpty($responseData->number);
        $this->assertNotEmpty($responseData->complement);
        $this->assertNotEmpty($responseData->neighborhood);
        $this->assertNotEmpty($responseData->city);
        $this->assertNotEmpty($responseData->state);
        $this->assertNotEmpty($responseData->zipcode);
        $this->assertNotEmpty($responseData->created_at);
        $this->assertNotEmpty($responseData->updated_at);
    }

    public function testUpdateWithValidParams()
    {

        $data = [
            'street' => 'Rua',
            'number' => '123',
            'complement' => 'complemento',
            'neighborhood' => 'Baairro',
            'city' => 'cidade',
            'state' => 'ST',
            'zipcode' => '00000000'
        ];

        $response = $this->runApp('PATCH', '/api/v1/address/update/' . $this->addressId, $data);
        $responseData = json_decode($response->getBody());

        $this->assertEquals(StatusCode::HTTP_OK, $response->getStatusCode());

        $this->assertIsObject($responseData);
        $this->assertObjectHasAttribute('id', $responseData);
        $this->assertObjectHasAttribute('street', $responseData);
        $this->assertObjectHasAttribute('number', $responseData);
        $this->assertObjectHasAttribute('complement', $responseData);
        $this->assertObjectHasAttribute('neighborhood', $responseData);
        $this->assertObjectHasAttribute('city', $responseData);
        $this->assertObjectHasAttribute('state', $responseData);
        $this->assertObjectHasAttribute('zipcode', $responseData);
        $this->assertObjectHasAttribute('created_at', $responseData);
        $this->assertObjectHasAttribute('updated_at', $responseData);


        $this->assertNotEmpty($responseData->street);
        $this->assertNotEmpty($responseData->number);
        $this->assertNotEmpty($responseData->complement);
        $this->assertNotEmpty($responseData->neighborhood);
        $this->assertNotEmpty($responseData->city);
        $this->assertNotEmpty($responseData->state);
        $this->assertNotEmpty($responseData->zipcode);
        $this->assertNotEmpty($responseData->created_at);
        $this->assertNotEmpty($responseData->updated_at);
    }

    public function testUpdateWithInvalidParameters()
    {

        $response = $this->runApp('PATCH', '/api/v1/address/update/' . $this->addressId, []);
        $responseData = json_decode($response->getBody());

        $this->assertEquals(StatusCode::HTTP_BAD_REQUEST, $response->getStatusCode());
        $this->assertIsObject($responseData);
        $this->assertObjectHasAttribute('message', $responseData);
        $this->assertObjectHasAttribute('errors', $responseData);

        $this->assertObjectHasAttribute('street', $responseData->errors);
        $this->assertObjectHasAttribute('number', $responseData->errors);
        $this->assertObjectHasAttribute('neighborhood', $responseData->errors);
        $this->assertObjectHasAttribute('city', $responseData->errors);
        $this->assertObjectHasAttribute('state', $responseData->errors);
        $this->assertObjectHasAttribute('zipcode', $responseData->errors);
    }

    public function testListAddresses()
    {
        $response = $this->runApp('GET', '/api/v1/address/all', []);
        $responseData = json_decode($response->getBody());

        $this->assertEquals(StatusCode::HTTP_OK, $response->getStatusCode());
        $this->assertIsArray($responseData);
    }

    public function testGetAddress()
    {
        $response = $this->runApp('GET', '/api/v1/address/' . $this->addressId, []);
        $responseData = json_decode($response->getBody());

        $this->assertEquals(StatusCode::HTTP_OK, $response->getStatusCode());
        $this->assertIsObject($responseData);
    }

    public function testDeleteAddress()
    {
        $response = $this->runApp('DELETE', '/api/v1/address/' . $this->addressId, []);
        $responseData = json_decode($response->getBody());

        $this->assertEquals(StatusCode::HTTP_OK, $response->getStatusCode());
        $this->assertIsObject($responseData);
    }
}