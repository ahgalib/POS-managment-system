<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class userCon extends Controller
{
    public function showUser(){
        $data = User::all();
        return view('user.user',['user'=>$data]);
    }

    public function saveUser(Request $req){
        $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'is_admin' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        User::create([
            'name' => $req['name'],
            'email' => $req['email'],
            'is_admin' => $req['is_admin'],
            'password' => Hash::make($req['password']),
        ]);
        return redirect('/userdata');
    }

    public function saveeditUser(Request $req,$id){
        $data = User::find($id);
        $data->update($req->all());
        return redirect('/userdata');
    }
}
