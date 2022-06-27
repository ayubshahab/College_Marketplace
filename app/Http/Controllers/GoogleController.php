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

            return redirect('/')->with("User logged In");
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

