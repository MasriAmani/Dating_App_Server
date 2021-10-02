<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\user_hobby;
use App\Models\user_interest;
use App\Models\user_connection;
use App\Models\user_blocked;
use App\Models\user_notification;
use App\Models\user_picture;
use App\Models\user_type;
use App\Models\user_favorite;


class UserController extends Controller{
	
	function index(){
		//$user = User::find(1);
		// echo $user->interests;
		// foreach ($user->interests as $intr){
		// 	echo($intr->name);

         //$interest = user_interest::find(1);
	     // echo $interest->name;
		// echo $interest->user->first_name;

		 //$user = user_type::find(2);
		 // echo $user->user;

		 // $user = User::find(1);
	     //echo $user->type->name;

		 // $user = User::find(1);
		  // foreach ($user->connections as $connection){
		//	echo($connection->first_name);
		

		 $user = User::find(2);
		foreach ($user->messages as $msg){
		  echo($msg);
		}
		
		
		
	}

	function showfavorite(){
		$user = auth()->user();
		return json_encode($user->favorites);

}

function showmatched(){
	$user = auth()->user();
	return json_encode($user->connections);

}



	function makefavorite(Request $request){
		$user = auth()->user();
        $fav = user_favorite::create([
			'from_user_id' => $user->id,
			'to_user_id' => $request->id,
		]);
		



}
}

?>