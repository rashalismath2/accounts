<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Customer;
use App\Currency;
use App\Account;
use App\Revenue;

use App\Invoice;

class RevenueController extends Controller
{
    public function index(Request $request){
        $revenues=Revenue::with(["account"=>function($query){
            $query->where("user_id",auth()->user()->id);
        }])
        ->with("customer")->get();
        // return $revenues;
        return view("revenues")->with("revenues",$revenues);
    }

    public function ShowCreate(Request $request){
        
        $accounts=Account::where("user_id",auth()->user()->id)->get();
        $customers=Customer::where("user_id",auth()->user()->id)->get();

        $invoices=Invoice::where("isPaid","Awaiting payment")
            ->with(["items"=>function($query){
                $query->where("user_id",auth()->user()->id);
            }])
            ->get();
                    
        $data=array("invoices"=>$invoices,"accounts"=>$accounts,"customers"=>$customers);

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
        $invoice=Invoice::where("invoice_number",$request->rev_invoice)->first();
        
        $rev=new Revenue();
        $rev->date=$request->rev_date;
        $rev->amount=$request->rev_amount;
        $rev->description=$request->rev_description;
        $rev->payment_method=$request->rev_payment_methods;
        $rev->recurring=$request->rev_recurring;
        $rev->customer_id=$customer->id;
        $rev->account_id=$account->id;
        $rev->invoice_id=$invoice->id;

        if($request->hasFile("rev_attachment")){
            $file_name=$this->saveAttachment($request);
            $rev->file_id=$file_name;
        }
        $rev->save();

        $invoice->isPaid="paid";
        $invoice->update();

        return redirect()->route("revenues")->with("success","Record added");
    }

    public function edit(Request $request,$id){
        $revenues=Revenue::with(["account"=>function($query){
            $query->where("user_id",auth()->user()->id);
        }])
        ->with("customer")
        ->with(["invoice"=>function($query){
            $query->where("id",Revenue::find(Route::current()->parameter('id'))->invoice_id);
        }])->first();


        $accounts=Account::where("user_id",auth()->user()->id)->get();
                    
        $data=array("revenues"=>$revenues,"accounts"=>$accounts);
        // return $data;
        return view("layouts.Revenues.edit")->with("data",$data);
    }

    public function update(Request $request,$id){

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
        $invoice=Invoice::where("invoice_number",$request->rev_invoice)->first();
        
        $rev=Revenue::find($id);
        $rev->date=$request->rev_date;
        $rev->amount=$request->rev_amount;
        $rev->description=$request->rev_description;
        $rev->payment_method=$request->rev_payment_methods;
        $rev->recurring=$request->rev_recurring;
        $rev->customer_id=$customer->id;
        $rev->account_id=$account->id;
        $rev->invoice_id=$invoice->id;

        if($request->hasFile("rev_attachment")){
            $file_name=$this->saveAttachment($request);
            $rev->file_id=$file_name;
        }
        $rev->update();


        return redirect()->route("revenues")->with("success","Record updated");

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
