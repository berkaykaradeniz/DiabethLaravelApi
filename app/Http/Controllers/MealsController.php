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
            return [
                'status' => 'Fail'
            ];  
        }
    }

   public function store(){
       
    request()->validate([//Request Controls needs to be add here.
            'meal_name' => 'required',
            'meal_date' => 'required',
            'user_id' => 'required',
        ]);
    
        return Meals::create([//Get request and post this columns.
            'meal_date' => request('meal_date'),
            'meal_name' => request('meal_name'),
            'user_id' => request('user_id')
        ]);
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
    
        return [
            'status' => $status
        ];
    }

    public function delete(Meals $meal){
        $status = $meal->delete();

        return [
            'status' => $status
        ];
    }
}
