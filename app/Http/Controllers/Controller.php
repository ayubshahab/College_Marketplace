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
        || (request('condition') ?? false)
        || (request('type') ?? false))){
            if((request('type') ?? false) && request('type') == 'listing'){
                // show results from listings table with filters applied
                $listings = Listing::latest()->filter(request()->all())->simplePaginate(16);                
                return view('listings.search', [
                    'listings' => $listings
                ]); 
            }elseif((request('type') ?? false) && request('type') == 'rentable'){
                // show results from rentables table with filters applied
                return view('listings.search', [
                    'listings' => Rentable::latest()-> simplePaginate(16)
                ]); 
            }elseif((request('type') ?? false) && request('type') == 'lease'){
                // show results from sublease table with filters applied
                return view('listings.search', [
                    'listings' => Sublease::latest()-> simplePaginate(16)
                ]); 
            }elseif((request('type') ?? false) && request('type') == 'all'){
                // show results from all three tables with filters applied
                dd('request type all');
            }elseif(request('search') ?? false){
                // show results from all three table with filters applied plus search terms
                dd('search request');
            }

        }else{ //for all the listings button
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

