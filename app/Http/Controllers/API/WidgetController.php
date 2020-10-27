<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Widget;
use App\Payment;
use App\Bill;
use App\Item;
use App\Account;
use App\Revenue;


class WidgetController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function update(Request $request){
        $widget=Widget::find($request->widgetId);
        $widget->widget_name=$request->widgetName;
        $widget->sort=$request->widgetSort;
        $widget->width=$request->widgetWidth;
        $widget->update();
        return response()->json(["Message"=>"Record updated"]);
    }

    public function index(Request $request){
        
        $startDate=$request->startDate;
        $endDate=$request->endDate;
        
        $widgets=Widget::where("user_id",auth()->user()->id)->get();
        
        foreach ($widgets as $widget) {
            switch ($widget->type) {
                case 'Total Expenses':
                    if($startDate!="" && $endDate!=""){
                        $total_payments=DB::select("select SUM(amount) as total from payments where bill_id in (select id from bills where user_id=?) AND date>=? AND date<=? limit 1 ",[auth()->user()->id,$startDate,$endDate]);
                        if($total_payments!=null){
                            $widget["total"]=$total_payments[0]->total;
                        }
                        else{
                            $widget["total"]=0;
                        }
                    }
                    else{
                        $total_payments=DB::select("select SUM(amount) as total from payments where bill_id in (select id from bills where user_id=?) limit 1",[auth()->user()->id]);
                        $widget["total"]=$total_payments[0]->total;
                    } 
                    
                    break;
                case 'Total Profit':
                    if($startDate!="" && $endDate!=""){
                        $total_revenues=DB::select("select sum(amount) as total from revenues where invoice_id in (select id from invoices where id in (select invoice_id from invoice_items where item_id in (SELECT id from items where user_id=?)) AND date>=? AND date<=?)",[auth()->user()->id,$startDate,$endDate]);
                        $total_payments=DB::select("select SUM(amount) as total from payments where bill_id in (select id from bills where user_id=?) AND date>=? AND date<=? limit 1",[auth()->user()->id,$startDate,$endDate]);
                        if($total_payments!=null && $total_revenues!=null){
                            $total=$total_revenues[0]->total-$total_payments[0]->total;
                        }
                        else{
                            $total=0;
                        }
                    }
                    else{
                        $total_revenues=DB::select("select sum(amount) as total from revenues where invoice_id in (select id from invoices where id in (select invoice_id from invoice_items where item_id in (SELECT id from items where user_id=?)))",[auth()->user()->id]);
                        $total_payments=DB::select("select SUM(amount) as total from payments where bill_id in (select id from bills where user_id=?) limit 1",[auth()->user()->id]);
                        $total=$total_revenues[0]->total-$total_payments[0]->total;
                    }
                   
                    // return $total_payments;

                    $widget["total"]=$total;
                    break;
                case 'Total Income':
                    if($startDate!="" && $endDate!=""){
                        $total_income=DB::select("select SUM(amount) as total from invoices where id in (select invoice_id from invoice_items where item_id in (SELECT id from items where user_id=?) AND invoice_date>=? AND invoice_date<=?)",[auth()->user()->id,$startDate,$endDate]);
                        if($total_income!=null){
                            $total=$total_income[0]->total;
                        }
                        else{
                            $total=0;
                        }
                    }
                    else{
                        $total_income=DB::select("select SUM(amount) as total from invoices where id in (select invoice_id from invoice_items where item_id in (SELECT id from items where user_id=?))",[auth()->user()->id]);
                        $total=$total_income[0]->total;
                    }
                    

                    $widget["total"]=$total;
                    break;
                case 'Account Balance':
                    if($startDate!="" && $endDate!=""){
                        $accounts=Account::where("user_id",auth()->user()->id)->get()->toArray();    

                        $data=array();
                        foreach ($accounts as $account) {
                            $rev=DB::select('select SUM(amount) as total from revenues where account_id=? AND date>=? AND date<=?',[$account["id"],$startDate,$endDate]);
                            $pay=DB::select('select SUM(amount) as total from payments where account_id=? AND date>=? AND date<=?',[$account["id"],$startDate,$endDate]);
                            if($rev!=null & $pay!=null){
                                $total=$rev[0]->total-$pay[0]->total;
                            }
                            else{
                                $total=0;
                            }
                            $account["total"]=$total;
                            array_push($data,$account);
                        }
                    }
                    else{
                        $accounts=Account::where("user_id",auth()->user()->id)->get()->toArray();    

                        $data=array();
                        foreach ($accounts as $account) {
                            $rev=DB::select('select SUM(amount) as total from revenues where account_id=?',[$account["id"]]);
                            $pay=DB::select('select SUM(amount) as total from payments where account_id=?',[$account["id"]]);
                            $total=$rev[0]->total-$pay[0]->total;
                            $account["total"]=$total;
                            array_push($data,$account);
                        }
                    }
            
                    $widget["accounts"]=$data;
                    break;
                case 'Latest Income':
                    if($startDate!="" && $endDate!=""){
                        $incomes=DB::select("select * from revenues where account_id in (select id from accounts where user_id=?) AND date>=? AND date<=? ORDER BY date DESC", [auth()->user()->id,$startDate,$endDate]);    
                    }
                    else{
                        $incomes=DB::select("select * from revenues where account_id in (select id from accounts where user_id=?) ORDER BY date DESC", [auth()->user()->id]);    
                    }
                  
                    $widget["incomes"]=$incomes;
                    break;
                
                case 'Latest Expences':
                    if($startDate!="" && $endDate!=""){
                        $payments=DB::select("select * from payments where account_id in (select id from accounts where user_id=?) AND date>=? AND date<=? ORDER BY date DESC", [auth()->user()->id,$startDate,$endDate]);    
                    }
                    else{
                        $payments=DB::select("select * from payments where account_id in (select id from accounts where user_id=?) ORDER BY date DESC", [auth()->user()->id]);    
                    }
                    
                    $widget["payments"]=$payments;
                    break;
                
                default:
                    # code...
                    break;
            }
        }

        return response()->json($widgets);
    }
}
