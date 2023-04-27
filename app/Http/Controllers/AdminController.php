<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

use App\Models\Flat;
use App\Models\User;
use App\Models\Rating;
use App\Models\Order;
use PDF;

use App\Models\Rent;

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
        $flat = new Flat;  
        $flat->title=$request->title;

          $flat->description=$request->description;
          $flat->location=$request->location;

          $flat->rent=$request->rent;
         
          $flat->phone=$request->phone;
          $flat->category=$request->category;
          $flat->tenants_quantity=$request->tenants_quantity;

          $image=$request->image;
          $imagename=time().'.'.$image->getClientOriginalExtension();

          $request->image->move('flat',$imagename);

          $flat->image=$imagename;

          $flat->save();
          return redirect()->back();
    }


    public function view_flat(){

        $flat=flat::all();
        return view('admin.view_flat',compact('flat'));
    }
   public function delete_flat($id){

    $flat=flat::find($id);

    $flat->delete();

    return redirect()->back();


   }

   public function update_flat($id){
    $flat=flat::find($id);

   $category=category::all();

    return view('admin.update_flat',compact('flat','category'));
    

   }

   public function update_flat_confirm(Request $request,$id){
    $flat=flat::find($id);

    $flat->title=$request->title;
    $flat->description=$request->description;
    $flat->rent=$request->rent;
    $flat->location=$request->location;
    $flat->category=$request->category;
    $flat->tenants_quantity=$request->tenants_quantity;


    $image=$request->image;

    if($image){

        $imagename=time().'.'.$image->getClientOriginalExtension();

        $request->image->move('flat',$imagename);
        $flat->image=$imagename;
    }
   

    $flat->save();
    return redirect()->back();

   }

   public function order(){

    $order= rent::all();

    return view('admin.order',compact('order'));

   }

   public function print_pdf($id){

    $rent=rent::find($id);
     
    $pdf=PDF::loadView('admin.pdf',compact('rent'));

    return $pdf->download('rent_details.pdf');

   }
}
