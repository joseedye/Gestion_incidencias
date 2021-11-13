<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Level extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'project_id'        
    ];

    public function project(){
        return $this->belongsTo('App\Models\Project'); 
     }

    public static function byProject($id){
        $level = Level::where('project_id',$id)->get();
        return $level;
    }
}
