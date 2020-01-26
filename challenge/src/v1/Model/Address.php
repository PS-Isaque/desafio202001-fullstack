<?php
/**
 * Created by PhpStorm.
 * User: jonathan.beltrao
 */

namespace App\v1\Model;


use App\v1\Model\Core\BaseModel;
use JsonSerializable;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Address
 * @package App\v1\Model
 *
 * @OA\Schema(
 *     @OA\Property(property="id", type="integer", example=123, description="The address id stored in database"),
 *     @OA\Property(property="street", type="string", example="AV. LUIS CARLOS BERRINI", description="The address street"),
 *     @OA\Property(property="number", type="integer", example=1645, description="The address number"),
 *     @OA\Property(property="complement", type="integer", example=1645, description="The address complement"),
 *     @OA\Property(property="neighborhood", type="string", example="CIDADE MONÇÕES", description="The address neighborhood"),
 *     @OA\Property(property="city", type="string", example="SÃO PAULO", description="The address city"),
 *     @OA\Property(property="state", type="string", example="SP", description="The address state"),
 *     @OA\Property(property="zipcode", type="string", example="04571010", description="The address zipcode"),
 *     @OA\Property(property="created_at", type="string", example="2019-10-10 23:00:00", pattern="Y-m-d H:i:s", description="The date when address was created"),
 *     @OA\Property(property="updated_at", type="string", example="2019-10-10 23:00:00", pattern="Y-m-d H:i:s", description="The date when address was updated"),
 * ),
 * @OA\Schema(schema="AddressCreate", required={"street","number","neighborhood","city","state","zipcode"},
 *     @OA\Property(property="street", type="string", example="AV. LUIS CARLOS BERRINI", description="The street address"),
 *     @OA\Property(property="number", type="integer", example=1645, description="The address number"),
 *     @OA\Property(property="complement", type="integer", example=1645, description="The address complement"),
 *     @OA\Property(property="neighborhood", type="string", example="CIDADE MONÇÕES", description="The address neighborhood"),
 *     @OA\Property(property="city", type="string", example="SÃO PAULO", description="The address city"),
 *     @OA\Property(property="state", type="string", example="SP", description="The address state"),
 *     @OA\Property(property="zipcode", type="string", example="04571010", description="The address zipcode"),
 * )
 *
 * @OA\Schema(schema="AddressUpdate", required={"street","number","neighborhood","city","state","zipcode"},
 *     @OA\Property(property="id", type="string", example="1", description="The address id"),
 *     @OA\Property(property="street", type="string", example="AV. LUIS CARLOS BERRINI", description="The stret address"),
 *     @OA\Property(property="number", type="integer", example=1645, description="The address number"),
 *     @OA\Property(property="complement", type="integer", example=1645, description="The address complement"),
 *     @OA\Property(property="neighborhood", type="string", example="CIDADE MONÇÕES", description="The address neighborhood"),
 *     @OA\Property(property="city", type="string", example="SÃO PAULO", description="The address city"),
 *     @OA\Property(property="state", type="string", example="SP", description="The address state"),
 *     @OA\Property(property="zipcode", type="string", example="04571010", description="The address zipcode"),
 * )
 */
class Address extends BaseModel implements JsonSerializable
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'address';

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street)
    {
        $this->street = $street;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber(int $number)
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getComplement(): string
    {
        return $this->complement;
    }

    /**
     * @param string $complement
     */
    public function setComplement(string $complement)
    {
        $this->complement = $complement;
    }

    /**
     * @return string
     */
    public function getNeighborhood(): string
    {
        return $this->neighborhood;
    }

    /**
     * @param string $neighborhood
     */
    public function setNeighborhood(string $neighborhood)
    {
        $this->neighborhood = $neighborhood;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state)
    {
        $this->state = $state;
    }

    /**
     * @return string
     */
    public function getZipcode(): string
    {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     */
    public function setZipcode(string $zipcode)
    {
        $this->zipcode = $zipcode;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'street' => $this->getStreet(),
            'number' => $this->getNumber(),
            'complement' => $this->getComplement(),
            'neighborhood' => $this->getNeighborhood(),
            'city' => $this->getCity(),
            'state' => $this->getState(),
            'zipcode' => $this->getZipcode(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt()
        ];
    }
}
