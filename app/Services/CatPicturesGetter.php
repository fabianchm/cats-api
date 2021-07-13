<?php


namespace App\Services;

use App\Exceptions\CatPictureResponseError;
use App\Exceptions\CatPictureResponseNotValid;
use App\Exceptions\UrlNotValid;
use Illuminate\Support\Facades\Http;

class CatPicturesGetter
{
    public function getUrl()
    {

        $response = Http::get(config('apis.cats_api_url'));

        $this->ensureResponseIsSuccess($response);

        $data = $response->json();

        $this->ensureResponseJsonIsValid($data);

        $url = $data[0]['url'];

        $this->ensureUrlHasValidFormat($url);

        return $url;
    }

    private function ensureResponseIsSuccess($response)
    {
        if($response->getStatusCode() !== 200){
            throw new CatPictureResponseError();
        }
    }

    private function ensureResponseJsonIsValid($data)
    {
        if(!is_array($data) || empty($data) || !isset($data[0]['url'])){
            throw new CatPictureResponseNotValid();
        }
    }

    private function ensureUrlHasValidFormat($url)
    {
        if(!filter_var($url, FILTER_VALIDATE_URL)){
            throw new UrlNotValid();
        }
    }
}
