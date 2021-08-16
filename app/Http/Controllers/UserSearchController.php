<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Models\User;
use DB;

class UserSearchController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->user()->id;
        $qeury = "select * from users where id != {$userId} AND (`name` LIKE '%{$request->searchParam}%' or `email` LIKE '%{$request->searchParam}%')";
        $users = DB::select($qeury);
        return response()->json($users);
    }
}
