<?php

namespace Tests\Feature\Pictures;

use App\Exceptions\TokenIsNotValid;
use Tests\TestCase;

class CatPicturesTest extends TestCase
{
    /** @test */
    public function it_returns_a_cat_picture_url_successfully()
    {
        $headers = [
            'Authorization' => 'Bearer ()'
        ];

        $response = $this->getJson(route('pictures.cats.get'), $headers);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'url'
            ]);
    }

    /** @test */
    function it_returns_an_error_if_token_is_not_provided(){
        $this->withoutExceptionHandling();

        $headers = [
            'Authorization' => ' '
        ];

        $this->expectException(TokenIsNotValid::class);
        $this->getJson(route('pictures.cats.get'), $headers);
    }
}
