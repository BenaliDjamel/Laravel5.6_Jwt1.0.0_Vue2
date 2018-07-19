<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function all() {
        $users = User::all();
        return response()->json(['users'=> $users],200);
    }
    public function delete($id) {
        $user = User::whereId($id)->first();
        $user->delete();
        return  response()->json(['user'=> $user],200);
    }

    public function getUser($id) {
        return response()->json(['user' => User::whereId($id)->first()],200);
    } 

    public function updateUser(Request $request, $id)  {
        $user = User::whereId($id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return response()->json(['user' =>  User::whereId($id)->first()],200);

    }
}
