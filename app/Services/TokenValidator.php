<?php

namespace App\Services;

use App\Exceptions\TokenIsEmpty;
use App\Exceptions\TokenIsNotValid;
use Illuminate\Support\Str;

class TokenValidator
{
    private const CHARACTERS_PAIRS = [
        '(' => ')',
        '[' => ']',
        '{' => '}'
    ];

    public function validate($token)
    {
        if(!Str::startsWith($token, 'Bearer ')){
            throw new TokenIsNotValid();
        }

        $token_formatted = str_replace('Bearer ', '', $token);

        if($this->isStringLengthOdd($token_formatted)){
            throw new TokenIsNotValid();
        }

        $characters = str_split($token_formatted);

        if(!$this->hasValidFormat($characters)){
            throw new TokenIsNotValid();
        }
    }

    private function hasValidFormat($characters)
    {
        $left_pointer = 0;
        $right_pointer = count($characters) - 1;

        while($left_pointer < $right_pointer){
            if($this->areCorrectlyPaired($characters[$left_pointer], $characters[$left_pointer + 1])){
                $left_pointer += 2;
                continue;
            }else if($this->areCorrectlyPaired($characters[$left_pointer], $characters[$right_pointer])){
                $left_pointer += 1;
                $right_pointer -= 1;
                continue;
            }
            return false;
        }
        return true;
    }

    private function isStringLengthOdd($token_formatted)
    {
        return strlen($token_formatted) % 2 !== 0;
    }

    private function areCorrectlyPaired($left_character, $right_character){
        return $left_character === array_search($right_character, self::CHARACTERS_PAIRS);
    }
}
