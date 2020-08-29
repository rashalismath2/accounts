<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
   public function index(Request $request){
       return view("items");
   }
   public function ShowCreate(Request $request){
       return view("layouts.Items.create");
   }
   public function CreateNew(Request $request){
        $validatedData = $request->validate([
            'item_name' => 'required|unique:items|max:255',
            'description' => 'max:255',
            'sale_price' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'image' => 'nullable|max:1999',
        ]);

        $item=new Item();
        $item->item_name=$request->item_name;
        $item->description=$request->description;
        $item->sale_price=$request->sale_price;
        $item->purchase_price=$request->purchase_price;

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

       return view("items")->with("succes","Data has been saved");
   }
}
