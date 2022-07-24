<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use App\Models\Rentable;
use App\Models\Sublease;
use App\Models\YardSale;
use App\Libraries\HashMap;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ListingController extends Controller
{
 
    // show a single listing
    public function show(Listing $listing){
        // get the listings table
        // the listings array will hold listings that are similar to the current listing based on categories, if none then get 10 of the latest else add on to the existing and add remaining from the latest, so if there is 6 similar, then add 4 from latest that are unique

        // getting the related items for the bottom carousel

        // option 1: when there are alot of items then we can be specific
            // $listingQuery = DB::table('listings');
            // $categories = explode(", ", $listing->category); //there will always be atleast one category
            // $tags = explode(", ", $listing->tags); //there will always be atleast one tag

            // $string = "Select * from listings as l where l.id != " . $listing->id . " AND " . "l.status NOT LIKE 'SOLD'" . " AND ";
            // $string = $string . "( (";
            // foreach($categories as $category){
            //     $string = $string . "l.category LIKE '%" . $category . "%' OR ";
            // }
            // $string = substr($string, 0, -4);
            // $string = $string . ") OR (";
            // foreach($tags as $tag){
            //     $string = $string . "l.tags LIKE '%" . $tag . "%' OR ";
            // }
            // $string = substr($string, 0, -4);
            // $string = $string . ") ) limit 10";

            // $userQuery =DB::select($string);
            // $listingQuery = Listing::hydrate($userQuery);
        
        //option 2: when the data set size is relatively small, return random items from the database
                $listingQuery = Listing::inRandomOrder()
                            ->where('id', '!=', $listing->id)
                            ->where( function ( $query )
                            {
                                $query->where( 'status', 'NOT LIKE', 'SOLD' );
                            })->limit(10)->get();



        // if i am the owner of the listing-> i wanna see messages that have been sent to me first and i can repy to them
        // first see messages that are regarding the current listing id and have been sent to the listing owner
        // show users if they have texted first, or pending text, or users u have talked to before
        $userQuery = null;
        if(Auth::user()){
            // $userQuery = DB::select(
            // "select users.id, users.first_name, users.last_name, users.avatar, users.email, 
            // count(is_read) as unread 
            // from users 
            // LEFT  JOIN  messages ON users.id = messages.from and (is_read = 0 and messages.to = " . auth()->id() . " and for_listing = ". $listing->id.")
            // where users.id != " . auth()->id() . "
            // group by users.id, users.first_name, users.last_name, users.avatar, users.email");

            $userQuery = DB::select(
                "
                SELECT users2.id, users2.first_name, users2.last_name, users2.avatar, users2.email, COUNT(case messages.is_read WHEN 0 then 1 else NULL end) as unread
                FROM users
                INNER JOIN messages on messages.to = users.id
                INNER JOIN users as users2 ON messages.from = users2.id
                WHERE messages.for_listing = ". $listing->id." and users2.id != ".auth()->id()."
                GROUP BY users2.id, users2.first_name, users2.last_name, users2.avatar, users2.email
                "
            );
        }
        
        // dd($userQuery);
        // dd(Auth::guest());
        return view('listings.show',[
            // the current listings we are looking at
            'listing' => $listing,
            // list of relatd listings to be used in carousel
            'listings' => $listingQuery,
            // all users that have sent a message regarding current listing
            'allUsers' => $userQuery,
            'listingOwner' => User::find($listing->user_id),
            // current users id
            'currentUser'=> Auth::guest() ? null : User::find(auth()->user()->id)
        ]);
    }

    public function signup(){
        return view('user.loginSignup');
    }

    public function create(){
        return view('listings.create'); 
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'user_id'=>'required',
            'item_name'=>'required',
            'price'=>'required',
            'negotiable'=> 'required',
            'condition'=>'required',
            'category'=>'required',
            'tags'=>'required',
            'description'=>'required',
            'image_uploads'=>'required|max:5128',
            'street'=>'required_without:latitude',
            'city'=>'required_without:latitude',
            'state'=>'required_without:latitude',
            'country'=>'required_without:latitude',
            'postcode'=>'required_without:latitude',
            'latitude' => 'required_without:street',
            'longitude' =>'required_without:street',
            'apartment_floor'=>'nullable'
        ]);
        //  dd($formFields);
        $formFields['user_id']=auth()->id();
        //since the images are required anyways, we know there will always be atleast one image
        //we have built in the check for size on the javascript side
        foreach ($request->file('image_uploads') as $file) {
            // if the size is smaller than 5mb then upload to aws s3 bucket
            if($file->getSize() <= 5*1024*1024){
                $path = $file->store('listings','s3');
                \Storage::disk('s3')->setVisibility($file, 'public');
                //$fullURL = \Storage::disk('s3')->url($name); 
                $data[] = $path; 
            }
        }

        $formFields['image_uploads']=json_encode($data);
        $formFields['category']=implode(", " ,$formFields['category']);

        // dd($formFields);
        $newListing=Listing::create($formFields);
        return redirect('/listings/'.$newListing->id)->with('message', 'Listing Created Successfully!');

    }

    public function edit(Listing $listing){
        if($listing->user_id != auth()->id()){
            abort('404', 'Unauthorized Access');
            return redirect('/')->with('message', 'Please only edit listings you own');
        }
        // dd($listing);
        return view('listings.edit', ['listing' =>$listing]);
    }

    public function update(Request $request, Listing $listing){
        if($listing->user_id != auth()->id()){
            abort('404', 'Unauthorized Access');
            return redirect('/')->with('message', 'Please only edit listings you own');
        }
        $formFields = $request->validate([
            'user_id'=>'required',
            'item_name'=>'required',
            'price'=>'required',
            'negotiable'=> 'required',
            'condition'=>'required',
            'category'=>'required',
            'tags'=>'required',
            'description'=>'required',
            'street'=>'required_without:latitude',
            'city'=>'required_without:latitude',
            'state'=>'required_without:latitude',
            'country'=>'required_without:latitude',
            'postcode'=>'required_without:latitude',
            'latitude' => 'required_without:street',
            'longitude' =>'required_without:street',
            'apartment_floor'=>'nullable'
        ]);

        $formFields['user_id']=auth()->id();
        if($request->file('image_uploads') != null){
            foreach ($request->file('image_uploads') as $file) {
                // if the size is smaller than 5mb then upload to aws s3 bucket
                if($file->getSize() <= 5*1024*1024){
                    $path = $file->store('listings','s3');
                    \Storage::disk('s3')->setVisibility($file, 'public');
                    //$fullURL = \Storage::disk('s3')->url($name); 
                    $data[] = $path; 
                }
            }

            $formFields['image_uploads']=json_encode($data);   
        }
        $formFields['category']=implode(", " ,$formFields['category']);
        // dd($formFields);

        $listing->update($formFields);
        return redirect('/listings/'.$listing->id)->with('message', 'Listing Updated Successfully!');
    }

    public function destroy(Listing $listing){
        $this->removeFromRecommendations($listing->id);
        if(is_array(json_decode($listing->image_uploads))){
            foreach(json_decode($listing->image_uploads) as $link){
               $this->removeImage($link);
            }
        }
        $listing->delete();
        return redirect('/')->with('message', "Listing Deleted Successfully!");
    }

    public function removeFromRecommendations($id){
        $string = "Select * from watch_items as w where (w.type LIKE 'listing') AND (w.matches_found LIKE '% " . $id .",%' OR w.matches_found LIKE '% " . $id ."%' )";
        $results = DB::select($string);
        // dd($id ,"   " ,$string, $results);

        foreach($results as $result){
            $matchedItems = explode(", ", $result->matches_found);
            if (($key = array_search($id, $matchedItems)) !== false) {
                unset($matchedItems[$key]);
            }
            DB::table('watch_items')->where('id', $result->id)->update(['matches_found' => implode(", ", $matchedItems)]);
        }
    }
    
    public function removeImage($filLink)
    {  
        /*if(file_exists(public_path($filLink))){
            unlink(public_path($filLink));
        }else{
            dd('File not found');
        }*/
        if(\Storage::disk('s3')->exists($filLink)) {
            \Storage::disk('s3')->delete($filLink);
        }
    }

    public function updateStatus(Request $request, Listing $listing){
        if($listing->user_id != auth()->id()){
            abort('404', 'Unauthorized Access');
            return redirect('/')->with('message', 'Please only edit listings you own');
        }
        $data = Listing::find($listing->id);
        $data->status = $request->status;
        $data->save();
        return back()->with('message', "Listing Updated Successfully");
    }

    public static function getListingById($listing){
        // dd("test");
        //if no listing is found - > meaning the listing must have been deleted then remove that recommendation from that watchlist
        return Listing::find($listing);
    }
}
