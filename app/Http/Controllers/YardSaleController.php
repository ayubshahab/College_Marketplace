<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Listing;
use App\Models\YardSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class YardSaleController extends Controller
{
    public function create(){
        return view('yardsales.create');
    }

    public function store(Request $request){
        // dd($request->all());
        $formFields = $request->validate([
            'user_id'=>'required',
            'yard_sale_title'=>'required',
            'yard_sale_date'=>'required',
            'start_time'=> 'required',
            'end_time'=>'required',
            'category'=>'required',
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
                $name = $file->store('yardsales','public');
                $data[] = $name; 
            }
            $formFields['image_uploads']=json_encode($data);
        }
        $formFields['category']=implode(", " ,$formFields['category']);
        // dd($formFields);

        YardSale::create($formFields);
        // Listing::create($formFields);
        // // or use ->to('/')
        return redirect('/')->with('message', 'Yard Sale Post Created Successfully!');
    }

    public function show(YardSale $yardsale){
        // dd($yardSale->all());
        return view('yardsales.show', ['listings' => Listing::latest()->take(10)->get(),
        'yardsale' => $yardsale,
        'allUsers' => User::all(),
        'currentUser' => Auth::guest() ? null : auth()->user()->id]);

    }
}
