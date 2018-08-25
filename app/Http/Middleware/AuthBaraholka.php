<?php

namespace App\Http\Middleware;

use App\Components\User\Models\UserContract;
use Carbon\Carbon;
use Closure;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\AuthenticationException;

class AuthBaraholka extends Authenticate
{

    /**
     *  check is access token not expired
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $apiToken = $request->header('authorization');
        $apiToken = str_replace('Bearer ', '', $apiToken);
        $user = app(UserContract::class);
        if ($user->where('api_token', $apiToken)->exists()) {
            $expieredAt = $user->where('api_token', $apiToken)
                ->first()->expired_at;
            if (strtotime($expieredAt) < strtotime(Carbon::now())) {
              //  parent::handle($request, $next, $guards);
                return $next($request);
            }
        }
        throw new AuthenticationException('access_token is overdue or invalid');
    }
}
