<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Process extends Model
{

    public function recipe(){
        return $this->belongsTo("App\Recipe");
    }


    public static function bulkSave($processes, $recipe){
        foreach($processes as $process_params){
            $process = new Process();
            if ($process_params["content"]) {
                $process->content = $process_params["content"];
                $process->recipe_id = $recipe->id;
                $process->save();
            }
        }
    }

}
