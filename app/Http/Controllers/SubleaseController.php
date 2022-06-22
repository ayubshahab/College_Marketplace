<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubleaseController extends Controller
{
    public function create(){
        return view('subleases.create'); 
    }
}
