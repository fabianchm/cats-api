<?php

namespace Tests\Feature\Pictures;

use Tests\TestCase;

class CatPicturesTest extends TestCase
{
    /** @test */
    public function it_returns_a_cat_picture_url_successfully()
    {
        $response = $this->getJson(route('pictures.cats.get'));

        $response->assertStatus(200);
    }
}
