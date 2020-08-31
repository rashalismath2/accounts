<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    public function items(){
        return $this->belongsToMany('App\Item', 'invoice_items', 'invoice_id', 'item_id');
    }
    public function customers(){
        return $this->hasMany("App\Customer","customer_id");
    }
    public function currencies(){
        return $this->hasMany("App\Currency","currency_id");
    }
}
