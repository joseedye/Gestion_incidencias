<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectUser;
use Illuminate\Http\Request;

class ProjectUserController extends Controller
{
    public function store(Request $request){

        $project_user=ProjectUser::exist($request);
        if($project_user)
            return back()->with('notification','El usuario ya pertenece a este proyecto');

        $project_user = new ProjectUser();

        $project_user->project_id = $request->input('project_id');
        $project_user->user_id = $request->input('user_id');
        $project_user->level_id = $request->input('level_id');
        $project_user->save();
        return back();
    }

    public function delete($id){
        ProjectUser::find($id)->delete();
        return back();
    }

}
