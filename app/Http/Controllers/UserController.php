<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use App\Models\WatchItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use phpDocumentor\Reflection\Types\Null_;

class UserController extends Controller
{
    //show page to create (register/login) user
    /*public function create(){
        return Socialite::driver('google')->redirect();
    }*/

    /*public function store(Request $request){
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
    }*/

    // same as login
    /*public function authenticate(Request $request){
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
    }*/

    public function manage(){
        //call function to update all matches found
        $userWatchItems = WatchItem::latest()->where('user_id', 'like', auth()->user()->id)->orderBy('matches_found', 'desc')->get();
        // dd($userWatchItems);
        $this->recommendMatches($userWatchItems);
        // dd('test');
        return view('users.manage' ,
        ['myListings'=> auth()->user()->allPosts(),
        'likedList' => auth()->user()->allLiked(),
        'watchList' => $userWatchItems]);
    }

    //words aut est rem dicta animi et 
    // Ipsam Est Ut.
    // sed 
    // sunt sed
    public function recommendMatches(Collection $userWatchItems){
        // dd($userWatchItems);
        foreach($userWatchItems as $watchItem){
            $watchTags = explode(", ", $watchItem->key_tags);
            if($watchItem->type == "listing"){
                $string = "Select * from listings as l where l.status = 'Available' AND ";
                $string = $string . "(" ;
                foreach($watchTags as $value){
                    $string = $string . " (" ;
                    $string = $string . "l.item_name LIKE '%" . $value . "%' OR ";
                    $string = $string . "l.negotiable LIKE '%" . $value . "%' OR ";
                    $string = $string . "l.condition LIKE '%" . $value . "%' OR ";
                    $string = $string . "l.category LIKE '%" . $value . "%' OR ";
                    $string = $string . "l.tags LIKE '%" . $value . "%' OR ";
                    $string = $string . "l.description LIKE '%" . $value . "%' OR ";
                    $string = substr($string, 0, -4);
                    $string = $string . ")";
                    $string = $string . " AND ";
                }

                if($watchItem->dont_recommend != null and $watchItem != ""){
                    $dontRecommendArray = explode(", ", $watchItem->dont_recommend);
                    $string = $string . "(" ;
                    foreach($dontRecommendArray as $recommendation){
                        $string = $string . "l.id != " . $recommendation . " AND ";
                    }
                    $string = substr($string, 0, -4);
                    $string = $string . ") AND ";
                }

                $string = substr($string, 0, -4);
                $string = $string . ") limit 10 ";

                // dd($string);
                $listingQuery =DB::select($string);
                // dd($listingQuery);

                $matchesFound = array();
                foreach($listingQuery as $match){
                    array_push($matchesFound, $match->id);
                }
                if(!empty($matchesFound)){
                    $watchItem->matches_found = implode(', ', $matchesFound);
                }else{
                    $watchItem->matches_found = NULL;
                }
                $watchItem->save();
            }elseif($watchItem->type == 'rentable'){
                $string = "Select * from rentables as r where r.status = 'Available' AND";
                $string = $string . "(" ;
                foreach($watchTags as $value){
                    $string = $string . " (" ;
                    $string = $string . "r.rental_title LIKE '%" . $value . "%' OR ";
                    $string = $string . "r.negotiable LIKE '%" . $value . "%' OR ";
                    $string = $string . "r.condition LIKE '%" . $value . "%' OR ";
                    $string = $string . "r.category LIKE '%" . $value . "%' OR ";
                    $string = $string . "r.tags LIKE '%" . $value . "%' OR ";
                    $string = $string . "r.description LIKE '%" . $value . "%' OR ";
                    $string = substr($string, 0, -4);
                    $string = $string . ")";
                    $string = $string . " AND ";
                }

                if($watchItem->dont_recommend != null and $watchItem != ""){
                    $dontRecommendArray = explode(", ", $watchItem->dont_recommend);
                    $string = $string . "(" ;
                    foreach($dontRecommendArray as $recommendation){
                        $string = $string . "r.id != " . $recommendation . " AND ";
                    }
                    $string = substr($string, 0, -4);
                    $string = $string . ") AND ";
                }

                $string = substr($string, 0, -4);
                $string = $string . ") limit 10";
                // dd($string);
                $listingQuery =DB::select($string);

                $matchesFound = array();
                foreach($listingQuery as $match){
                    array_push($matchesFound, $match->id);
                }
                if(!empty($matchesFound)){
                    $watchItem->matches_found = implode(', ', $matchesFound);
                }else{
                    $watchItem->matches_found = NULL;
                }
                $watchItem->save();
            }elseif($watchItem->type == 'lease'){
                $string = "Select * from subleases as s where s.status = 'Available' AND ";
                $string = $string . "(" ;
                foreach($watchTags as $value){
                    $string = $string . " (" ;
                    $string = $string . "s.sublease_title LIKE '%" . $value . "%' OR ";
                    $string = $string . "s.location LIKE '%" . $value . "%' OR ";
                    $string = $string . "s.negotiable LIKE '%" . $value . "%' OR ";
                    $string = $string . "s.condition LIKE '%" . $value . "%' OR ";
                    $string = $string . "s.utilities LIKE '%" . $value . "%' OR ";
                    $string = $string . "s.description LIKE '%" . $value . "%' OR ";
                    $string = substr($string, 0, -4);
                    $string = $string . ")";
                    $string = $string . " AND ";
                }

                if($watchItem->dont_recommend != null and $watchItem != ""){
                    $dontRecommendArray = explode(", ", $watchItem->dont_recommend);
                    $string = $string . "(" ;
                    foreach($dontRecommendArray as $recommendation){
                        $string = $string . "s.id != " . $recommendation . " AND ";
                    }
                    $string = substr($string, 0, -4);
                    $string = $string . ") AND ";
                }

                $string = substr($string, 0, -4);
                $string = $string . ") limit 10";
                // dd($string);
                $listingQuery =DB::select($string);

                $matchesFound = array();
                foreach($listingQuery as $match){
                    array_push($matchesFound, $match->id);
                }
                if(!empty($matchesFound)){
                    $watchItem->matches_found = implode(', ', $matchesFound);
                }else{
                    $watchItem->matches_found = NULL;
                }
                $watchItem->save();
            }   
        }
        return;
    }   

