<?php
use App\v1\Manager\AddressManager;
use App\v1\Model\Address;

/**
 * Created by PhpStorm.
 * User: jonathan.beltrao
 */
class AddressManagerTest extends \Tests\BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        parent::runMigration();
    }

    public function testSave()
    {
        $params = [
            'street' => 'ADDRESS TEST',
            'number' => 24,
            'complement' => 'COMPLEMENT TEST',
            'neighborhood' => 'NEIGHBORHOOD TEST',
            'city' => 'CITY TEST',
            'state' => 'SS',
            'zipcode' => '04844000'
        ];

        $address = AddressManager::save($params);

        $this->assertInstanceOf(Address::class, $address);
        $this->assertNotEmpty($address->getId());
        $this->assertEquals($address->getStreet(), $params['street']);
        $this->assertEquals($address->getNumber(), $params['number']);
        $this->assertEquals($address->getComplement(), $params['complement']);
        $this->assertEquals($address->getNeighborhood(), $params['neighborhood']);
        $this->assertEquals($address->getCity(), $params['city']);
        $this->assertEquals($address->getState(), $params['state']);
        $this->assertEquals($address->getZipcode(), $params['zipcode']);
    }

    public function testUpdateAddress()
    {
        $id = 1;
        $params = [
            'street' => 'ADDRESS TEST',
            'number' => 24,
            'complement' => 'COMPLEMENT TEST',
            'neighborhood' => 'NEIGHBORHOOD TEST',
            'city' => 'CITY TEST',
            'state' => 'SS',
            'zipcode' => '04844000'
        ];

        $paramsUpdate = [
            'street' => 'ADDRESS TEST 2',
            'number' => 25,
            'complement' => 'COMPLEMENT TEST 2',
            'neighborhood' => 'NEIGHBORHOOD',
            'city' => 'CITY ',
            'state' => 'SO',
            'zipcode' => '04844001'
        ];

        $address = AddressManager::save($params);
        $otherAddress = AddressManager::update($id, $paramsUpdate);

        $this->assertInstanceOf(Address::class, $otherAddress);
        $this->assertNotEmpty($otherAddress->getId());

        $this->assertEquals($address->getId(), $otherAddress->getId());
        $this->assertNotEquals($address->getStreet(), $otherAddress->getStreet());
        $this->assertNotEquals($address->getNumber(), $otherAddress->getNumber());
        $this->assertNotEquals($address->getComplement(), $otherAddress->getComplement());
        $this->assertNotEquals($address->getNeighborhood(), $otherAddress->getNeighborhood());
        $this->assertNotEquals($address->getCity(), $otherAddress->getCity());
        $this->assertNotEquals($address->getState(), $otherAddress->getState());
        $this->assertNotEquals($address->getZipcode(), $otherAddress->getZipcode());
    }

    public function testGetAddress(){
        $id = 1;

        $params = [
            'street' => 'ADDRESS TEST',
            'number' => 24,
            'complement' => 'COMPLEMENT TEST',
            'neighborhood' => 'NEIGHBORHOOD TEST',
            'city' => 'CITY TEST',
            'state' => 'SS',
            'zipcode' => '04844000'
        ];

        $address = AddressManager::save($params);

        $address = AddressManager::getAddress($id);

        $this->assertInstanceOf(Address::class, $address);
        $this->assertNotEmpty($address->getId());
        $this->assertNotEmpty($address->getStreet());
        $this->assertNotEmpty($address->getNumber());
        $this->assertNotEmpty($address->getComplement());
        $this->assertNotEmpty($address->getNeighborhood());
        $this->assertNotEmpty($address->getCity());
        $this->assertNotEmpty($address->getState());
        $this->assertNotEmpty($address->getZipcode());
    }

    public function testListAddress(){
        $array = AddressManager::getAllAddresses();

        $this->assertIsObject($array);
    }

    public function testDeleteAddress(){
        $id = 1;

        $params = [
            'street' => 'ADDRESS TEST',
            'number' => 24,
            'complement' => 'COMPLEMENT TEST',
            'neighborhood' => 'NEIGHBORHOOD TEST',
            'city' => 'CITY TEST',
            'state' => 'SS',
            'zipcode' => '04844000'
        ];

        $address = AddressManager::save($params);

        $delete= AddressManager::deleteAddress($id);
        $this->assertTrue($delete);
    }
}