<?php
namespace App\Http\Controllers\AdminAPI;
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
use App\Models\user_message;
use App\Models\user_type;
use App\Models\user_favorite;
use phpDocumentor\Reflection\Types\Null_;

class HomeController extends Controller{
	
//returns all users that their gender is as the intrested_in gender of the current user 



function approvePic(Request $request){
	$pic = user_picture::find($request->id);
	$pic->is_approved = 1;
	$pic->save();
	return redirect()->route("admin");
}

function approveMsg(Request $request){
	$msg = user_message::find($request->id);
	$msg->is_approved = 1;
	$msg->save();
	return redirect()->route("adminmsgs");
}

function declinePic(Request $request){
	user_picture::where('id', $request->id)
                 ->delete();
    return redirect()->route("admin");
}
function declineMsg(Request $request){
	user_message::where('id', $request->id)
                 ->delete();
     return redirect()->route("adminmsgs");
}



}

?>