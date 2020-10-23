<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Invoice;
use App\invoice_items;
use App\Customer;
use App\Currency;
use App\Item;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function __construct()
    {
        // TODO - how to get the token value in the cookie to send in axios
        // $this->middleware('auth:api');
    }

    public function deleteInvoiceById(Request $request){

        //delete invoice items
        $invoice_items=DB::statement("delete from invoice_items where invoice_id=".$request->invoice_id);
        //delete invoice
        $invoice=Invoice::find($request->invoice_id);
        $invoice->delete();
        
        return response()->json([
            'message' => 'Invoice Deleted'
        ]);
    }
}
