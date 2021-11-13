<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    protected $table = 'project_user';

    public function project(){
        return $this->belongsTo('App\Models\Project');
    }

    public function level(){
        return $this->belongsTo('App\Models\Level');
    }

    public static function exist($request){
        $project_id = $request->input('project_id');
        $user_id = $request->input('user_id');
        $project_user= ProjectUser::where('project_id',$project_id)
                                    ->where('user_id',$user_id)->first();
        return $project_user;
    }
    
}
