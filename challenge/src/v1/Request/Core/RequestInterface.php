<?php
/**
 * Created by PhpStorm.
 * User: jonathan.beltrao
 */

namespace App\v1\Request\Core;


use Illuminate\Validation\Validator;

interface RequestInterface
{
    public function validate(array $data) : Validator;
    public function getRules() : array;
}
