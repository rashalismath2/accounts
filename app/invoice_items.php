<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class invoice_items extends Pivot
{
    protected $table = 'invoice_items';

    public function Invoices()
    {
        return $this->hasMany('App\invoice', 'id', 'invoice_id');
    }
}
