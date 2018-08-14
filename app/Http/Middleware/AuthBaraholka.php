<?php

namespace App\Http\Middleware;

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
        $user = app(UserContract::class);
        //TODO check on expired at

        parent::handle($request, $next, $guards);

        return $next($request);
    }
}
