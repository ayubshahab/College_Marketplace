<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use App\Models\YardSale;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ListingController extends Controller
{
 
     //show all listings
    public function index(){
        // dd(request());

        //no nested search functionality
        // only searches for one tag and one search at a time
        //can't search for two tags yet

        //if the search tag is present return a different view
        // if(request('tag') ?? false or request('search') ?? false){
        //     // dd(request());
        //     return view('listings.search', [
        //         'listings' => Listing::latest() ->filter(request(['tag', 'search']))-> simplePaginate(16),
        //         // double colon is used for static methods
        //         //search for all listings that have that specific tag
        //         //returns the results in the recently added order
                
        //         'tagWord' => request('tag'),
        //         'searchWord' => request('search'),
        //         'yardSales' => YardSale::latest()->get()
        //     ]); 
        // }else{
        //     return view('listings.index', [
        //     // 'listings' => Listing::all() //return all listings
        //     // 'listings' =>Listing::latest()->get()
        //     'listings' =>Listing::latest()->simplePaginate(16),
        //     'yardSales' => YardSale::latest()->take(6)->get(),
        //     'listingsNear' => Listing::latest()->take(10)->get(),
        //     'listingsRent' => Listing::latest()->take(10)->get()
        // ]);
        // }

        return view('listings.index', [
            // 'listings' => Listing::all() //return all listings
            // 'listings' =>Listing::latest()->get()

            // for the listings, which should only be recently added -> make it within 24hrs -> set a limit for how many total listings to show and paginate or set a minimum to show -> if not possible-> select the most recent
            'listings'=>Listing::latest()->where('created_at', '>=', Carbon::now()->subDay()->toDateTimeString())->simplePaginate(16),
            // 'listings' =>Listing::latest()->simplePaginate(16),
            'yardSales' => YardSale::latest()->take(6)->get(),
            'listingsNear' => Listing::latest()->take(10)->get(),
            'listingsRent' => Listing::latest()->take(10)->get()
        ]);
    }

    public function search(Request $request){
        // dd($request->all());
        if(request('search') ?? false){
            return view('listings.search', [
                'listings' => Listing::latest() ->filter(request(['tag', 'search']))-> simplePaginate(16),
                // double colon is used for static methods
                //search for all listings that have that specific tag
                //returns the results in the recently added order
                
                'tagWord' => request('tag'),
                'searchWord' => request('search'),
                'currentUrl' => $request->fullUrl()
            ]); 
        } 
        abort('404', "Incorrect Search Attempt");
    }

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
            'negotiableFree'=> 'required',
            'condition'=>'required',
            'category'=>'required',
            'tags'=>'required',
            'description'=>'required',
            'image_uploads'=>'required',
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
                $name = $file->store('listings','public');
                $data[] = $name; 
            }
            $formFields['image_uploads']=json_encode($data);
        }
        $formFields['category']=implode(", " ,$formFields['category']);

        $newListing=Listing::create($formFields);
        return redirect('/listings/'.$newListing->id)->with('message', 'Listing Created Successfully!');

    }

    public function edit(Listing $listing){
        if($listing->user_id != auth()->id()){
            abort('404', 'Unauthorized Access');
            return redirect('/')->with('message', 'Please only edit listings you own');
        }
        
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
            'negotiableFree'=> 'required',
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
                $name = $file->store('listings','public');
                $data[] = $name; 
            }
            $formFields['image_uploads']=json_encode($data);
        }
        $formFields['category']=implode(", " ,$formFields['category']);
        // dd($formFields);

        $listing->update($formFields);
        return redirect('/listings/'.$listing->id)->with('message', 'Listing Updated Successfully!');
    }

    public function destroy(Listing $listing){
        $listing->delete();
        return redirect('/')->with('message', "Listing Deleted Successfully!");
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
