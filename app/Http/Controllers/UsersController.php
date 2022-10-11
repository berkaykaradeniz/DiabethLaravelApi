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


    public function get(Users $user){
        $user_id = request('id');
        $users = $user->find($user_id);
        if ($users)
        {
            return [
                'name' => $users->name,
                'email' => $users->email,
                'status' => 'Success'
            ];
        }
        else{
            return [
                'status' => 'Fail'
            ];  
        }
    }
    public function login(Users $user){
        $email = request('email');
        $hashed = Hash::make(request('password'));

        $true = bcrypt(request('password'));
      
        $users = $user
                    ->select('id','email','password')
                    ->where([
                                ['email', '=' , $email]
                            ])->first();

                            return $true . ' - ' . $users->password;
        //Bakılacak
        if ($users && $true)
        {
            return [
                'id' => $users->id,
                'email' => $users->email,
                'status' => "1"
            ];
        }
        else{
            return [
                'status' => "0"
            ];  
        }
    }

   public function store(){
    request()->validate([//Request Controls needs to be add here.
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);
        $password = request('password');
        return Users::create([//Get request and post this columns.
            'name' => request('name'),
            'surname' => request('surname'),
            'email' => request('email'),
            'password' => Hash::make($password),
            'phone_number' => request('phone_number'),
            'birth_date' => request('birth_date'),
            'sexuality' => request('sexuality'),
            'length' => request('length'),
            'kilo' => request('kilo')
        ]);
    }

    public function delete(Users $user){
        $status = $user->delete();

        return [
            'status' => $status
        ];
    }
}
