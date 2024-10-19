<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplateController extends Controller
{
   public function index()
   {
    return view('Frontend.home');
   }
   public function about()
   {
    return view('Frontend.about');
   }
   public function contact()
   {
    return view('Frontend.contact');
   }
}
