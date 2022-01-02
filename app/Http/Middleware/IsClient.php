<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IsClient
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
        $user = DB::table('role_user')->where('user_id', Auth::user()->id)->first();

        if (Auth::user() &&  Role::find($user->role_id)->role_name === 'Socio') {
            return $next($request);
       }

       return redirect()->back();
    }
}
