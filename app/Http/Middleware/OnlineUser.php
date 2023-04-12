<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Cache;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;

class OnlineUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if(Auth::check()){
            $expiresAt = Carbon::now()->addMinutes(5);
            Cache::put("user-is-online-".Auth::user()->id,true,$expiresAt);
        }


        return $next($request);
    }
}
