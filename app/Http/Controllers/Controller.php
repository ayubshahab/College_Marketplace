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
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;



class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function features(){
        return view('main.features');
    }
    
     //show the index page
    public function index(){
        

        //Option 1: return results that were added in the last 24 hours for only sale items
        // $latest = Listing::latest()->where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString())->simplePaginate(16);
        // if(count($latest) == 0){
        //     $latest = Listing::latest()->take(16)->get();
        // }

        //Option 2: retun results from all three types that are the latest
        $listingResults = Listing::latest()->where('status', '!=', 'Sold' )->limit(16)->get();
        $rentableResults = Rentable::latest()->where('status', 'like', 'Available' )->limit(16)->get();
        $subleaseResults = Sublease::latest()->where('status', 'like', 'Available')->limit(16)->get();
        $totalResults = collect($listingResults)->merge($rentableResults)->merge($subleaseResults)->sortByDesc('created_at')->slice(0,16);
        // dd($totalResults);

        return view('main.index', [
            'listings'=> $totalResults,
            'listingsNear' => Listing::latest()->where('status', '!=', 'Sold' )->take(10)->get(),
            'rentables' => Rentable::latest()->where('status', 'like', 'Available' )->take(10)->get(),
            'subleases'=>Sublease::latest()->where('status', 'like', 'Available')->take(10)->get()
        ]);
    }

    public function search(Request $request){
        // dd(\Request::getRequestUri());
        $map = new HashMap("String", "Array");
        $input = $request->except('_token');
        foreach ( $input as $key => $value) {
            if($key == "page"){
                continue;
            }
            $value = explode(",", $value);
            $map -> put($key, $value);
        }
        // dd($request ->all());
        // dd("test");
        if($request->fullUrl() != $request ->url() && 
        ((request('distance') ?? false) 
        || (request('negotiableFree') ?? false) 
        || (request('search') ?? false) 
        || (request('category') ?? false) 
        || (request('tag') ?? false) 
        || (request('condition') ?? false)
        || (request('type') ?? false))){
            if((request('type') ?? false) && request('type') == 'listing'){
                // show results from rentables table with filters applied
                $totalResults = null;
                if(!empty($request->except('_token', 'type', 'page'))){
                    $listingResults = $this->getListingsQuery($request);
                    $totalResults = collect($listingResults)->sortByDesc('id') -> paginate(16);
                }else{
                    $totalResults = collect(Listing::latest()->get())->sortByDesc('id')->paginate(16);
                }
                
                return view('main.search', [
                    'listings' => $totalResults
                ]); 
            }elseif((request('type') ?? false) && request('type') == 'rentable'){
                // show results from rentables table with filters applied
                $totalResults = null;
                if(!empty($request->except('_token', 'type', 'page'))){
                    $rentableResults = $this->getRentableQuery($request);
                    $totalResults = collect($rentableResults)->sortByDesc('id') -> paginate(16);
                }else{
                    $totalResults = Rentable::latest()->paginate(16);
                }
                
                return view('main.search', [
                    'listings' => $totalResults
                ]); 
            }elseif((request('type') ?? false) && request('type') == 'lease'){
                $totalResults = null;
                if(!empty($request->except('_token', 'type', 'page', 'category'))){
                    $subleaseResults = $this->getSubleaseQuery($request);
                    $totalResults = collect($subleaseResults)->sortByDesc('id') -> paginate(16);
                }else{
                    $totalResults = Sublease::latest()->paginate(16);
                }
                
                return view('main.search', [
                    'listings' => $totalResults
                ]); 

            }elseif((request('type') ?? false) && request('type') == 'all'){
                $totalResults = null;
                if(!empty($request->except('_token', 'type', 'page'))){
                    $listingResults = $this->getListingsQuery($request);
                    $rentableResults = $this->getRentableQuery($request);
                    $subleaseResults = $this->getSubleaseQuery($request);
                    $totalResults = collect($listingResults)->merge($rentableResults)->merge($subleaseResults)->sortByDesc('id') -> paginate(16);
                }else{
                    $totalResults = collect(Listing::latest()->get())->merge(Rentable::latest()->get())->merge(Sublease::latest()->get())->sortByDesc('id')->paginate(16);
                }
                
                return view('main.search', [
                    'listings' => $totalResults
                ]); 

            }
        }
    }

    public function getListingsQuery(Request $map){
        $map = $map->except('_token', 'type', 'page','utilities');
        // dd($map);
        if(!empty($map)){
            $string = "Select * from listings as l where ";
            foreach($map as $key => $values){
                // dd($key);
                // dd($values);
                if($key == "search"){
                    $arrayValues = explode(" ", $values);
                    $string = $string . "(" ;
                    foreach($arrayValues as $value){
                        $string = $string . " (" ;
                        $string = $string . "l.item_name LIKE '%" . $value . "%' OR ";
                        $string = $string . "l.tags LIKE '%" . $value . "%' OR ";
                        $string = $string . "l.description LIKE '%" . $value . "%' OR ";
                        $string = substr($string, 0, -4);
                        $string = $string . ")";
                        $string = $string . " AND ";
                    }
                    $string = substr($string, 0, -4);
                    $string = $string . ")";
                    // dd('top branch');
                }elseif($key == 'tags'){
                    $string = $string . " (" ;
                    $string = $string . "l.tags LIKE '%" . $values . "%'";
                    $string = $string . ")";
                }elseif($key == 'category'){
                    //can have multiple categories selected
                    $categories = explode(",", $values);
                    $string = $string . "(" ;
                    foreach($categories as $category){
                        $string = $string . "l.category LIKE '%" . $category . "%' OR ";
                    }
                    $string = substr($string, 0, -4);
                    $string = $string . ")";

                }elseif($key=='minprice'){
                    $string = $string . "(" ;
                    $string = $string . "l.price >= " . $values;
                    $string = $string . ")" ;
                }elseif($key=="maxprice"){
                    $string = $string . "(" ;
                    $string = $string . "l.price <= " . $values;
                    $string = $string . ")" ;
                }else{ //else bit takes care of condition & price
                    $arrayValues = explode(",", $values);
                    // dd($arrayValues);
                    $string = $string . "(" ;
                    foreach($arrayValues as $value ){
                        $string = $string . "l." . $key . " = '" . $value . "' OR ";
                    }
                    $string = substr($string, 0, -4);
                    $string = $string . ")";
                }
                $string = $string . " AND ";
            }
            $string = substr($string, 0, -5);
            
            $userQuery =DB::select($string);
            return Listing::hydrate($userQuery);
        }
    }

    public function getRentableQuery(Request $map){
        $map = $map->except('_token', 'type', 'page','utilities');
        if(!empty($map)){
            $string = "Select * from rentables as r where ";
            foreach($map as $key => $values){
            if($key == "search"){
                    $arrayValues = explode(" ", $values);
                    $string = $string . "(" ;
                    foreach($arrayValues as $value){
                        $string = $string . " (" ;
                        $string = $string . "r.rental_title LIKE '%" . $value . "%' OR ";
                        $string = $string . "r.tags LIKE '%" . $value . "%' OR ";
                        $string = $string . "r.description LIKE '%" . $value . "%' OR ";
                        $string = substr($string, 0, -4);
                        $string = $string . ")";
                        $string = $string . " AND ";
                    }
                    $string = substr($string, 0, -4);
                    $string = $string . ")";
                }elseif($key == 'tags'){
                    $string = $string . " (" ;
                    $string = $string . "r.tags LIKE '%" . $values . "%'";
                    $string = $string . ")";
                }elseif($key == 'category'){
                    $categories = explode(",", $values);
                    $string = $string . "(" ;
                    foreach($categories as $category){
                        $string = $string . "r.category LIKE '%" . $category . "%' OR ";
                    }
                    $string = substr($string, 0, -4);
                    $string = $string . ")";
                }elseif($key=='minprice'){
                    $string = $string . "(" ;
                    $string = $string . "r.rental_charging >= " . $values;
                    $string = $string . ")" ;
                }elseif($key=="maxprice"){
                    $string = $string . "(" ;
                    $string = $string . "r.rental_charging <= " . $values;
                    $string = $string . ")" ;
                }else{ //else bit takes care of condition & price
                    $arrayValues = explode(",", $values);
                    $string = $string . "(" ;
                    foreach($arrayValues as $value ){
                        $string = $string . "r." . $key . " = '" . $value . "' OR ";
                    }
                    $string = substr($string, 0, -4);
                    $string = $string . ")";
                }
                $string = $string . " AND ";
            }
            $string = substr($string, 0, -5);
            // dd($string);
            $userQuery =DB::select($string);
            return Rentable::hydrate($userQuery);
        }
    }
    
    public function getSubleaseQuery(Request $map){
        $map = $map->except('_token', 'type', 'page', 'category', 'tags');
        //done search, condition, price, utilities
        if(!empty($map)){
            $string = "Select * from subleases as s where ";
            foreach($map as $key => $values){
                if($key == "search"){
                    $arrayValues = explode(" ", $values);
                    $string = $string . "(" ;
                    foreach($arrayValues as $value){
                        $string = $string . " (" ;
                        $string = $string . "s.sublease_title LIKE '%" . $value . "%' OR ";
                        $string = $string . "s.location LIKE '%" . $value . "%' OR ";
                        $string = $string . "s.description LIKE '%" . $value . "%' OR ";
                        $string = substr($string, 0, -4);
                        $string = $string . ")";
                        $string = $string . " AND ";
                    }
                    $string = substr($string, 0, -4);
                    $string = $string . ")";
                }elseif($key=='minprice'){
                    $string = $string . "(" ;
                    $string = $string . "s.rent >= " . $values;
                    $string = $string . ")" ;
                }elseif($key=="maxprice"){
                    $string = $string . "(" ;
                    $string = $string . "s.rent <= " . $values;
                    $string = $string . ")" ;
                }else{ //else bit takes care of condition & price & utilities
                    $arrayValues = explode(",", $values);
                    // dd($arrayValues);
                    $string = $string . "(" ;
                    foreach($arrayValues as $value ){
                        $string = $string . "s." . $key . " = '" . $value . "' OR ";
                    }
                    $string = substr($string, 0, -4);
                    $string = $string . ")";
                }
                $string = $string . " AND ";
            }
            $string = substr($string, 0, -5);
            // dd($string);
            $userQuery =DB::select($string);
            return Sublease::hydrate($userQuery);
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

