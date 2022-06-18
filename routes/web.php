<?php

use App\Models\Listing;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\YardSaleController;
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



// listings related routes
// get all Listings
Route::get('/', [ListingController::class, 'index']);
// search results
Route::get('/shop/listings', [ListingController::class, 'search']);

//  /shop/listings
//  /shop/sublease
//  /shop/rent

//tag results
// create a single listing -> show the form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');
// store listing data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// change status of listing based on availability
Route::put('/listings/{listing}/update', [ListingController::class, 'updateStatus']);
// edit a single listing-> show the form to edit
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');;
//update listing
Route::put('/listings/{listing}',[ListingController::class, 'update'])->middleware('auth');;
// delete a listing
Route::delete('/listings/{listing}',[ListingController::class, 'destroy'])->middleware('auth');
// show a single listing
Route::get('/listings/{listing}', [ListingController::class, 'show']);


//messaging system related routes
Route::post('/sendmessage', [MessageController::class, 'postMessage'])->middleware('auth');
Route::get('/messages', [MessageController::class, 'getMessages'])->middleware('auth');



//yard sales related routes
//create a yard sale post
Route::get('/yardsales/create', [YardSaleController::class, 'create'])->middleware('auth');
//post request to store create form inputs
Route::post('/yardsales', [YardSaleController::class, 'store'])->middleware('auth');
Route::get('/yardsales/{yardsale}',[YardSaleController::class,'show']);
//need to add more routes to update yard sales and for messaging



//user related routes
Route::get('/users/loginRegister', [UserController::class, 'create'])->name('login')->middleware('guest');

Route::post('/users', [UserController::class, 'store'])->middleware('guest');

Route::post('/users/logout', [UserController::class, 'logout'])->middleware('auth');;

Route::post('/users/authenticate',[UserController::class, 'authenticate']);

Route::get('/users/manage', [UserController::class, 'manage'])->middleware('auth');

Route::get('/users/removefavorite/{listing}', [UserController::class, 'removeFavorite'])->middleware('auth');

Route::get('/users/addfavorite/{listing}', [UserController::class, 'addFavorite'])->middleware('auth');

