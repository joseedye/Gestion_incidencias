<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Incident;
use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class IncidentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function getReport() {
        $categories =Category::where('project_id',1)->get();
        return view('incidents.create')->with(compact('categories'));
    }

    public function storeReport(Request $request) {
        
        $rules=[
            'category_id'   =>'sometimes|exists:categories,id',
            'severity'      =>'required|in:M,N,A',
            'title'         =>'required|min:5',
            'descripcion'   =>'required|min:15',
            'file'          =>'required|image'
        ];
        $this->validate($request,$rules);

        $incident = new Incident();
        $incident->category_id = $request->input('category_id') ?: null;
        $incident->severity = $request->input('severity');
        $incident->title = $request->input('title');
        $incident->descripcion= $request->input('descripcion');
        // $anexo = $request->file('file')->store('public/anexos');
        // $incident->url = Storage::url($anexo); 
        $nombre = Str::random(10) . $request->file('file')->getClientOriginalName();
        
        $ruta = storage_path() . '\app\public\anexos/' . $nombre;

        Image::make($request->file('file'))
                ->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->save($ruta);
        
        $incident->url = $nombre;
        $user =auth()->user();
        $incident->client_id = $user->id;
        $incident->project_id = $user->selected_project_id;
        $incident->level_id = Project::find($user->selected_project_id)->first_level_id;
        $incident->save();
        return redirect()->route('home');
    }

    // public function storeAnnexes(Request $request, $id){
    //     $user =auth()->user();
    //     $incident = Incident::findOrFail($id);
    //     $nombre = Str::random(10) . $request->file('file')->getClientOriginalName();
        
    //     $ruta = storage_path() . '\app\public\anexos/' . $nombre;

    //     Image::make($request->file('file'))
    //             ->resize(1200, null, function ($constraint) {
    //                 $constraint->aspectRatio();
    //             })
    //             ->save($ruta);
        
    //     $incident->url = '\anexos/' . $nombre; 
    // }

    public function deleteIncident($id){
        $incident= Incident::find($id);
        if($incident->support_id==null){
            $incident->delete();
            return back()->with('notification','El Incidente ha sido eliminado correctamente.');
        }else{
            return back()->with('notification','El Incidente ya ha sido asigando.');
        }
    }

    public function showReport($id){
        $user =auth()->user();
        $incident = Incident::findOrFail($id);
        if($user->id == $incident->client_id || $user->id == $incident->support_id || $user->role == 0 || $user->role == 1) {        
        $messages = $incident->messages;
        return view('incidents.show')->with(compact('incident','messages'));
        }else{
            abort(403);
        }
    }

    public function show(){
        $user =auth()->user();
        $incidents = Incident::all();    
        //$messages = $incidents->messages;
        return view('incidents.showAll')->with(compact('incidents'));
        
    }

    public function edit($id)
    {
        $incident = Incident::findOrFail($id);
        $categories = $incident->project->categories;
        return view('incidents.edit')->with(compact('incident', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, Incident::$rules, Incident::$messages);

        $incident = Incident::findOrFail($id);

        $incident->category_id = $request->input('category_id') ?: null;
        $incident->severity = $request->input('severity');
        $incident->title = $request->input('title');
        $incident->description = $request->input('description');

        $incident->save();
        return redirect("/ver/$id");        
    }

    public function take($id)
    {
        $user = auth()->user();

        if (! $user->is_support)
            return back();

        $incident = Incident::findOrFail($id);

        // There is a relationship between user and project?
        $project_user = ProjectUser::where('project_id', $incident->project_id)
                                        ->where('user_id', $user->id)->first();

        if (! $project_user)
            return back();

        // The level is the same?
        if ($project_user->level_id != $incident->level_id)
            return back();
        
        $incident->support_id = $user->id;
        $incident->save();

        return back();
    }

    public function solve($id)
    {
        $incident = Incident::findOrFail($id);

        // Is the user authenticated the author of the incident?
        if ($incident->support_id != auth()->user()->id)
            return back();
           
        $incident->active = 0; // false
        $incident->save();

        return back();
    }

    public function desist($id){
        $incident = Incident::findOrFail($id);
        if ($incident->support_id != auth()->user()->id)
            return back();
           
        $incident->support_id = null; // false
        $incident->save();

        return redirect()->route('home');
    }
    
    public function open($id)
    {
        $incident = Incident::findOrFail($id);

        // Is the user authenticated the author of the incident?
        if ($incident->support_id != auth()->user()->id)
            return back();
           
        $incident->active = 1; // true
        $incident->save();

        return back();
    }

    public function nextLevel($id)
    {
        $incident = Incident::findOrFail($id);
        $level_id = $incident->level_id;

        $project = $incident->project;
        $levels = $project->levels;

        $next_level_id = $this->getNextLevelId($level_id, $levels);

        if ($next_level_id) {
            $incident->level_id = $next_level_id;
            $incident->support_id = null;
            $incident->save();
            return back();
        }

        return back()->with('notification', 'No es posible derivar porque no hay un siguiente nivel.');
    }

    public function getNextLevelId($level_id, $levels)
    {
        if (sizeof($levels) <= 1)
            return null;

        $position = -1;
        for ($i=0; $i<sizeof($levels)-1; $i++) { // -1
            if ($levels[$i]->id == $level_id) {
                $position = $i;
                break;
            }
        }

        if ($position == -1)
            return null;

        // if ($position == sizeof($levels)-1)
        //     return null;

        return $levels[$position+1]->id;
    }

    public function download($id){
        //$incident = Incident::findOrFail($id);
        $incident = Incident::where('url', $id)->firstOrFail();
        //dd($incident->url);
        $pathToFile = storage_path("app/public/anexos/" . $incident->url);
        //dd($pathToFile);
        //return $pathToFile;
        return response()->download($pathToFile);
    }
}
