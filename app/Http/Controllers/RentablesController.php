<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Rentable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('rentables.show',[
            // the current listings we are looking at
            'rentable' => $rentable,
            // list of relatd listings to be used in carousel
            'rentables' => $rentableQuery,
            // all users that have sent a message regarding current listing
            // 'allUsers' => $userQuery,
            'listingOwner' => User::find($rentable->user_id),
            // current users id
            'currentUser'=> Auth::guest() ? null : User::find(auth()->user()->id)
        ]);
    }
}
