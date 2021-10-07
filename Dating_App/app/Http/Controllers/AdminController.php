<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\user_interest;
use App\Models\user_connection;
use App\Models\user_blocked;
use App\Models\user_notification;
use App\Models\user_picture;
use App\Models\user_message;
use App\Models\user_type;
use App\Models\user_favorite;
use phpDocumentor\Reflection\Types\Null_;


class 	AdminController extends Controller{
	
	function index(){
		
		return view("welcome");
	}

	
	function login(Request $request){
		$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
		
		

		if(Auth::attempt($validator->validated()) && Auth::user()->user_type_id == 1){
			
			return redirect()->route("admin");
		}
			
		
		return redirect()->route("index");
	
    }

	function admin(){
		$pend_pics = user_picture::where('is_approved',0)->get();;
		
	
		return view('Admin',['data'=>$pend_pics]);
	}

	function adminmsgs(){
		$pend_msgs = user_message::where('is_approved',0)->get();
   		return view('adminmsgs',['data'=>$pend_msgs]);

	}
	
	function logout(){
		//Auth::logout();
		return redirect()->route("index");	
		
	}

	protected function createNewToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
