<?php

namespace Tests\Feature\Pictures;

use App\Exceptions\CatPictureResponseError;
use App\Exceptions\CatPictureResponseNotValid;
use App\Exceptions\UrlNotValid;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CatPicturesTest extends TestCase
{
    /** @test */
    public function it_returns_a_cat_picture_url_successfully()
    {
        $response = $this->getJson(route('pictures.cats.get'));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'url'
            ]);
    }
}
