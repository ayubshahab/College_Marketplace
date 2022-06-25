<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rentable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RentablesController extends Controller
{
    public function create(){
        return view('rentables.create'); 
    }

     public function store(Request $request){
        // dd($request->all());
        $formFields = $request->validate([
            'user_id'=>'required',
            'rental_title'=>'required',
            'rental_duration'=>'required',
            'rental_charging'=> 'required',
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
                $name = $file->store('rentables','public');
                $data[] = $name; 
            }
            $formFields['image_uploads']=json_encode($data);
        }
        $formFields['category']=implode(", " ,$formFields['category']);

        // dd($formFields);
        $newRentable=Rentable::create($formFields);
        return redirect('/rentables/'.$newRentable->id)->with('message', 'Rental Created Successfully!');
    }

    public function show(Rentable $rentable){
        $rentableQuery = Rentable::latest()->where('status', 'like', 'Available' )->take(10)->get();

        $userQuery = null;
        if(Auth::user()){
            $userQuery = DB::select(
                "
                SELECT users2.id, users2.first_name, users2.last_name, users2.avatar, users2.email, COUNT(case messages.is_read WHEN 0 then 1 else NULL end) as unread
                FROM users
                INNER JOIN messages on messages.to = users.id
                INNER JOIN users as users2 ON messages.from = users2.id
                WHERE messages.for_rentals = ". $rentable->id." and users2.id != ".auth()->id()."
                GROUP BY users2.id, users2.first_name, users2.last_name, users2.avatar, users2.email
                "
            );
        }

        return view('rentables.show',[
            // the current listings we are looking at
            'rentable' => $rentable,
            // list of relatd listings to be used in carousel
            'rentables' => $rentableQuery,
            // all users that have sent a message regarding current listing
            'allUsers' => $userQuery,
            //listing owner
            'rentableOwner' => User::find($rentable->user_id),
            // current users id
            'currentUser'=> Auth::guest() ? null : User::find(auth()->user()->id)
        ]);
    }
}
