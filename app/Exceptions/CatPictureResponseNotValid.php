<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class CatPictureResponseNotValid extends Exception
{
    protected $message_lang_key = "errors.cat_picture_bad_response_format";
    protected $code = Response::HTTP_NOT_FOUND;

    public function render()
    {
        return response(__($this->message_lang_key), $this->code);
    }
}
