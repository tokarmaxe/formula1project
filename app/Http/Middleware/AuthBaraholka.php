<?php

namespace App\Http\Middleware;

use App\Components\User\Models\User;
use App\Components\User\Models\UserContract;
use Closure;
use Illuminate\Auth\Middleware\Authenticate;

class AuthBaraholka extends Authenticate
{

    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param mixed ...$guards
     * @return mixed
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        //TODO check on expired at
//        $user = User::where('email',$request)

        return $next($request);
    }
}
