<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class TokenIsNotValid extends Exception
{
    protected $message_lang_key = "errors.token_not_valid";
    protected $code = Response::HTTP_UNAUTHORIZED;

    public function render()
    {
        return response(__($this->message_lang_key), $this->code);
    }
}
