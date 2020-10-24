<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    protected $guarded=[];

    public function account()
    {
        return $this->belongsTo('App\Account', 'account_id', 'id');
    }
    public function customer()
    {
        return $this->belongsTo('App\Customer', 'customer_id', 'id');
    }
    public function invoice()
    {
        return $this->belongsTo('App\Invoice', 'invoice_id', 'id');
    }
}
