<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use App\Models\Rentable;
use App\Models\Sublease;
use App\Libraries\HashMap;
use App\Models\NewsLetter;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
     //show the index page
    public function index(){
        $latest = Listing::latest()->where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString())->simplePaginate(16);
        if(count($latest) == 0){
            $latest = Listing::latest()->take(16)->get();
        }

        return view('listings.index', [
            'listings'=> $latest,
            'listingsNear' => Listing::latest()->take(10)->get(),
            'rentables' => Rentable::latest()->where('status', 'like', 'Available' )->take(10)->get(),
            'subleases'=>Sublease::latest()->where('status', 'like', 'Available')->take(10)->get()
        ]);
    }

    public function search(Request $request){
        $map = new HashMap("String", "Array");
        $input = $request->except('_token');
        foreach ( $input as $key => $value) {
            if($key == "page"){
                continue;
            }
            $value = explode(",", $value);
            $map -> put($key, $value);
        }

        if($request->fullUrl() != $request ->url() && 
        ((request('distance') ?? false) 
        || (request('negotiableFree') ?? false) 
        || (request('search') ?? false) 
        || (request('category') ?? false) 
        || (request('tag') ?? false) 
        || (request('condition') ?? false))){
            // dd($request->all());
            // dd($map ->keySet()); //get all the keys of the key value pairs
            if(request('search') ?? false){
                return view('listings.search', [
                    'listings' => Listing::latest() ->filter(request($map ->keySet()))-> simplePaginate(16)
                ]); 
            } 
        }else{
            return view('listings.search', [
                'listings' => Listing::latest()->simplePaginate(20)
            ]);
        }
    }
    
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

