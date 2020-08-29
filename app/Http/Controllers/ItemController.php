<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


   public function index(Request $request){
        $items=Item::where("user_id",auth()->user()->id)->with("user")->get();
       return view("items")->with("items",$items);
   }

   public function ShowCreate(Request $request){
       return view("layouts.Items.create");
   }

   public function CreateNew(Request $request){
        $this->SaveEditItem($request,0);
        return redirect()->route('items')->with("succes","Data has been saved");
   }

   public function edit(Request $request){
       $item=Item::find($request->item);
        return view("layouts.Items.edit")->with("item",$item);
    }
   public function SaveEdit(Request $request){
        $this->SaveEditItem($request,$request->item_id);
        return redirect()->route('items')->with("succes","Data has been saved");
    }


   public function delete(Request $request){
        $item=Item::find($request->item);
        $item->delete();
       return redirect()->route('items')->with("id",$request->item);
   }

   public function SaveEditItem(Request $request,$id){
    $validatedData = $request->validate([
        'item_name' => 'required|unique:items,item_name,'.$id.'|max:255',
        'description' => 'max:255',
        'sale_price' => 'required|numeric',
        'purchase_price' => 'required|numeric',
        'image' => 'nullable|max:1999',
    ]);

    if($id!=0){
        $item=Item::find($id);
    }
    else{
        $item=new Item();
    }
    $item->item_name=$request->item_name;
    $item->description=$request->description;
    $item->sale_price=$request->sale_price;
    $item->purchase_price=$request->purchase_price;
    $item->user_id=auth()->user()->id;

    if($request->hasFile("image")){
        $fileNameWithExtenstion=$request->file("image")->getClientOriginalName();
        $fileName=pathinfo($fileNameWithExtenstion,PATHINFO_FILENAME);
        $extension=$request->file("image")->getClientOriginalExtension();
        $fileNameToStore=$fileName."_".time().".".$extension;
        $path=$request->file("image")->storeAs("public/items",$fileNameToStore);

        $item->sale_pic_id=$fileNameToStore;
    }
    else{
        $item->sale_pic_id="defaultItemImage.png";
    }

    $item->save();

   }

}
