<?php

namespace App\Http\Middleware\Auth;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin {
	
	public function handle($request, Closure $next, $guard = null){
		$user = Auth::user();
		if($user->user_type_id != 1){
			return redirect()->name("index");
		}
		
		return $next($request);
		
	}
}



