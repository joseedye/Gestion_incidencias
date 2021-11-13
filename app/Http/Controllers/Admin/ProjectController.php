<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(){
        $projects = project::withTrashed()->get();
        return view('admin.projects.index')->with(compact('projects'));
    }

    public function storeProject(Request $request){
        

        $this->validate($request,Project::$rules);
        project::create($request->all());
        return back()->with('notification','El proyecto se ha registrado correctamente.');

    }

    public function editProject($id){
        $project = project::find($id);
        $categories =$project->categories ;
        $levels = $project->levels;
        return view('admin.projects.edit')->with(compact('project','categories','levels'));
    }

    public function updateProject($id, Request $request){
        
        $this->validate($request,Project::$rules);  
        $project = Project::find($id);
        $project->name = $request->input('name');
        $project->descripcion = $request->input('descripcion');
        $project->start = $request->input('start');
        $project->save();
        
        return back()->with('notification','El proyecto se ha modificado correctamente.');
    }

    public function deleteProject($id){
        $project= project::find($id);
        $project->delete();
        return back()->with('notification','El proyecto ha sido eliminado correctamente.');
    }

    public function restoreProject($id){
        $project= project::withTrashed()->find($id)->restore();
        return back()->with('notification','El proyecto ha sido eliminado correctamente.');
    }

}
