<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{

    public function user(){
        return $this->belongsTo("App\User");
    }
    public function maingred(){
        return $this->belongsTo("App\Maingred");
    }
    public function method(){
        return $this->belongsTo("App\Method");
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
            foreach ($recipe->processes()->get() as $process) {
                $process->delete();
            }
        });
    }

    public static function saveImage($requestFile)
    {
        if(\App::environment("local")){
            $fileName = $requestFile->store("public");
            $imagePath = str_replace("public/", "", $fileName);
        } else {
            $fileName = Storage::disk('s3')->put('', $requestFile);
            $imagePath = Storage::disk('s3')->url($fileName);
        }
        return $imagePath;
    }

}
