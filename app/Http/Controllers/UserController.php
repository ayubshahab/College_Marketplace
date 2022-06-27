<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use App\Models\WatchItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //show page to create (register/login) user
    public function create(){
        return Socialite::driver('google')->redirect();
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'first_name'=> ['required', 'min:3'],
            'last_name'=>['required', 'min:3'],
            'username'=>'',
            'password'=>'required|confirmed|min:6',
            'email'=>['required', 'email', Rule::unique('users', 'email')],
            'number'=>'',
            'street'=>'',
            'city'=>'',
            'state'=>'null',
            'country'=>'null',
            'postcode'=>'null'
        ]);

        $formFields['password'] = bcrypt($formFields['password']);
        // dd($formFields);
        $user = User::create($formFields);
        auth()->login($user);
        return redirect('/')->with('message', "User Created & Logged In");
    }

    public function logout(Request $request){
        // dd('invoked');
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'You have been logged out');
    }


    // same as login
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'password'=>'required',
            'email'=>['required', 'email']
        ]);

        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/')->with('message', 'You are now logged in!');
            // return back()->with('message', 'You are now logged in!');
        }
        return back()->withErrors(['email'=>'Invalid Credentials'])->onlyInput('email');
    }

    public function manage(){
        return view('users.manage' , 
        // myListings needs to include listings, rentables, & sublease items
        ['myListings'=> auth()->user()->allPosts(),
        'likedList' => auth()->user()->allLiked(),
        'watchList' => WatchItem::latest()->where('user_id', 'like', auth()->user()->id)->get(),
        // would need to create a function to go through key words and find matches for each item in the watch list
        //would retun a json of key value pairs
        'matches'=>Listing::latest()->take(10)->get()]);
    }

    public function createWatchItem(Request $request){
        // dd($request->all());
        $formFields = $request->validate([
            'user_id' => 'required',
            'watchitem_title' => 'required',
            'type' => 'required',
            'match_rate' => 'required',
            'key_tags' => 'required',
        ]);
        $newWatchItem = WatchItem::create($formFields);
        return back()->with('message', 'Watch Item Created!');
    }

    public function addFavorite(Request $request){
        // dd($request->all());
        $currentUser = User::find(auth()->id());
        $favorites = null;
        if($request->type == "listing"){ //if favorite type is listing
            if($currentUser->favorites != null){
                $favorites = explode(", ", $currentUser->favorites);
                if(!in_array($request->id, $favorites)){
                    array_push($favorites, $request->id);
                }
            }else{
                $favorites = array($request->id);
            }
            $currentUser->favorites = implode(', ', $favorites);
        }elseif($request->type == 'rentable'){ //if favorite type is rentable
            if($currentUser->rentableFavorites != null){
                $favorites = explode(", ", $currentUser->rentableFavorites);
                if(!in_array($request->id, $favorites)){
                    array_push($favorites, $request->id);
                }
            }else{
                $favorites = array($request->id);
            }
            $currentUser->rentableFavorites = implode(', ', $favorites);
        }else{ //if favorite type is lease

        }
        // array_push($listing->id, $favorites);
        $currentUser->save();
        return back()->with('message', "Added to Favorites!");
    }

    public function removeFavorite(Request $request){
        $currentUser = User::find(auth()->id());
        $favorites = null;
        if($request->type=="listing"){
            if($currentUser->favorites != null){
                $favorites = explode(", ", $currentUser->favorites);
                if(in_array($request->id, $favorites)){
                    
                    if (($key = array_search($request->id, $favorites)) !== false) {
                        unset($favorites[$key]);
                    }
                }
            }
            $currentUser->favorites = implode(', ', $favorites);
        }elseif($request->type == "rentable"){
            if($currentUser->rentableFavorites != null){
                $favorites = explode(", ", $currentUser->rentableFavorites);
                if(in_array($request->id, $favorites)){
                    if (($key = array_search($request->id, $favorites)) !== false) {
                        unset($favorites[$key]);
                    }
                }
            }
            $currentUser->rentableFavorites = implode(', ', $favorites);
        }else{

        }
        $currentUser->save();
        return back()->with('message', "Removed from Favorites!");
    }
}
