<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Dusers;


class DuserController extends Controller
{
    public function index()
    {
        //
    }

    public function get(Dusers $user){
        $user_id = request('id');
        $users = $user->find($user_id);
        if ($users)
        {
            return [
                'name' => $users->name,
                'email' => $users->email,
                'status' => 1
            ];
        }
        else{
            return [
                'status' => 'Fail'
            ];  
        }
    }
    public function login(Dusers $user){
        $email = request('email');
        $password = request('password');
        $users = $user->where('email',$email)->first();

        $pass = $users->password ?? 0;
        //Bakılacak
        if ($pass == 0)
        {
            return [
                'status' => 0,
                'message' => 'Kullanıcı hesabı mevcut değil'
            ]; 
        }
        else if (Hash::check($password, $pass)) 
        {
            return [
                'id' => $users->id,
                'email' => $users->email,
                'status' => 1,
                'message' => 'Giriş başarılı'
            ];
        }
        else{
            return [
                'status' => 0,
                'message' => 'Email veya Şifre hatalı'
            ];  
        }
    }

   public function store(){
    request()->validate([//Request Controls needs to be add here.
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email|unique:dusers',
            'password' => 'required'
        ]);
        $password = request('password');
        $user = Dusers::create([//Get request and post this columns.
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
        
        if (!$user) {
            return response([
                'message' => ['The provided credentials are incorrect.'. request('name')]
            ], 500);
        }
    
        return response(['status' => 1], 200);
    }

    public function delete(Dusers $user){
        $status = $user->delete();

        return [
            'status' => $status
        ];
    }
}
