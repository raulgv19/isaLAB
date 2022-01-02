<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IsAdmin
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

        if (Auth::user() &&  Role::find($user->role_id)->role_name === 'Admin') {
            return $next($request);
       }

       return redirect()->back();
    }
}
