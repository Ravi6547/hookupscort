<?php

namespace App\Http\Controllers;

use \App\Models\User;
use App\Http\Requests;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cites = [0 => '--select city--', 1 => 'Mohali', 2 => 'Chandigarh', 3 => 'Kharar'];
        $users = User::with(['images'])->get();
        $returnHTML = view('userList')->with(['users' => $users, 'cites' => $cites])->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }
    public function searchUser(Request $request)
    {

        $query = $request->get('query');
        $users = User::where('city',$query)->with(['images'])->get();
        if(empty($query)){
            $users = User::with(['images'])->get();
        }
        $returnHTML = view('userList')->with('users', $users)->render();
        return response()->json(array('success' => true, 'html'=>$returnHTML));
    }
}
