<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AppKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $key = $request->header('KEY');
        if($key == '')
        {
            return response()->json(['error' => 'App key not found']);
        }
        if($key != 'YW1Gb1lXNTZZV2xpTG1GemJHRnRMbTFsYUdGeVFHZHRZV2xzTG1OdmJUcHphMmxzYkdWa2RHRnNhdz09'){
            return response()->json(['error' => 'Invalid app key']);
        }

        return $next($request);
    }
}
