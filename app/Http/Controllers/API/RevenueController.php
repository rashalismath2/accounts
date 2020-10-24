<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Revenue;

class RevenueController extends Controller
{
    public function deleteRevenueById(Request $request){
        // return $request;
        $rev=Revenue::find($request->id);
        $rev->delete();
        return response()->json(["message"=>"Deleted successfully"]);
    }
}
