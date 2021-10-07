<?php
namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Auth;
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
use phpDocumentor\Reflection\Types\Null_;

class UserController extends Controller{
	
//returns all users that their gender is as the intrested_in gender of the current user 
//and they are not favorite or matched or blocked 
function allusers(){
	$u =  auth()->user();
	$gender =$u->interested_in;
	$me  = ["0"=>$u->id];
	$blocked  = $u->blocked->pluck('id')->toArray();
	$matchs  = $u->connections->pluck('id')->toArray();
	$favs  = $u->favorites->pluck('id')->toArray();

	$users = User::where('gender',$gender)
	               ->whereNotIn('id',$me)
	               ->whereNotIn('id',$blocked)
				   ->whereNotIn('id',$matchs)
				   ->whereNotIn('id',$favs)
				   ->get()->toArray();
	$i=0;
	foreach($users as $user){
		$profile_pic = User::find($user['id'])->pictures
	                                    	->where('is_profile_picture',1)
		                                    ->values();
		$user["pic_url"] = $profile_pic[0]->picture_url;
		$users[$i] =$user;
        $i++;
	}
    return json_encode($users);
	
}
function showfavorites(){
	    $user = auth()->user();
		$favs  = $user->favorites;
		$i=0;
		foreach ($favs as $fav ){
			$favuser = User::find($fav->id);
			$profile_pic = User::find($fav->id)->pictures
			                       ->where('is_profile_picture',1)
								   ->values();
		    $favuser['pic_url']	= $profile_pic[0]->picture_url;			   
		    $favusers[$i] = $favuser;
			$i++;
		}

	    return json_encode($favusers);

}

function showmatched(){
	$user = auth()->user();
	$matchs  = $user->connections;
		$i=0;
		foreach ($matchs as $match ){
			$matchuser = User::find($match->id);
			$profile_pic = User::find($match->id)->pictures
			                       ->where('is_profile_picture',1)
								   ->values();
			$matchuser['pic_url']	= $profile_pic[0]->picture_url;			   
		    $matchusers[$i] = $matchuser;
			$i++;
		}

	    return json_encode($matchusers);
}

function showBlocked(){
	$user = auth()->user();
	$allblocked  = $user->blocked;
		$i=0;
		foreach ($allblocked as $blocked ){
			$blockeduser = User::find($blocked->id);
			$profile_pic = User::find($blocked->id)->pictures
			                       ->where('is_profile_picture',1)
								   ->values();
			$blockeduser['pic_url']	= $profile_pic[0]->picture_url;			   
		    $blockedusers[$i] = $blockeduser;
			$i++;
		}

	    return json_encode($blockedusers);

}

function notifications(){
	$user = auth()->user();
	return json_encode($user->notifs);

}
//the current user can see all his pictures even the not approved yet
function mypictures(){
	$user = auth()->user();
	return json_encode($user->pictures);
}

//displays the pictures of other user that are approved and not profile
function userpictures(Request $request){
	$approved_pics = User::find($request->id)->pictures
	 										 ->where('is_profile_picture',0)
	                                         ->where('is_approved',1)
											 ->values();
	return json_encode($approved_pics);
}


function myprofile(){
	$user = auth()->user();
	$profile_pic =User::find($user->id)->pictures
	                     ->where('is_profile_picture',1)
						 ->values();
	$pic_url= $profile_pic[0]->picture_url;	
	$user['pic_url'] = $pic_url;
	return json_encode($user);
	
}

function editprofile(Request $request){
	$u = auth()->user();
	$user = User::find($u->id);
	$user->first_name = $request->first_name;
	$user->last_name = $request->last_name;
	$user->gender = $request->gender;
	$user->interested_in = $request->interested_in;
	$user->dob = $request->dob;
	$user->height = $request->height;
	$user->weight = $request->weight;
	$user->nationality = $request->nationality;
	$user->bio = $request->bio;

	$user->save();
	
}

function userprofile(Request $request){
	$user = User::find($request->id);
	$profile_pic =User::find($request->id)->pictures
	                     ->where('is_profile_picture',1)
						 ->values();
	$pic_url= $profile_pic[0]->picture_url;	
	$user['pic_url'] = $pic_url;
	return json_encode($user);
	
}

function makefavorite(Request $request){
	   $user = auth()->user();
       $favback = user_favorite::where('from_user_id',$request->id)
		                              ->where('to_user_id',$user->id)
									  ->get()->toArray();
				
		if(sizeof($favback) != 0){
			
			user_favorite::create([
				'from_user_id' =>$user->id,
				'to_user_id' => $request->id,
			]);
			user_connection::create([
				'user1_id' =>$user->id,
				'user2_id' => $request->id,
			]);
			user_notification::create([
					'user_id' =>$request->id,
					'body' => "You and ".$user->first_name." ".$user->last_name." are now matched",
				]);
			
		}
		else {

            user_favorite::create([
				'from_user_id' =>$user->id,
				'to_user_id' => $request->id,
			]);
			user_notification::create([
					'user_id' =>$request->id,
					'body' => $user->first_name." ".$user->last_name." favorite you",
				]);

		}

	
}

function block(Request $request){
		$user = auth()->user();
		$block = user_blocked::create([
		'from_user_id' => $user->id,
		'to_user_id' => $request->id,
			]);
}
function unblock(Request $request){
	$user = auth()->user();
	user_blocked::where('from_user_id', $user->id)
                 ->where('to_user_id', $request->id)
                 ->delete();
}
}

?>