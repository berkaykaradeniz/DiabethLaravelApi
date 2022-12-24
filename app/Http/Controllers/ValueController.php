<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Values;

class ValueController extends Controller
{

    //TODO: CREATE TOKEN AND CHECK TOKEN EKLENECEK
    public function index()
    {
        return Values::all();
    }

    public function get(Values $value){
        //user_id ve value_date yollayarak günün öğününü getireceğim.
        $user_id = request('user_id');
        $value_date = request('value_date');
        $value = $value->where('value_date', $value_date)
                        ->where('user_id', $user_id)
                        ->get();
        if ($value)
        {
            return $value->toJson();
        }
        else{
            return response([
                'message' => 'Error',
                'status' => 0
            ], 201);
        }
    }

    public function getDay(Values $value){
        //user_id ve value_date yollayarak günün öğününü getireceğim.
        $user_id = request('user_id');
        $start_value_date = request('start_value_date');
        $end_value_date = request('end_value_date');

        $value = $value->where('value_date','>=', $start_value_date)
                        ->where('value_date','<=', $end_value_date)
                        ->where('user_id', $user_id)
                        ->get();
        if ($value)
        {
            return $value->toJson();
        }
        else{
            return response([
                'message' => 'Error',
                'status' => 0
            ], 201);
        }
    }

   public function store(){
        request()->validate([//Request Controls needs to be add here.
            'value_date' => 'required',
            'user_id' => 'required',
        ]);

        $value = Values::create([//Get request and post this columns.
            'deviation' => request('deviation'),
            'average' => request('average'),
            'hiper' => request('hiper'),
            'hipo' => request('hipo'),
            'value_date' => request('value_date'),
            'user_id' => request('user_id')
        ]);

        if (!$value) {
            return response([
                'message' => ['The provided credentials are incorrect.'],
                'status' => 0
            ], 201);
        }else{
            return response([
                'message' => 'Value Created',
                'status' => 1
            ], 200);
        }    
    }

    public function update(Values $value){
        request()->validate([//Request Controls needs to be add here.
            'value_date' => 'required',
        ]);
    
       $status = $value->update([
            'deviation' => request('deviation'),
            'hiper' => request('hiper'),
            'hipo' => request('hipo'),
            'value_name' => request('value_name')
        ]);
    
        if ($status){
            return response([
                'message' => 'Value Updated',
                'status' => 1
            ], 200);
        }
        else{
            return response([
                'message' => 'Value Update Error',
                'status' => 0
            ], 201);
        }
    }

    public function delete(Values $value){
        $status = $value->delete();

        if ($status){
            return response([
                'message' => 'Value Deleted',
                'status' => 1
            ], 200);
        }
        else{
            return response([
                'message' => 'Value Delete Error',
                'status' => 0
            ], 201);
        }
    }
}
