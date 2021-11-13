<?php

namespace App\Http\Controllers;


use App\Models\Incident;
use App\Models\ProjectUser;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user =auth()->user();
        $selected_project_id = $user->selected_project_id;
        //dd($user);
        if ($selected_project_id) {

            if ($user->is_support) {
                $my_incidents = Incident::where('project_id', $selected_project_id)
                                        ->where('support_id', $user->id)->get();
                //dd($user->selected_project_id);                        

                $projectUser = ProjectUser::where('project_id', $selected_project_id)
                                            ->where('user_id', $user->id)->first();

                if ($projectUser) {
                    $pending_incidents = Incident::where('support_id', null)
                                                ->where('level_id', $projectUser->level_id)->get();
                } else {
                    $pending_incidents = collect(); // empty when no project associated
                }

                $incidents_by_me = Incident::where('client_id', $user->id)
                                        ->where('project_id', $selected_project_id)->get();
            }else{
                $my_incidents = [];
                $pending_incidents = [];
                
                $incidents_by_me = Incident::where('client_id', $user->id)
                                        ->where('project_id', $selected_project_id)->get();
                
            }

            // $incidents_by_me = Incident::where('client_id', $user->id)
            //                             ->where('project_id', $selected_project_id)->get();
        
        } else {
            $my_incidents = [];
            $pending_incidents = [];
            $incidents_by_me = [];
        }

        return view('home')->with(compact('my_incidents', 'pending_incidents', 'incidents_by_me'));
    }

    public function SelectProject($id){
        $user = auth()->user();
        $user->selected_project_id = $id;
        $user->save();
        return back();
    }

    
}
