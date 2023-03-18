<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; 
use App\Models\Flat;
use App\Models\Rating;

class HomeController extends Controller
{
    public function index(){
        $flat=Flat::paginate(9);
        return view('home.userpage',compact('flat'));
    }
    
    public function redirect(){
        $usertype=Auth::user()->usertype;

        if($usertype=='1'){
            return view('admin.home');
        }
        else{
            $flat=Flat::paginate(10);
            return view('home.userpage',compact('flat'));
        }
    }

    public function rate_flat($id){
        $flat=flat::find($id);
        return view('home.rate_flat',compact('flat'));
    }

    public function rate(Request $request){
        $flat_number = $request->flatID;
        $user = Auth::user();
        $user->flats()->attach($flat_number, [
            'water_rating' => $request->water_rating,
            'location_rating' => $request->location_rating,
            'price_rating' => $request->price_rating,
            'transportation_rating' => $request->transportation_rating,
            'cleanliness_rating' => $request->cleanliness_rating,
        ]);
        return redirect()->back();
    }

public function flat_search(Request $request){

    $search_text=$request->search;

    $flat=flat::where('title','LIKE',"%$search_text%")->orWhere('category','LIKE',"$search_text")->orWhere('rent','LIKE',"%$search_text%")->orWhere('location','LIKE',"%$search_text%")->paginate(9);

    return view('home.userpage',compact('flat'));
}

}
