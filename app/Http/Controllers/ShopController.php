<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class ShopController extends Controller
{


    public function index(){

        $ingredients = Ingredient::select('name','capacity','durability','flavor','texture','calories')->where('in_pantry',1)->get();
        

        $best_cookies = $this->makeBestCookie($ingredients);


        $best_diet_cookies = $this->makeBestCookie($ingredients, true);


        return view( 'shop.index', compact('ingredients', 'best_cookies', 'best_diet_cookies'));

    }




    //Recipe to make the best cookie, default is a any-calories cookie
    public function makeBestCookie($ingredients, $diet = false){
        $best_score = 0;

        $best_recipe = [0,0,0,100];

        $total_ingredients = $ingredients->count();

        $possible_recipes = $this->combineIngredients($total_ingredients, 0, 100);
        

        foreach($possible_recipes as $recipe){

            //should use every ingredient
            if(!collect($recipe)->contains(0)){
                $score = $this->calculateScore($ingredients,$recipe, $diet);
    
                if($score > $best_score){
                    $best_score = $score;
                    $best_recipe = $recipe;
                }
            }
        }

        $best_outcome = [$best_score, $best_recipe];
       

        return collect($best_outcome);
    }


    public function combineIngredients($quantity, $former_sum, $max_sum){
        if($quantity == 1){
            return [[$max_sum - $former_sum]];
        }

        $recipe = [];

        for($current_quantity = 0; $current_quantity <= $max_sum - $former_sum; $current_quantity++){
            $temp_recipe = $this->combineIngredients($quantity - 1, $former_sum + $current_quantity, $max_sum);

            for($i = 0; $i < count($temp_recipe); $i++){
                array_unshift($temp_recipe[$i], $current_quantity);

                array_push($recipe,$temp_recipe[$i]);
            }
        }

        return $recipe;

    }


    public function calculateScore($ingredients, $recipe, $diet){


        $result = 1;

        $sum = 0;

        if($diet){
            for($j = 0; $j < count($recipe); $j++){
                $sum+= $ingredients[$j]['calories'] * $recipe[$j];
    
            }
            
            if($sum != 500){
                return  0;
            }
        }


        for($j = 0; $j < count($recipe); $j++){

            $sum+= $ingredients[$j]['capacity'] * $recipe[$j];

        }


        if($sum > 0){
            $result *= $sum;
        }else{
            return  0;
        }

        $sum = 0;


        for($j = 0; $j < count($recipe); $j++){

            $sum+= $ingredients[$j]['durability'] * $recipe[$j];

        }

        if($sum > 0){
            $result *= $sum;
        }else{
            return  0;
        }

        $sum = 0;


        for($j = 0; $j < count($recipe); $j++){

            $sum+= $ingredients[$j]['texture'] * $recipe[$j];

        }

        if($sum > 0){
            $result *= $sum;
        }else{
            return  0;
        }

        $sum = 0;


        for($j = 0; $j < count($recipe); $j++){

            $sum+= $ingredients[$j]['flavor'] * $recipe[$j];

        }

        if($sum > 0){
            $result *= $sum;
        }else{
            return  0;
        }

        $sum = 0;

        

        return $result;
        
    }

}
