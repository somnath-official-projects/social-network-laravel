<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Models\FriendRequest;

class FriendRequestController extends Controller
{
    public function send(Request $request)
    {
        FriendRequest::create([
            'requested_by' => auth()->user()->id,
            'requested_to' => $request->requested_to
        ]);
        $url = '/view-profile/'.$request->requested_to;
        return redirect($url);
    }
    public function cancel(Request $request)
    {
        FriendRequest::where('requested_by',$request->requested_by)->where('requested_to', $request->requested_to)->delete();
        if(auth()->user()->id == $request->requested_by)
        {
            $url = '/view-profile/'.$request->requested_to;
        }
        else
        {
            $url = '/view-profile/'.$request->requested_by;
        }
        return redirect($url);
    }

    public function accept(Request $request)
    {
        FriendRequest::where('requested_by',$request->requested_by)->where('requested_to', $request->requested_to)->update(['status'=>1]);
        $url = '/view-profile/'.$request->requested_by;
        return redirect($url);
    }

    public function unfriend(Request $request)
    {
        FriendRequest::where('requested_by',$request->requested_by)->where('requested_to', $request->requested_to)->delete();
        if(auth()->user()->id == $request->requested_by)
        {
            $url = '/view-profile/'.$request->requested_to;
        }
        else
        {
            $url = '/view-profile/'.$request->requested_by;
        }
        return redirect($url);
        return redirect($url);
    }

    public function friendList()
    {
        // $friends = FriendRequest::join('users', 'users.id', 'friend_request.requested_to')
        //                             ->where('requested_by', auth()->user()->id)
        //                             ->orWhere('requested_to', auth()->user()->id)
        //                             ->select('users.name', 'users.email', 'users.id as user_id', 'friend_request.*')
        //                             ->get();
        $friendRequestSend = FriendRequest::join('users', 'users.id', 'friend_request.requested_to')
                                            ->where('requested_by', auth()->user()->id)
                                            ->select('users.name', 'users.email', 'users.id as user_id', 'friend_request.*')
                                            ->get();
        $friendRequestreceived = FriendRequest::join('users', 'users.id', 'friend_request.requested_to')
                                            ->where('requested_to', auth()->user()->id)
                                            ->select('users.name', 'users.email', 'users.id as user_id', 'friend_request.*')
                                            ->get();
        // Log::info($friendRequestSend);
        // Log::info($friendRequestreceived);
        return view('user.friendlist')->with(['friendRequestSend'=>$friendRequestSend, 'friendRequestreceived'=>$friendRequestreceived]);
    }
}
