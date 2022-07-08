<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use App\Models\Rentable;
use App\Models\Sublease;
use App\Models\YardSale;
use App\Libraries\HashMap;
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
        $listingQuery = DB::table('listings');
        $categories = explode(", ", $listing->category);
        // match any of the categories
        foreach($categories as $category){
            $listingQuery->orWhere('category', 'like', '%'.$category.'%');
        }
        // match any of the tags
        $tags = explode(", ", $listing->tags);
        foreach($tags as $tag){
            $listingQuery->orWhere('tags', 'like', '%'.$tag.'%');
        }
        //excluding the item itself
        $listingQuery->orWhere('id', "!=", $listing->id);

        //get the results of the search
        $listingQuery=$listingQuery->limit(10)->get();



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
            'image_uploads'=>'required',
            'street'=>'required_without:latitude',
            'city'=>'required_without:latitude',
            'state'=>'required_without:latitude',
            'country'=>'required_without:latitude',
            'postcode'=>'required_without:latitude',
            'latitude' => 'required_without:street',
            'longitude' =>'required_without:street'
        ]);
        //  dd($request);
        $formFields['user_id']=auth()->id();
        if($request->hasFile('image_uploads'))
        {
            foreach ($request->file('image_uploads') as $file) {
                $path = $file->store('listings','s3');
                \Storage::disk('s3')->setVisibility($file, 'public');
                //$fullURL = \Storage::disk('s3')->url($name); 
                $data[] = $path; 
            }
            $formFields['image_uploads']=json_encode($data);
        }
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
            'street'=>'required',
            'city'=>'required',
            'state'=>'required',
            'country'=>'required',
            'postcode'=>'required'
        ]);

        $formFields['user_id']=auth()->id();
        
        if($request->hasFile('image_uploads'))
        {
            foreach ($request->file('image_uploads') as $file) {
                $path = $file->store('listings','s3');
                \Storage::disk('s3')->setVisibility($file, 'public');
                //$fullURL = \Storage::disk('s3')->url($name); 
                $data[] = $path; 
            }
            $formFields['image_uploads']=json_encode($data);
        }
        $formFields['category']=implode(", " ,$formFields['category']);
        // dd($formFields);

        $listing->update($formFields);
        return redirect('/listings/'.$listing->id)->with('message', 'Listing Updated Successfully!');
    }

    public function destroy(Listing $listing){

        if(is_array(json_decode($listing->image_uploads))){
            foreach(json_decode($listing->image_uploads) as $link){
               $this->removeImage($link);
            }
        }
        $listing->delete();
        return redirect('/')->with('message', "Listing Deleted Successfully!");
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
}
