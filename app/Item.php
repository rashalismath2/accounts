<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class Item extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function invoices(){
        return $this->belongsToMany('App\Invoice', 'invoice_items', 'item_id', 'invoice_id');
    }
}
