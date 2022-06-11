<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    protected $table = 'commission';
    
    public function order()
    {
        return $this->hasOne('App\Models\Order');
    }
}