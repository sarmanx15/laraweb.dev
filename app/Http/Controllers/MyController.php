<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyController extends Controller
{
    //p
    public function showAbout(){
    	return view('welcome');
    }
}
