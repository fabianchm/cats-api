<?php

namespace App\Http\Controllers\Pictures;

use App\Http\Controllers\Controller;
use App\Services\CatPicturesGetter;

class CatPicturesGetController extends Controller
{
    private $catPictureGetter;

    public function __construct(CatPicturesGetter $catPictureGetter)
    {
        $this->catPictureGetter = $catPictureGetter;
    }

    public function __invoke()
    {
        $url = $this->catPictureGetter->getUrl();

        return response()->json([
            'url' => $url,
        ]);
    }
}
