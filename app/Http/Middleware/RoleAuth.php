<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class RoleAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = User::find(auth()->user()->id);
        if ($user->hasRole('admin_room_911')) {
            return $next($request);
        }
        return redirect('/home');
    }
}
