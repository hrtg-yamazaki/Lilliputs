<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{

    public function user(){
        return $this->belongsTo("App\User");
    }

    public function ingredients(){
        return $this->hasMany("App\Ingredient");
    }

    public function processes(){
        return $this->hasMany("App\Process");
    }

    protected static function boot() 
    {
        parent::boot();
        static::deleting(function($recipe) {
            foreach ($recipe->ingredients()->get() as $ingredient) {
                $ingredient->delete();
            }
        });
    }

}
