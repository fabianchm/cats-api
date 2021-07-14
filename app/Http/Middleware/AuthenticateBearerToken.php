<?php

namespace App\Http\Middleware;

use App\Services\TokenValidator;
use Closure;
use Illuminate\Http\Request;

class AuthenticateBearerToken
{
    private $validator;

    public function __construct(TokenValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $this->validator->validate(
            $request->header('Authorization')
        );

        return $next($request);
    }
}
