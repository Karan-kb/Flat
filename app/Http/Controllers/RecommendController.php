<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class RecommendController extends Controller
{
  public function recommend(Request $request)
  {
    $rent = $request->rent;
    $location = $request->location;


    $scriptPath = base_path('app/pickle/script.py');

    if ($rent) {
      $command = "python $scriptPath $rent";
    } else if ($location) {
      $command = "python $scriptPath $location";
    } else {
      // handle error when neither rent nor location is provided
      return redirect()->back()->with('error', 'Please provide either rent or location.');
    }
    // $command = "python $scriptPath $rent $location";
    $output = shell_exec($command);
    $result = $output;
    echo "output is : " . $result;
    session()->flash('result', $result);
    // Display the output in the frontend
    return redirect()->route('recommend.log');
  }
  public function recommend_log()
  {
    return view("home.recommend_log.blade.php");
  }

  public function simple_flat()
  {
    return view("home.simple_flat");
  }
}