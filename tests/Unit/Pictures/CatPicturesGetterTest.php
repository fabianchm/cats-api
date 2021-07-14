<?php


namespace Tests\Unit\Pictures;

use App\Exceptions\CatPictureResponseError;
use App\Exceptions\CatPictureResponseNotValid;
use App\Exceptions\UrlNotValid;
use App\Services\CatPicturesGetter;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class CatPicturesGetterTest extends TestCase
{
    private $getter;

    protected function setUp(): void
    {
        parent::setUp();

        $this->getter = new CatPicturesGetter();
    }

    /** @test */
    public function it_returns_exception_if_status_code_from_api_call_is_not_success(){
        $this->withoutExceptionHandling();

        Http::fake([
            '*' => Http::response(['algo'], 400, []),
        ]);

        $this->expectException(CatPictureResponseError::class);
        $this->getter->getUrl();
    }

    /** @test */
    public function it_returns_exception_if_response_format_is_not_the_expected(){
        $this->withoutExceptionHandling();

        Http::fake([
            '*' => Http::response([['no_soy_url' => 'a']], 200, []),
        ]);

        $this->expectException(CatPictureResponseNotValid::class);
        $this->getter->getUrl();
    }

    /** @test */
    public function it_returns_exception_if_url_retrieved_from_api_is_not_valid(){
        $this->withoutExceptionHandling();

        Http::fake([
            '*' => Http::response([['url' => 'no_soy_una_url']], 200, []),
        ]);

        $this->expectException(UrlNotValid::class);
        $this->getter->getUrl();
    }
}
