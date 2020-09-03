<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Invoice;
use App\invoice_items;
use App\Customer;
use App\Currency;
use App\Item;

use Illuminate\Support\MessageBag;

class InvoiceController extends Controller
{
    public function index(Request $request){
        return view("invoice");
    }
    public function ShowCreate(Request $request){
        $invoice=Invoice::latest()->first();
        $customers=Customer::where("user_id",auth()->user()->id)->get();
        $currencies=Currency::where("user_id",auth()->user()-id)->get();
        $items=Item::where("user_id",ath()->user()->id)->get();
        $data=array("items"=>$items,"inv"=>($invoice->id)+1,"customers"=>$customers,"currencies"=>$currencies);
        return view("layouts.Invoices.create")->with("data",$data);
    }
    public function CreateNew(Request $request,MessageBag $message_bag){
        
        $validatedData = $request->validate([
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',
            'invoice_number' => 'required|unique:invoices',
            'customer_id' => 'required',
            'currency_id' => 'required'
        ]);

        $cus=Customer::where("name",$request->customer_id)->where("user_id",auth()->user()->id)->first();
        $cur=Currency::where("name",$request->currency_id)->where("user_id",auth()->user()->id)->first();

        $invoice=new Invoice();
        $invoice->invoice_date=$request->invoice_date;
        $invoice->due_date=$request->due_date;
        $invoice->invoice_number=$request->invoice_number;
        $invoice->order_number=$request->order_number; 
        $invoice->customer_id=$cus->id; 
        $invoice->notes=$request->notes;
        // save file
        if($request->hasFile("attachment")){

            $invoice->file_id=$this->saveFile($request);
        }
        $invoice->recurring=$request->recurring;
        $invoice->currency_id=$cus->id;

        $invoice->save();
        // get saved invocie
        $invoice=Invoice::where("invoice_number",$request->invoice_number)->first();


        //save all the items in items_invocie table
        $all=$request->all();
        $found=false;
        foreach ($all as $key => $item) {
            if(substr($key,0,4)==="item"){
                $found=true;
                $strlen=strlen($key);
                $index=substr($key,4,$strlen);
                $qty="qty".$index;
                $price="price".$index;

                $itemInDb=Item::where("item_name",$item)->first();
                if($itemInDb==null){
                    $message_bag->add('item', 'Item was not found');
                    return redirect()->route("create_invoice")->withErrors($message_bag);
                }
                $newarr=array(
                    "item_id"=>$itemInDb->id,
                    "invoice_id"=>$invoice->id,
                    "qty"=>$request->$qty,
                    "price"=>$request->$price
                );

                invoice_items::create($newarr);
            }
        }

            //if user didnt enter itemswe will delete the invocie
        if(!$found){
            $invoice->delete();
            $message_bag->add('item', "Please add atleast one item");
            return redirect()->route("create_invoice")->withErrors($message_bag);
        }

        return redirect()->route('invoices', ['created' => 'success']);;
    }

    public function saveFile($request){
        
            $fileNameWithExtenstion=$request->file("attachment")->getClientOriginalName();
            $fileName=pathinfo($fileNameWithExtenstion,PATHINFO_FILENAME);
            $extension=$request->file("attachment")->getClientOriginalExtension();
            $fileNameToStore=$fileName."_".time().".".$extension;
            $path=$request->file("attachment")->storeAs("public/invoices",$fileNameToStore);
    
            return $fileNameToStore;
        
    }
}
