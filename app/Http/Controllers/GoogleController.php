<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function loginWithGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackFromGoogle()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();

            if(explode("@", $user->email)[1] !== 'virginia.edu'){
                // return Socialite::driver('google')->redirect();
                return redirect('/')->with("message","Please login with your UVA email");
            }

            // Check Users Email If Already There
            $is_user = User::where('email', $user->getEmail())->first();
            if(!$is_user){

                $name = explode(' ',$user->getName()); 

                $saveUser = User::updateOrCreate([
                    'google_id' => $user->getId(),
                ],[
                    'first_name' => $name[0],
                    'last_name' => $name[1],
                    'email' => $user->getEmail(),
                    'password' => Hash::make($user->getName().'@'.$user->getId())
                ]);
            }else{
                $saveUser = User::where('email',  $user->getEmail())->update([
                    'google_id' => $user->getId(),
                ]);
                $saveUser = User::where('email', $user->getEmail())->first();
            }
            Auth::loginUsingId($saveUser->id);
            echo "here";
            return redirect('/')->with("message","User logged In");
        } catch (\Throwable $th) {
            return redirect('/login');
        }
    }

    public function logout(Request $request){
        // dd('invoked');
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message', 'You have been logged out');
    }
}

