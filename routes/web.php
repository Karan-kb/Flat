<?php

use App\Http\Controllers\RecommendationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Models\Flat;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

route::get('/', [HomeController::class, 'index']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get(
        '/dashboard',
        function () {
            return view('dashboard');
        }
    )->name('dashboard');
});

route::get('/redirect', [HomeController::class, 'redirect']);

route::get('/view_category', [AdminController::class, 'view_category']);
route::post('/add_category', [AdminController::class, 'add_category']);
route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);

route::get('/add_flat', [AdminController::class, 'add_flat']);

route::post('/show_flat', [AdminController::class, 'show_flat']);

route::get('/view_flat', [AdminController::class, 'view_flat']);

Route::get('/flats/{flat}/rate', 'RatingController@create')->name('ratings.create');
Route::post('/flats/{flat}/rate', 'RatingController@store')->name('ratings.store');


Route::put('/ratings/{rating}', 'RatingController@update')->name('ratings.update');


Route::get('/flats/{id}/average-rating', function ($id) {
    $flat = Flat::find($id);
    $averageRating = $flat->averageRating();
    return view('flat-average-rating', compact('flat', 'averageRating'));
});


Route::get('/helloworld', [AdminController::class, 'temp'])->name('temp');


Route::get('/rating/form', [AdminController::class, 'rating_create']);
Route::post('/rating/form', [AdminController::class, 'rating_store'])->name('rating.store');


route::get('/rate_flat/{id}', [HomeController::class, 'rate_flat']);

route::post('/rate', [HomeController::class, 'rate'])->name('rate.store');

route::get('/flat_search', [HomeController::class, 'flat_search']);

Route::get('/recommend', [RecommendationController::class, 'getRecommendation'])
    ->name('getRecommendation');


route::get('/flat_details/{id}', [HomeController::class, 'flat_details']);
route::get('/delete_flat/{id}', [AdminController::class, 'delete_flat']);

route::get('/update_flat/{id}', [AdminController::class, 'update_flat']);

route::post('/update_flat_confirm/{id}', [AdminController::class, 'update_flat_confirm']);

Route::get('/recommemd/log', [RecommendController::class, 'recommend_log'])->name('recommend.log');

Route::get('/simple_flat', [RecommendController::class, 'simple_flat'])->name('simple.flat');
route::post('/rent/{id}', [HomeController::class, 'rent']);
route::get('/show_cart', [HomeController::class, 'show_cart']);


route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart']);

route::get('/cash_rent', [HomeController::class, 'cash_rent']);

route::get('/stripe/{rent}', [HomeController::class, 'stripe']);

Route::post('stripe/{rent}', [HomeController::class, 'stripePost'])->name('stripe.post');

route::get('/order', [AdminController::class, 'order']);
route::get('/recommendations', [RecommendationController::class, 'generateRecommendations']);
//Route::get('/recommendations', 'RecommendationController@showRecommendations')->name('recommendations');

route::get('/about_us', [HomeController::class, 'about_us']);

Route::get('/flats', 'HomeController@flat');

route::get('/print_pdf/{id}', [AdminController::class, 'print_pdf']);

//Route::get('/recommendations', [RecommendationController::class, 'showRecommendations'])->name('recommendations');

//Route::post('/flats/{flat_id}/ratings', 'RatingsController@store')->name('ratings.store');

//Route::get('/flats/by-distance', [HomeController::class, 'getFlatsByDistance'])->name('flats.by-distance');

//Route::get('/flats/{id}', [FlatController::class, 'show'])->name('flats.show');
Route::get('/showMap/{id}', [HomeController::class, 'showMap']);

Route::get('/stripe/{rent}',[HomeController::class, 'stripe']);




