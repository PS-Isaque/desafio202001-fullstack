<?php
/**
 * Created by PhpStorm.
 * User: jonathan.beltrao
 */

namespace App\v1\Manager;


use App\v1\Model\Address;
use Illuminate\Database\Eloquent\Collection;


class AddressManager
{
    public const ADDRESS_NOT_FOUND = 801;
    public const ERROR_MESSAGES = [
        self::ADDRESS_NOT_FOUND => [
            'message' => 'Address was not found',
            'error' => self::ADDRESS_NOT_FOUND
        ]
    ];
    public const ADDRESS_DELETED = [
        'message' => 'Excluded with success'
    ];

    /**
     * @param array $params
     * @return Address
     */
    public static function save(array $params) : Address
    {
        /** @var Address $address */
            $address = new Address();

            $address->setStreet($params['street']);
            $address->setNumber($params['number']);
            $address->setComplement($params['complement'] !== null ? $params['complement'] : '');
            $address->setNeighborhood($params['neighborhood']);
            $address->setCity($params['city']);
            $address->setState($params['state']);
            $address->setZipcode($params['zipcode']);

            $address->save();

        return $address;
    }

    /**
     * @param int $id
     * @param array $params
     * @return Address
     */
    public static function update(int $id, array $params) : ?Address
    {
        $qb = Address::query();

        /** @var Address $address */
        $address = $qb->where('id', $id)->first();

        if(is_null($address)){
            return null;
        }

        $address->setStreet($params['street']);
        $address->setNumber($params['number']);
        $address->setComplement($params['complement'] !== null ? $params['complement'] : '');
        $address->setNeighborhood($params['neighborhood']);
        $address->setCity($params['city']);
        $address->setState($params['state']);
        $address->setZipcode($params['zipcode']);

        $address->save();

        return $address;
    }

    /**
     * @param int $id
     * @return Address
     * @throws Exception
     */
    public static function getAddress(int $id) : ?Address
    {
        $qb = Address::query();

        /** @var Address $address */
        $address = $qb->where('id', $id)->first();

        return $address;
    }

    /**
     * @return Collection
     * @throws Exception
     */
    public static function getAllAddresses() : Collection
    {
        $address = Address::all();

        return $address;
    }

    /**
     * @param int $id
     * @return bool|null
     * @throws \Exception
     */
    public static function deleteAddress(int $id)
    {
        $qb = Address::query();

        /** @var Address $address */
        $address = $qb->where('id', $id)->first();

        if(!is_null($address)){
            return $address->delete();
        }else{
            return false;
        }

    }
}
