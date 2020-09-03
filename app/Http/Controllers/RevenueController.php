<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Customer;
use App\Currency;
use App\Account;
use App\Revenue;

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

        $validated=$request->validate([
            "rev_date"=>"date|required",
            "rev_amount"=>"numeric|required",
            "rev_account"=>"string|required",
            "rev_payment_methods"=>"string|required",
        ]);

        $customer=Customer::where("name",$request->rev_customer)
                        ->where("user_id",auth()->user()->id)->first();
        
        $account=Account::where("acc_name",$request->rev_account)
                            ->where("user_id",auth()->user()->id)->first();

        $d=array("cus"=>$customer,"acc"=>$account,"req"=>$request->all());                    
        // return response()->json($d);

        $rev=new Revenue();
        $rev->date=$request->rev_date;
        $rev->amount=$request->rev_amount;
        $rev->description=$request->rev_description;
        $rev->payment_method=$request->rev_payment_methods;
        $rev->recurring=$request->rev_recurring;
        $rev->customer_id=$customer->id;
        $rev->account_id=$account->id;

        if($request->hasFile("rev_attachment")){
            $file_name=$this->saveAttachment($request);
            $rev->file_id=$file_name;
        }
        $rev->save();

        return redirect()->route("revenues")->with("success","Record added");
    }

    public function saveAttachment($request){

        $fileNameWithExtension=$request->file("rev_attachment")->getClientOriginalName();
        $fileName=pathinfo($fileNameWithExtension,PATHINFO_FILENAME);
        $extension=$request->file("rev_attachment")->getClientOriginalExtension();
        $storeAs=$fileName."_".time().".".$extension;

        $request->file("rev_attachment")->storeAs("public/RevenueAttachments",$storeAs);

        return $storeAs;

    }

}
