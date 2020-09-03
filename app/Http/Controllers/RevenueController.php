<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;
use App\Currency;
use App\Account;

class RevenueController extends Controller
{
    public function index(Request $request){
        $revenues=array();
        return view("revenues")->with("revenues",$revenues);
    }

    public function ShowCreate(Request $request){
        
        $accounts=Account::where("user_id",auth()->user()->id)->get();
        $customers=Customer::where("user_id",auth()->user()->id)->get();

        $data=array("accounts"=>$accounts,"customers"=>$customers);

        return view("layouts.Revenues.create")->with("data",$data);
    }

    public function CreateNew(Request $request){
        return response()->json($request);
    }

}
