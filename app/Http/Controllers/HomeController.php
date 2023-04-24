<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Flat;
use App\Models\Rating;
use App\Models\Cart;

use Session;
use Stripe;

use App\Models\Rent;

class HomeController extends Controller
{
    public function index()
    {
        $flat = Flat::paginate(9);
        return view('home.userpage', compact('flat'));
    }

    public function redirect()
    {
        $usertype = Auth::user()->usertype;

        if ($usertype == '1') {
            return view('admin.home');
        } else {
            $flat = Flat::paginate(10);
            return view('home.userpage', compact('flat'));
        }
    }

    public function rate_flat($id)
    {
        $flat = flat::find($id);
        return view('home.rate_flat', compact('flat'));
    }

    public function rate(Request $request)
    {
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

    public function flat_search(Request $request)
    {

        $search_text = $request->search;

        $flat = flat::where('title', 'LIKE', "%$search_text%")->orWhere('category', 'LIKE', "$search_text")->orWhere('rent', 'LIKE', "%$search_text%")->orWhere('location', 'LIKE', "%$search_text%")->paginate(9);

        return view('home.userpage', compact('flat'));
    }

    public function flat_details($id)
    {

        $flat = flat::find($id);

        return view('home.flat_details', compact('flat'));

    }

    public function rent(Request $request, $id)
    {


        if (Auth::id()) {
            $user = Auth::user();

            $flat = flat::find($id);
            $flat = flat::find($id);

            $cart = new cart;

            $cart->name = $user->name;

            $cart->email = $user->email;

            $cart->phone = $user->phone;

            $cart->address = $user->address;

            $cart->user_id = $user->id;

            $cart->flat_title = $flat->title;

            $cart->rent = $flat->rent;

            $cart->image = $flat->image;

            $cart->flat_id = $flat->id;

            $cart->save();

            return redirect()->back();


        } else {
            return redirect('login');
        }
    }

    public function show_cart()
    {


        if (Auth::id()) {


            $id = Auth::user()->id;

            $cart = cart::where('user_id', '=', $id)->get();
            return view('home.showcart', compact('cart'));

        } else {
            return redirect('login');
        }

    }

    public function recommendations()
    {


        if (Auth::id()) {


        } else {
            return redirect('login');
        }

    }


    public function remove_cart($id)
    {

        $cart = cart::find($id);

        $cart->delete();

        return redirect()->back();



    }
    public function cash_rent()
    {

        $user = Auth::user();

        $userid = $user->id;

        $data = cart::where('user_id', '=', $userid)->get();

        foreach ($data as $data) {

            $rent = new rent;

            $rent->name = $data->name;
            $rent->email = $data->email;
            $rent->phone = $data->phone;
            $rent->address = $data->address;
            $rent->user_id = $data->user_id;
            $rent->flat_title = $data->flat_title;

            $rent->rent = $data->rent;
            $rent->image = $data->image;
            $rent->flat_id = $data->flat_id;

            $rent->payment_status = "Cash Payment";


            $rent->save();

            $cart_id = $data->id;

            $cart = cart::find($cart_id);

            $cart->delete();


        }
        return redirect()->back();

    }

    public function stripe($totalrent)
    {


        return view('home.stripe', compact('totalrent'));
    }

    public function stripePost(Request $request, $totalrent)
    {


        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        Stripe\Charge::create([
            "amount" => $totalrent * 100,
            "currency" => "usd",
            "source" => $request->stripeToken,
            "description" => "Thanks for the payment."
        ]);

        $user = Auth::user();

        $userid = $user->id;

        $data = cart::where('user_id', '=', $userid)->get();

        foreach ($data as $data) {

            $rent = new rent;

            $rent->name = $data->name;
            $rent->email = $data->email;
            $rent->phone = $data->phone;
            $rent->address = $data->address;
            $rent->user_id = $data->user_id;
            $rent->flat_title = $data->flat_title;

            $rent->rent = $data->rent;
            $rent->image = $data->image;
            $rent->flat_id = $data->flat_id;

            $rent->payment_status = "Paid";


            $rent->save();

            $cart_id = $data->id;

            $cart = cart::find($cart_id);

            $cart->delete();


        }

        Session::flash('success', 'Payment successful!');

        return back();
    }

public function about_us(){

    return view('home.aboutus');
}

// Import the Flat model at the top of the controller




    public function flat()
    {
        $flats = Flat::all();
        return view('home.flat');
    }
}


