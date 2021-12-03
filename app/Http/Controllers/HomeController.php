<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $data=post::all();
        
              return view('home',compact('data'));
    }

   
}
