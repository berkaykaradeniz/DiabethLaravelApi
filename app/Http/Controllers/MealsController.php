<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meals;

class MealsController extends Controller
{

    //TODO: CREATE TOKEN AND CHECK TOKEN EKLENECEK
    public function index()
    {
        return Meals::all();
    }

    public function get(Meals $meals){
        //user_id ve meal_date yollayarak günün öğününü getireceğim.
        $user_id = request('user_id');
        $meal_date = request('meal_date');
        $meals = $meals->where('meal_date', $meal_date)
                        ->where('user_id', $user_id)
                        ->get();
        if ($meals)
        {
            return $meals->toJson();
        }
        else{
            return response([
                'message' => 'Error',
                'status' => 0
            ], 201);
        }
    }

    public function getDay(Meals $meals){
        //user_id ve meal_date yollayarak günün öğününü getireceğim.
        $user_id = request('user_id');
        $start_meal_date = request('start_meal_date');
        $end_meal_date = request('end_meal_date');

        $meals = $meals->where('meal_date','>=', $start_meal_date)
                        ->where('meal_date','<=', $end_meal_date)
                        ->where('user_id', $user_id)
                        ->get();
        if ($meals)
        {
            return $meals->toJson();
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
            'meal_name' => 'required',
            'meal_date' => 'required',
            'user_id' => 'required',
        ]);
    
        $meal = Meals::create([//Get request and post this columns.
            'meal_date' => request('meal_date'),
            'meal_name' => request('meal_name'),
            'user_id' => request('user_id')
        ]);


        if (!$meal) {
            return response([
                'message' => ['The provided credentials are incorrect.'],
                'status' => 0
            ], 201);
        }else{
            return response([
                'message' => 'Meal Created',
                'status' => 1
            ], 200);
        }    
    }

    public function update(Meals $meal){
        request()->validate([//Request Controls needs to be add here.
            'meal_name' => 'required',
            'meal_date' => 'required',
        ]);
    
       $status = $meal->update([
            'meal_date' => request('meal_date'),
            'meal_name' => request('meal_name')
        ]);
    
        if ($status){
            return response([
                'message' => 'Meal Updated',
                'status' => 1
            ], 200);
        }
        else{
            return response([
                'message' => 'Meal Update Error',
                'status' => 0
            ], 201);
        }
    }

    public function delete(Meals $meal){
        $status = $meal->delete();

        if ($status){
            return response([
                'message' => 'Meal Deleted',
                'status' => 1
            ], 200);
        }
        else{
            return response([
                'message' => 'Meal Delete Error',
                'status' => 0
            ], 201);
        }
    }
}
