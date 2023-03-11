<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Flat;

class AdminController extends Controller
{
    public function view_category(){

        $data=category::all();
        return view('admin.category',compact('data'));
    }

    public function add_category(Request $request){
        $data=new category;

        $data->category_name=$request->category;

        $data->save();

        return redirect()->back()->with('Message','Category Added successfully.');
    }

    public function delete_category($id){

        $data=category::find($id);

        $data->delete();

        return redirect()->back();

    }


    public function add_flat(){

        $category=category::all();
        return view('admin.flat',compact('category'));

    }

    public function show_flat(Request $request){
        
          $flat=new flat;

          $flat->title=$request->title;

          $flat->description=$request->description;

          $flat->rent=$request->rent;

          

          $flat->category=$request->category;

          $image=$request->image;
          $imagename=time().'.'.$image->getClientOriginalExtension();

          $request->image->move('flat',$imagename);

          $flat->image=$imagename;

          $flat->save();

          return redirect()->back();
    }
}
