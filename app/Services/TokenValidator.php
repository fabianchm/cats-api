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

        if($this->isEmpty($token_formatted)){
            return;
        }

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
        $unmatchedCharacters = array_reduce($characters, function($accumulate, $next){
            if($this->isOpenCharacter($next)){
                array_push($accumulate, [$next]);
                return $accumulate;
            }else if($this->isCloseCharacter($next)){
                if($this->isLastCharacterPairedWithNextOne($accumulate, $next)){
                    array_pop($accumulate);
                    return $accumulate;
                }
            }
            throw new TokenIsNotValid();
        }, []);

        return empty($unmatchedCharacters);
    }

    private function isEmpty($token)
    {
        return !$token;
    }

    private function isStringLengthOdd($token_formatted)
    {
        return strlen($token_formatted) % 2 !== 0;
    }

    private function isOpenCharacter($value)
    {
        return isset(self::CHARACTERS_PAIRS[$value]);
    }

    private function isCloseCharacter($value)
    {
        return array_search($value, self::CHARACTERS_PAIRS);
    }

    private function isLastCharacterPairedWithNextOne($accumulate, $next)
    {
        if(empty($accumulate)){
            return false;
        }
        return $accumulate[count($accumulate) - 1][0] === array_search($next, self::CHARACTERS_PAIRS);
    }
}
