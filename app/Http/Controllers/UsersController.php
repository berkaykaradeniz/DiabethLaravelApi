<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Users;


class UsersController extends Controller
{
    public function index()
    {
        //
    }

   public function store(){
       
    request()->validate([//Request Controls needs to be add here.
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);
        $password = Hash::make(request('password'), ['memory' => 1024, 'time' => 2,'threads' => 2]);
        return Users::create([//Get request and post this columns.
            'name' => request('name'),
            'email' => request('email'),
            'password' => $password
        ]);
    }

    public function delete(Users $user){
        $status = $user->delete();

        return [
            'status' => $status
        ];
    }
}
