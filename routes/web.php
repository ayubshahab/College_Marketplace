<?php

use App\Http\Controllers\Controller;
use App\Models\Listing;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\YardSaleController;
use App\Http\Controllers\RentablesController;
use App\Http\Controllers\SubleaseController;
use App\Http\Controllers\GoogleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// main routes
Route::get('/', [Controller::class, 'index']);
Route::get('/shop/all', [Controller::class, 'search']);
Route::get('/pricerangefilter', [Controller::class, 'pricerangefilter']);

// supplementary routes
Route::get('/features', [Controller::class, 'features']);
Route::get('/about', [Controller::class, 'about']);
Route::get('/services', [Controller::class, 'services']);
Route::post('/newsletter', [Controller::class, 'enrollEmail']);

// Routes for listing items
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');
Route::put('/listings/{listing}/update', [ListingController::class, 'updateStatus']);
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');
Route::put('/listings/{listing}',[ListingController::class, 'update'])->middleware('auth');
Route::delete('/listings/{listing}',[ListingController::class, 'destroy'])->middleware('auth');
Route::get('/listings/{listing}', [ListingController::class, 'show']);


// Routes for rentable items
Route::get('/rentables/create', [RentablesController::class, 'create'])->middleware('auth');
Route::post('/rentables', [RentablesController::class, 'store'])->middleware('auth');
Route::put('/rentables/{rentable}/update', [RentablesController::class, 'updateStatus']);
Route::get('/rentables/{rentable}/edit', [RentablesController::class, 'edit'])->middleware('auth');
Route::put('/rentables/{rentable}',[RentablesController::class, 'update'])->middleware('auth');;
Route::get('/rentables/{rentable}', [RentablesController::class, 'show']);
Route::delete('/rentables/{rentable}',[RentablesController::class, 'destroy'])->middleware('auth');

//Routes for Sublease items
Route::get('/subleases/create', [SubleaseController::class, 'create'])->middleware('auth');
Route::post('/subleases', [SubleaseController::class, 'store'])->middleware('auth');
Route::get('/subleases/{sublease}', [SubleaseController::class, 'show']);


//messaging system related routes
Route::post('/sendmessage', [MessageController::class, 'postMessage'])->middleware('auth');
Route::get('/messages', [MessageController::class, 'getMessages'])->middleware('auth');


//yard sales related routes
Route::get('/yardsales/create', [YardSaleController::class, 'create'])->middleware('auth');
Route::post('/yardsales', [YardSaleController::class, 'store'])->middleware('auth');
Route::get('/yardsales/{yardsale}',[YardSaleController::class,'show']);


//user related routes
//Route::get('/users/loginRegister', [UserController::class, 'create'])->name('login')->middleware('guest');
//Route::post('/users', [UserController::class, 'store'])->middleware('guest');
//Route::post('/users/authenticate',[UserController::class, 'authenticate']);
Route::get('/users/manage', [UserController::class, 'manage'])->middleware('auth');
Route::post('/users/manage/createWatchItem', [UserController::class, 'createWatchItem'])->middleware('auth');
Route::get('/users/removefavorite', [UserController::class, 'removeFavorite'])->middleware('auth');
Route::get('/users/addfavorite', [UserController::class, 'addFavorite'])->middleware('auth');
Route::post('/users/additionalInfo', [UserController::class, 'updateInfo'])->middleware('auth');
Route::delete('/users/delete/{user}', [UserController::class, 'destroy'])->middleware('auth');
Route::delete('/watchitems/{watchItem}', [UserController::class, 'deleteWatchItem']);
Route::post( '/remove_recommendation',[UserController::class, 'removeRecommendedItem']);

//Google routes
// Google URL
Route::get('/login', [GoogleController::class, 'loginWithGoogle'])->name('login')->middleware('guest');
Route::any('/callback', [GoogleController::class, 'callbackFromGoogle'])->name('callback');
Route::post('/logout', [GoogleController::class, 'logout'])->middleware('auth');
