<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
   public function index(Request $request){
       return view("items");
   }
   public function ShowCreate(Request $request){
       return view("layouts.Items.create");
   }
   public function CreateNew(Request $request){
       return view("items");
   }
}
