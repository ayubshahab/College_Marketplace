<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //show page to create (register/login) user
    public function create(){
        return view('users.loginSignup');
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
        // dd( auth()->user()->allLiked());
        return view('users.manage' , 
        // myListings needs to include listings, rentables, & sublease items
        ['myListings'=> auth()->user()->listings()->get(),
        'likedList' => auth()->user()->allLiked()]);
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
