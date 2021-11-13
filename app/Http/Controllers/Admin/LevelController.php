<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function storeLevel(Request $request){
        $this->validate($request,[
            'name'=>'required'
        ]);

        Level::create($request->all());
        return back();
    }

    public function updateLevel(Request $request){
        $this->validate($request,[
            'name'=>'required'
        ]);
        
        $level_id=$request->input('level_id');
        $level =Level::find($level_id);
        $level->name = $request->input('name');
        $level->save();
        return back();
    }

    public function deleteLevel($id){
        Level::find($id)->delete();
        return back();
    }

    public function byProject($id){
        return Level:: byProject($id);
    }
}
