<?php
/**
 * Created by PhpStorm.
 * User: jonathan.beltrao
 */

namespace App\v1\Request;

use App\v1\Request\Core\AbstractRequest;
use Illuminate\Validation\Validator;

class AddressRequest extends AbstractRequest
{

    /**
     * @param array $data
     * @return Validator
     */
    public function validate(array $data) : Validator
    {
        return $this->getValidator()->make($data, $this->getRules());
    }

    /**
     * @return array
     */
    public function getRules(): array
    {
        return [
            'street' => 'required',
            'number' => 'required|numeric',
            'complement' => 'max:45',
            'city' => 'required|max:150',
            'neighborhood' => 'required|max:100',
            'state' => 'required|max:2',
            'zipcode' => 'required|numeric|digits:8'
        ];
    }
}
