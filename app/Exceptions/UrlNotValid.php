<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class UrlNotValid extends Exception
{
    protected $message_lang_key = "errors.url_not_valid";
    protected $code = Response::HTTP_NOT_FOUND;

    public function render()
    {
        return response(__($this->message_lang_key), $this->code);
    }
}
