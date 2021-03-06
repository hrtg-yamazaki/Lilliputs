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

    public static function bulkUpdate($processes, $recipe){
        foreach($processes as $process_params){
            if (isset($process_params["id"])) {
                $process = self::find($process_params["id"]);
                if (isset($process_params["content"])) {
                    $process->content = $process_params["content"];
                    $process->update();
                } else {
                    $process->delete();
                }
            } else {
                if (isset($process_params["content"])) {
                    $process = new Process();
                    $process->content = $process_params["content"];
                    $process->recipe_id = $recipe->id;
                    $process->save();
                }
            }
        }
    }

}
