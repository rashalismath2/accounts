<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Currency;
use App\Customer;

class CustomerController extends Controller
{
    public function index(Request $request){
        return view("customer");
    }
    public function ShowCreate(Request $request){

        $currency=Currency::where("user_id",auth()->user()->id)->get();

        $data=array("currencies"=>$currency);
        return view("layouts.Customers.create")->with("data",$data);
    }

    public function CreateNew(Request $request){

        $validated=$request->validate([
            "name"=>"string|required",
            "currency"=>"string|required",
        ]);

        $currency=Currency::where("name",$request->currency)->where("user_id",auth()->user()->id)->first();

        $customer=new Customer();
        $customer->name=$request->name;
        $customer->email=$request->email;
        $customer->website=$request->website;
        $customer->phone=$request->phone;
        $customer->address=$request->address;
        $customer->currency_id=$currency->id;
        $customer->user_id=auth()->user()->id;

        $customer->save();

        return redirect()->route("customers")->with("success","customer created");
    }
}
