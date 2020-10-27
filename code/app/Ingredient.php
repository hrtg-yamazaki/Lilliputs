<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{

    public function recipe(){
        return $this->belongsTo("App\Recipe");
    }

    public static function bulkSave($ingredients, $recipe){
        foreach($ingredients as $ingredient_params){
            $ingredient = new Ingredient();
            if ($ingredient_params["name"] && $ingredient_params["amount"]) {
                $ingredient->name = $ingredient_params["name"];
                $ingredient->amount = $ingredient_params["amount"];
                $ingredient->recipe_id = $recipe->id;
                $ingredient->save();
            }
        }
    }

    public static function fieldsForEdit($ingredients){
        $ingredientFields = [];
        for($i=0; $i<10; $i++){
            if (isset($ingredients[$i])) {
                $ingredientFields[] = $ingredients[$i];
            } else {
                $ingredientFields[] = [];
            }
        }
        return $ingredientFields;
    }

    public static function bulkUpdate($ingredients, $recipe){
        foreach($ingredients as $ingredient_params){
            if (isset($ingredient_params["id"])) {
                $ingredient = self::find($ingredient_params["id"]);
                if ($ingredient_params["name"] && $ingredient_params["amount"]) {
                    $ingredient->name = $ingredient_params["name"];
                    $ingredient->amount = $ingredient_params["amount"];
                    $ingredient->update();
                } else {
                    $ingredient->delete();
                }
            } else {
                if ($ingredient_params["name"] && $ingredient_params["amount"]) {
                    $ingredient = new Ingredient();
                    $ingredient->name = $ingredient_params["name"];
                    $ingredient->amount = $ingredient_params["amount"];
                    $ingredient->recipe_id = $recipe->id;
                    $ingredient->save();
                }
            }
        }
    }

}
