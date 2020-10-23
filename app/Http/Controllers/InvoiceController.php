<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Invoice;
use App\invoice_items;
use App\Customer;
use App\Currency;
use App\Item;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\MessageBag;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request){

        $invoices=Invoice::with("items")
                    ->with("customers")
        ->get();
        // return $invoices;
        return view("invoice")->with("invoices",$invoices);
    }

    public function details(Request $request,$id){

        $invoices=DB::table('invoices')
        ->where("invoices.invoice_number",'=',$id)
        ->join("customers","invoices.customer_id","=","customers.id")
        ->join("invoice_items","invoices.id","=","invoice_items.invoice_id")
        ->join('items', function ($join) {
            $join->on('invoice_items.item_id', '=', 'items.id')
                 ->where('items.user_id',auth()->user()->id);
        })
        ->select("invoices.*","customers.*")
        ->get();

        $items=DB::table('items')
                ->where("items.user_id",auth()->user()->id)
                ->join("invoice_items","invoice_items.item_id","=","items.id")
                ->join("invoices","invoices.id","=","invoice_items.invoice_id")
                ->where("invoices.invoice_number",$id)
                ->select("items.*","invoice_items.*")
                ->get();

        $data=array("items"=>$items,"invoices"=>$invoices->first());
        // return $data;
        return view("layouts.Invoices.details")->with("data",$data);
    }

    public function ShowCreate(Request $request){
        $invoice=Invoice::latest()->first();
        $customers=Customer::where("user_id",auth()->user()->id)->get();
        $currencies=Currency::where("user_id",auth()->user()->id)->get();
        $items=Item::where("user_id",auth()->user()->id)->get();
        $data=array("itemsforsuggestions"=>$items,"inv"=>($invoice)!=null?($invoice->id)+1:1,"customers"=>$customers,"currencies"=>$currencies);
        // return $data;
        return view("layouts.Invoices.create")->with("data",$data);
    }

    public function Edit(Request $request,$id){
        $invoices=DB::table('invoices')
        ->where("invoices.id",'=',$id)
        ->join("customers","invoices.customer_id","=","customers.id")
        ->join("invoice_items","invoices.id","=","invoice_items.invoice_id")
        ->join("currencies","invoices.currency_id","=","currencies.id")
        ->join('items', function ($join) {
            $join->on('invoice_items.item_id', '=', 'items.id')
                 ->where('items.user_id',auth()->user()->id);
        })
        ->get();

        $items=DB::table('items')
                ->where("items.user_id",auth()->user()->id)
                ->join("invoice_items","invoice_items.item_id","=","items.id")
                ->where("invoice_items.invoice_id",$id)
                ->get();

        $customers=Customer::where("user_id",auth()->user()->id)->get();
        $currencies=Currency::where("user_id",auth()->user()->id)->get();
        $data=array("items"=>$items,"invoices"=>$invoices->first(),"customers"=>$customers,"currencies"=>$currencies);
        // return $data;
        return view("layouts.Invoices.edit")->with("data",$data);
    }

    public function CreateNew(Request $request,MessageBag $message_bag){
        // return $request;
        $validatedData = $request->validate([
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',
            'invoice_number' => 'required|unique:invoices',
            'customer_id' => 'required',
            'currency_id' => 'required'
        ]);

        $cus=Customer::where("name",$request->customer_id)->where("user_id",auth()->user()->id)->first();
        $cur=Currency::where("currency_name",$request->currency_id)->where("user_id",auth()->user()->id)->first();
        
        $invoice=new Invoice();
        $invoice->invoice_date=$request->invoice_date;
        $invoice->due_date=$request->due_date;
        $invoice->invoice_number=$request->invoice_number;
        $invoice->order_number=$request->order_number; 
        $invoice->customer_id=$cus->id; 
        $invoice->amount=substr($request->total_amount,1); 
        $invoice->notes=$request->notes;
        // save file
        if($request->hasFile("attachment")){

            $invoice->file_id=$this->saveFile($request);
        }
        $invoice->recurring=$request->recurring;
        $invoice->currency_id=$cur->id;

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

        return redirect("/invoices/details/".$invoice->invoice_number)->with('created','success');
    }

    public function update(Request $request){
            // return $request;
            $validatedData = $request->validate([
                'invoice_date' => 'required|date',
                'due_date' => 'required|date',
                'invoice_number' => 'required|exists:invoices',
                'customer_id' => 'required',
                'currency_id' => 'required'
            ]);

            $cus=Customer::where("name",$request->customer_id)->where("user_id",auth()->user()->id)->first();
            $cur=Currency::where("currency_name",$request->currency_id)->where("user_id",auth()->user()->id)->first();
            
            $invoice=Invoice::where("invoice_number",$request->invoice_number)->first();
            $invoice->invoice_date=$request->invoice_date;
            $invoice->due_date=$request->due_date;
            $invoice->invoice_number=$request->invoice_number;
            $invoice->order_number=$request->order_number; 
            $invoice->customer_id=$cus->id; 
            $invoice->amount=substr($request->total_amount,1); 
            $invoice->notes=$request->notes;
            // save file
            // TODO- since we are saving an attachment again delete older attachment
            if($request->hasFile("attachment")){
                $invoice->file_id=$this->saveFile($request);
            }
            $invoice->recurring=$request->recurring;
            $invoice->currency_id=$cur->id;


            //save all the items in items_invocie table
        $all=$request->all();
        $found=false;
        foreach ($all as $key => $item) {
            if(substr($key,0,4)==="item"){
                // when updating we should first delete all the items from the invoice_items table
                //that we had input before
                if(!$found){
                    DB::statement("delete from invoice_items where invoice_id=".$invoice->id);
                }

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
            $message_bag->add('item', "Please add atleast one item");
            return redirect()->route("create_invoice")->withErrors($message_bag);
        }
        $invoice->update();

        return redirect()->route('invoices', ['created' => 'success']);
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
