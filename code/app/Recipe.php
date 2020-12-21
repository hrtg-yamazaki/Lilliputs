<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use IntervenedImage;
use Storage;

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
        $resizedFile = IntervenedImage::make($requestFile)
                            ->resize(1080, null, function($constraint) {
                                    $constraint->aspectRatio();
                                }
                            );
        if (\App::environment("local")) {
            $imagePath = $requestFile->getClientOriginalName();
            $resizedFile->save(storage_path("app/public/".$imagePath));
        } else {
            $hashName = $requestFile->hashName();
            Storage::disk('s3')->put(
                $hashName, (string)$resizedFile->encode(), "public"
            );
            $imagePath = Storage::disk('s3')->url($hashName);
        }
        return $imagePath;
    }

}