    public function removeRecommendedItem(Request $request){
        // dd($request->all());
        $recommendedItem = WatchItem::find($request->watchitem_id);
        $dontRecommendArray = null;
        if($recommendedItem->dont_recommend !=null){
            $dontRecommendArray = explode(", ", $recommendedItem->dont_recommend);
        }else{
            $dontRecommendArray = array();
        }
        if(!in_array($request->recommendation_id, $dontRecommendArray)){
            array_push($dontRecommendArray, $request->recommendation_id);
            $recommendedItem->dont_recommend = implode(", ", $dontRecommendArray);
            $recommendedItem->save();
        }
        return back()->with('message', "The Recommended Item will no longer be associated with the WatchList");
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

    public function deleteWatchItem(Request $request, WatchItem $watchItem){
        $watchItem->delete();
        return back()->with('message', "Watch Item Deleted Successfully!");
    }

    public function addFavorite(Request $request){
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
            if($currentUser->leaseFavorites != null){
                $favorites = explode(", ", $currentUser->leaseFavorites);
                if(!in_array($request->id, $favorites)){
                    array_push($favorites, $request->id);
                }
            }else{
                $favorites = array($request->id);
            }
            $currentUser->leaseFavorites = implode(', ', $favorites);
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
            if($currentUser->leaseFavorites != null){
                $favorites = explode(", ", $currentUser->leaseFavorites);
                if(in_array($request->id, $favorites)){
                    if (($key = array_search($request->id, $favorites)) !== false) {
                        unset($favorites[$key]);
                    }
                }
            }
            $currentUser->leaseFavorites = implode(', ', $favorites);
        }
        $currentUser->save();
        return back()->with('message', "Removed from Favorites!");
    }

    public function updateInfo(Request $request){
        $formFields = $request->validate([
            'street'=>'required',
            'city'=>'required',
            'state'=>'required',
            'country'=> 'required',
            'postcode'=>'required',
            'number'=>'required'
        ]);

        $currentUser = User::find(auth()->user())->first();
        if($currentUser != null){
            $currentUser->street = $request->street;
            $currentUser->city = $request->city; 
            $currentUser->state = $request->state; 
            $currentUser->country = $request->country; 
            $currentUser->postcode = $request->postcode; 
            $currentUser->number = $request->number;
        }
        $currentUser->save();
        return back()->with('message', 'User Address & Number Updated');
    }

    public function destroy(User $user){
        $user->delete();
        return redirect('/')->with('message', "User Account Deleted Successfully!");
    }
}
