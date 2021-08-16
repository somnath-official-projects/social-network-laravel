<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInfo;
use App\Models\User;
use Log;
use App\Models\FriendRequest;
use DB;

class UserProfileController extends Controller
{
    public function index($id)
    {
        $userInfo = User::leftJoin('user_info as ui', 'ui.user_id', 'users.id')
                    ->where('users.id', $id)
                    ->select('users.id as user_id', 'users.name', 'users.email', 'ui.phone', 'ui.address', 'ui.about')
                    ->get();
        $userId = auth()->user()->id;
        $query = "SELECT * FROM friend_request WHERE (requested_to = {$userId} OR requested_by = {$userId}) AND (requested_to = {$id} OR requested_by = {$id})";
        $friend_request = DB::select($query);
        $query = "SELECT fr.*, uto.name AS user_requested_to, uby.name AS user_requested_by FROM friend_request AS fr LEFT JOIN users uto ON uto.id = fr.requested_to LEFT JOIN users uby ON uby.id = fr.requested_by WHERE fr.STATUS=1 AND (fr.requested_by = {$id} OR fr.requested_to = {$id})";
        $mutualFriends = DB::select($query);
        return view('user_profile.index')->with(['userInfo'=>$userInfo, 'friend_request'=>$friend_request, 'mutualFriends'=>$mutualFriends]);
    }
}
