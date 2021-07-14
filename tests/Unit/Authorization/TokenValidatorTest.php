<?php

namespace Tests\Unit\Authorization;

use App\Exceptions\TokenIsNotValid;
use App\Services\TokenValidator;
use Tests\TestCase;

class TokenValidatorTest extends TestCase
{
    private $validator;

    protected function setUp(): void
    {
        parent::setUp();

        $this->validator = new TokenValidator();
    }

    /** @test */
    function it_throws_an_exception_if_token_dont_start_with_bearer_word(){
        $this->withoutExceptionHandling();
        $this->expectException(TokenIsNotValid::class);
        $this->validator->validate('()');
    }

    /** @test */
    function it_throws_an_exception_if_token_length_is_odd(){
        $this->withoutExceptionHandling();
        $this->expectException(TokenIsNotValid::class);
        $this->validator->validate('Bearer ())');
    }

    /** @test */
    function it_is_valid_when_token_is_empty_string(){
        $this->validator->validate('Bearer ');
        $this->expectNotToPerformAssertions();
    }

    /** @test */
    function it_is_valid_when_pair_of_characters_are_closed_correctly(){
        $this->validator->validate('Bearer {}');
        $this->expectNotToPerformAssertions();
    }

    /** @test */
    function it_is_valid_when_pairs_of_characters_are_closed_correctly(){
        $this->validator->validate('Bearer {}[]()');
        $this->expectNotToPerformAssertions();
    }

    /** @test */
    function it_throws_an_exception_when_pair_of_characters_are_different(){
        $this->withoutExceptionHandling();
        $this->expectException(TokenIsNotValid::class);
        $this->validator->validate('Bearer {)');
    }

    /** @test */
    function it_throws_an_exception_when_pairs_of_characters_are_closed_in_wrong_order(){
        $this->withoutExceptionHandling();
        $this->expectException(TokenIsNotValid::class);
        $this->validator->validate('Bearer [{]}');
    }

    /** @test */
    function it_is_valid_when_nested_pairs_of_characters_are_closed_in_correct_order(){
        $this->validator->validate('Bearer {([])}');
        $this->expectNotToPerformAssertions();
    }

    /** @test */
    function it_throws_an_exception_when_some_characters_are_not_closed(){
        $this->withoutExceptionHandling();
        $this->expectException(TokenIsNotValid::class);
        $this->validator->validate('Bearer (((((((()');
    }
}
