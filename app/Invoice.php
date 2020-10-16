<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function items(){
        return $this->belongsToMany('App\Item', 'invoice_items', 'invoice_id', 'item_id')
                    ->using('App\invoice_items')
                    ->withPivot(["qty","price"]);
    }
    public function customers(){
        return $this->belongsTo("App\Customer","customer_id");
    }
    public function currencies(){
        return $this->hasMany("App\Currency","currency_id");
    }
}
