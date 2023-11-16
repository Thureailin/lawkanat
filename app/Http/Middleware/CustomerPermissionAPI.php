<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class CustomerPermissionAPI
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
        $user = User::find($request->user()->id);

        if ($user->role_flag != 3) {
            
            return response()->json([                 
                "message" => "Permission Denied!",
                "status" => 401,
            ]);
        }

        return $next($request);
    }
}
