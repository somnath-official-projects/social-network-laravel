<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Models\UserInfo;
use App\Models\User;

class AccountController extends Controller
{
    public function index()
    {
        $userId = auth()->user()->id;
        $userInfo = UserInfo::where('user_id', $userId)->get();
        return view('user.account')->with(['userInfo'=>$userInfo]);
    }

    public function edit()
    {
        $userId = auth()->user()->id;
        $userInfo = UserInfo::where('user_id', $userId)->get();
        return view('user.edit_account')->with(['userInfo'=>$userInfo]);
    }

    public function update(Request $request)
    {
        User::find(auth()->user()->id)->update(['name'=>$request->name]);
        $userinfo = UserInfo::where('user_id', auth()->user()->id)
                    ->get();
        if(sizeof($userinfo))
        {
            UserInfo::where('user_id', auth()->user()->id)
                    ->update([
                        'address'=> $request->address,
                        'phone'=> $request->phone,
                        'about'=> $request->about,
                        'user_id'=> auth()->user()->id
                    ]);
        }
        else
        {
            UserInfo::where('user_id', auth()->user()->id)
                    ->create([
                        'address'=> $request->address,
                        'phone'=> $request->phone,
                        'about'=> $request->about,
                        'user_id'=> auth()->user()->id
                    ]);
        }
        return redirect('/user/account');
    }
}
