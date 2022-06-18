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
        // this shows an error for no reason, code works
        // dd(auth()->user()->listings()->get());
        return view('users.manage' , ['myListings'=> auth()->user()->listings()->simplePaginate(8)]);
    }

    public function addFavorite(Listing $listing){
        // dd($listing->id);
        $currentUser = User::find(auth()->id());
        $favorites = null;
        if($currentUser->favorites != null){
            $favorites = explode(", ", $currentUser->favorites);
            if(!in_array($listing->id, $favorites)){
                array_push($favorites, $listing->id);
            }
        }else{
            $favorites = array($listing->id);
        }
        $currentUser->favorites = implode(', ', $favorites);
        $currentUser->save();
        // array_push($listing->id, $favorites);
        return back()->with('message', "Listing Added to Favorites!");
    }

    public function removeFavorite(Listing $listing){
        $currentUser = User::find(auth()->id());
        $favorites = null;
        if($currentUser->favorites != null){
            $favorites = explode(", ", $currentUser->favorites);
            if(in_array($listing->id, $favorites)){
                
                if (($key = array_search($listing->id, $favorites)) !== false) {
                    unset($favorites[$key]);
                }
            }
        }
        $currentUser->favorites = implode(', ', $favorites);
        $currentUser->save();
        // array_push($listing->id, $favorites);
        return back()->with('message', "Listing Removed from Favorites!");
    }
}
