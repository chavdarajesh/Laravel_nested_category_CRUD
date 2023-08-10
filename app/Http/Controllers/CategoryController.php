<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;

class CategoryController extends Controller
{
    //
    public function index(Request $request,$id=null)
    {
        $categories= category::where('parent_category_id',$id)->get();
        return view('categories.list',['categories'=>$categories]);
    }
    public function create()
    {
        $categories = category::all();
        return view('categories.create',['categories'=>$categories]);
    }

    public function store(Request $request)
    {
        $data= $request->validate([
            'category_name' => 'required|string',
            'parent_category_id' => 'nullable|exists:categories,id'
        ]);
        $category=category::create($data);
        if($category){
            return redirect()->route('categories.list')->with('success','Category Added');
        }else{
            return redirect()->route('categories.list')->with('error','Something went wrong!');
        }
    }

    public function edit(Request $request,$id)
    {
        $category= category::find($id);
        $categories = category::where('id','!=',$id)->get();
        return view('categories.edit',['categories'=>$categories,'category'=>$category]);
    }

    public function update(Request $request,$id)
    {
        $data= $request->validate([
            'id'=>'required|exists:categories,id',
            'category_name' => 'required|string',
            'parent_category_id' => 'nullable|exists:categories,id'
        ]);


        $category=category::find($id);
        $category->category_name=$request->category_name;
        $category->parent_category_id=$request->parent_category_id;
        $category=$category->save();
        if($category){
            return redirect()->route('categories.list')->with('success','Category Updated');
        }else{
            return redirect()->route('categories.list')->with('error','Something went wrong!');
        }
    }


    public function delete(Request $request,$id)
    {
        if($id){
            $category= category::find($id);
            if($category){
                $this->deletechildren($category);
                $category->delete();
                return redirect()->route('categories.list')->with('success','Category Deleted');
            }else{
                return redirect()->route('categories.list')->with('error','Something went wrong!');
            }
        }else{
            return redirect()->route('categories.list')->with('error','Something went wrong!');
        }
    }
    protected function deletechildren(category $category)
    {
        foreach ($category->childern as $value) {
            $this->deletechildren($value);
            $value->delete();
        }
    }
}
