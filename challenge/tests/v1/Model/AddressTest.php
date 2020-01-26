<?php
use App\v1\Model\Address;

/**
 * Created by PhpStorm.
 * User: jonathan.beltrao
 */
class AddressTest extends \Tests\BaseTestCase
{
    /**
     * @var Address $address;
     */
    private $address;
    private $mock;

    public function setUp(): void
    {
        parent::setUp();
        parent::runMigration();

        $this->mock = [
            'id' => 1,
            'street' => 'Rua',
            'number' => 123,
            'complement' => 'complemento',
            'neighborhood' => 'Baairro',
            'city' => 'cidade',
            'state' => 'ST',
            'zipcode' => 00000000
        ];

        $this->address = new Address();
        $this->address->setStreet('Rua TEste');
        $this->address->setNumber(12);
        $this->address->setComplement('complemento');
        $this->address->setNeighborhood('Bairro dos Estados');
        $this->address->setCity('João Pessoa meu amor');
        $this->address->setState('PB');
        $this->address->setZipcode(58025650);
        $this->address->save();
    }

    public function testGetterAndSetters()
    {
        $address = new Address();
        $address->setStreet('STREET');
        $address->setNumber(123);
        $address->setNeighborhood('NEIGHBORHOOD');
        $address->setComplement('COMPLEMENT');
        $address->setCity('CITY');
        $address->setState('UR');
        $address->setZipcode('00000000');
        $address->save();

        $this->assertNotEmpty($address->getId());
        $this->assertEquals('STREET', $address->getStreet());
        $this->assertEquals(123, $address->getNumber());
        $this->assertEquals('NEIGHBORHOOD', $address->getNeighborhood());
        $this->assertEquals('COMPLEMENT', $address->getComplement());
        $this->assertEquals('CITY', $address->getCity());
        $this->assertEquals('UR', $address->getState());
        $this->assertEquals('00000000', $address->getZipcode());
    }

    public function testJsonSerialize()
    {
        $array = $this->address->jsonSerialize();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('id', $array);
        $this->assertArrayHasKey('street', $array);
        $this->assertArrayHasKey('number', $array);
        $this->assertArrayHasKey('complement', $array);
        $this->assertArrayHasKey('neighborhood', $array);
        $this->assertArrayHasKey('city', $array);
        $this->assertArrayHasKey('state', $array);
        $this->assertArrayHasKey('zipcode', $array);
        $this->assertArrayHasKey('created_at', $array);
        $this->assertArrayHasKey('updated_at', $array);
    }
}