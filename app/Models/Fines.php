<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fines extends Model
{
    
	protected $table = 'fines';
    
    function vendor(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    
} 
