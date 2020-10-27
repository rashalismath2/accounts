<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function account()
    {
        return $this->belongsTo('App\Account', 'account_id', 'id');
    }
    public function bill()
    {
        return $this->belongsTo('App\Bill', 'bill_id', 'id');
    }

}
