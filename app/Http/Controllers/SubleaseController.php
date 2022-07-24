<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Sublease;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SubleaseController extends Controller
{
    public function create(){
        return view('subleases.create'); 
    }

    public function store(Request $request){
        $formFields = $request->validate([
            'user_id'=>'required',
            'sublease_title'=>'required',
            'location'=>'required',
            'date_from'=>'required|date',
            'date_to'=>'required|date|after:date_from',
            'rent'=>'required',
            'negotiable'=> 'required',
            'condition'=>'required',
            'description'=>'required',
            'image_uploads'=>'required',
            'utilities'=>'required',
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
        foreach ($request->file('image_uploads') as $file) {
            $path = $file->store('subleases','s3');
            \Storage::disk('s3')->setVisibility($file, 'public');
            $data[] = $path; 
        }
        $formFields['image_uploads']=json_encode($data);
        $formFields['utilities']=implode(", " ,$formFields['utilities']);
        // dd($formFields);
        $newSublease=Sublease::create($formFields);
        return redirect('/subleases/'.$newSublease->id)->with('message', 'Lease Created Successfully!');
    }

    public function destroy(Sublease $sublease){
        $this->removeFromRecommendations($sublease->id);
        if(is_array(json_decode($sublease->image_uploads))){
            foreach(json_decode($sublease->image_uploads) as $link){
               $this->removeImage($link);
            }
        }
        $sublease->delete();
        return redirect('/')->with('message', "Lease Item Deleted Successfully!");
    }

    public function removeFromRecommendations($id){
        // dd("called remove");
        $string = "Select * from watch_items as w where (w.type LIKE 'lease') AND (w.matches_found LIKE '% " . $id .",%' OR w.matches_found LIKE '% " . $id ."%' )";
        // dd($string);
        $results = DB::select($string);

        // dd($results);

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

    public function show(Sublease $sublease){

        // option 1: when there are alot of items then we can be specific
            // $subleaseQuery = DB::table('subleases');
            // $utilities = explode(", ", $sublease->utilities); //there will always be atleast one category
            // $condition = explode(", ", $sublease->condition); //there will always be atleast one tag

            // $string = "Select * from subleases as s where s.id != " . $sublease->id . " AND " . "s.status NOT LIKE 'Leased'" . " AND ";
            // $string = $string . "( (";
            // foreach($utilities as $utility){
            //     $string = $string . "s.utilities LIKE '%" . $utility . "%' OR ";
            // }
            // $string = substr($string, 0, -4);
            // $string = $string . ") OR (";
            // foreach($condition as $cond){
            //     $string = $string . "s.condition LIKE '%" . $cond . "%' OR ";
            // }
            // $string = substr($string, 0, -4);
            // $string = $string . ") ) limit 10";

            // $userQuery =DB::select($string);
            // $subleaseQuery = Sublease::hydrate($userQuery);

        //option 2: when the data set size is relatively small, return random items from the database
                $subleaseQuery = Sublease::inRandomOrder()
                            ->where('id', '!=', $sublease->id)
                            ->where( function ( $query )
                            {
                                $query->where( 'status', 'NOT LIKE', 'Leased' );
                            })->limit(10)->get();

        // $subleaseQuery = Sublease::latest()->where('status', 'like', 'Available' )->take(10)->get();
        $userQuery = null;
        if(Auth::user()){
            $userQuery = DB::select(
                "
                SELECT users2.id, users2.first_name, users2.last_name, users2.avatar, users2.email, COUNT(case messages.is_read WHEN 0 then 1 else NULL end) as unread
                FROM users
                INNER JOIN messages on messages.to = users.id
                INNER JOIN users as users2 ON messages.from = users2.id
                WHERE messages.for_sublease = ". $sublease->id." and users2.id != ".auth()->id()."
                GROUP BY users2.id, users2.first_name, users2.last_name, users2.avatar, users2.email
                "
            );
        }
        
        // five things being passed in: 
        // 1) current lease item we are looking at
        // 2) list of related lease items to be used in the carousel
        // 3) list of all users that have ever sent a message regarding that lease item
        // 4) listing Owner, the author of the lease item
        // 5) currentUser, the current user logged in
        return view('subleases.show',[
            'leaseItem' => $sublease,
            'subleaseQuery' => $subleaseQuery,
            'allUsers' => $userQuery,
            'listingOwner' => User::find($sublease->user_id),
            'currentUser'=> Auth::guest() ? null : User::find(auth()->user()->id)
        ]);
    }

    public function edit(Sublease $sublease){
        if($sublease->user_id != auth()->id()){
            abort('404', 'Unauthorized Access');
            return redirect('/')->with('message', 'Please only edit listings you own');
        }
        return view('subleases.edit', ['sublease' =>$sublease]);
    }

    public function updateStatus(Request $request, Sublease $sublease){
        if($sublease->user_id != auth()->id()){
            abort('404', 'Unauthorized Access');
            return redirect('/')->with('message', 'Please only edit listings you own');
        }
        $data = Sublease::find($sublease->id);
        $data->status = $request->status;
        $data->save();
        return back()->with('message', "Lease Item Updated Successfully");
    }

    public function update(Request $request, Sublease $sublease){
        if($sublease->user_id != auth()->id()){
            abort('404', 'Unauthorized Access');
            return redirect('/')->with('message', 'Please only edit listings you own');
        }
        $formFields = $request->validate([
            'user_id'=>'required',
            'sublease_title'=>'required',
            'location'=>'required',
            'date_from'=>'required|date',
            'date_to'=>'required|date|after:date_from',
            'rent'=>'required',
            'negotiable'=> 'required',
            'condition'=>'required',
            'description'=>'required',
            'utilities'=>'required',
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
                $path = $file->store('subleases','s3');
                \Storage::disk('s3')->setVisibility($file, 'public');
                //$fullURL = \Storage::disk('s3')->url($name); 
                $data[] = $path; 
            }
            $formFields['image_uploads']=json_encode($data);
        }
        $formFields['utilities']=implode(", " ,$formFields['utilities']);
        $sublease->update($formFields);
        return redirect('/subleases/'.$sublease->id)->with('message', 'Lease Item Updated Successfully!');
    }

     public static function getSubleaseById($sublease){
        // dd("test");
        return Sublease::find($sublease);
    }
}
