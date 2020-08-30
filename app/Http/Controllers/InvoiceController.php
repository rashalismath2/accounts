<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request){
        return view("invoice");
    }
    public function ShowCreate(Request $request){
        return view("layouts.Invoices.create");
    }
    public function CreateNew(Request $request){

        
        return response()->json($request);
    }
}
