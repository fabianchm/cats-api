<?php


namespace App\Services;


use App\Exceptions\TokenIsEmpty;
use App\Exceptions\TokenIsNotValid;

class TokenValidator
{
    public function validate($token)
    {
        $token_formatted = str_replace('Bearer ', '', $token);

        if($this->isEmpty($token_formatted)){
            throw new TokenIsEmpty();
        }

        if($this->isStringLengthOdd($token_formatted)){
            throw new TokenIsNotValid();
        }
    }

    private function isEmpty($token)
    {
        return !$token;
    }

    private function isStringLengthOdd($token_formatted)
    {
        return strlen($token_formatted) % 2 !== 0;
    }
}
