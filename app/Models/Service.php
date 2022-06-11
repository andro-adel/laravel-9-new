<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['user_id','title','title_ar','details','details_ar','photo'];
    public $timestamps = false;
}
