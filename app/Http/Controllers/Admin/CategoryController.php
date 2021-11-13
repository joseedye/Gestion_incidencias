<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function storeCategory(Request $request){
        $this->validate($request,[
            'name'=>'required'
        ]);

        Category::create($request->all());
        return back();
    }

    public function updateCategory(Request $request){
        $this->validate($request,[
            'name'=>'required'
        ]);
        
        $category_id=$request->input('category_id');
        $category =Category::find($category_id);
        $category->name = $request->input('name');
        $category->save();
        return back();
    }

    public function deleteCategory($id){
        Category::find($id)->delete();
        return back();
    }
}
