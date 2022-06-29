<?php

namespace App\Http\Controllers;

use App\Models\NewsLetter;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function enrollEmail(Request $request){
        // dd($request->all());
        $formfields = [
            'email' => $request->email
        ];

        $existing = NewsLetter::where('email', 'like', $request->email)->get();
        if(count($existing) > 0){
            return back()->with('message', 'Email Already Enrolled in News Letter');
        }
        
        $checkUser = User::where('email', 'like', $request->email)->get()->first();
        if($checkUser != null){
            $formfields['user_id'] = $checkUser->id;
        }
        $enrollEmail = NewsLetter::create($formfields);
        return back()->with('message', 'Successfully Enrolled in News Letter');
    }
}

