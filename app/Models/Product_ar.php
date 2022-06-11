<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Generalsetting;
use App\Models\Currency;
use Illuminate\Support\Facades\Session;

class Product_ar extends Model
{

    protected $fillable = ['id','name_ar','details_ar','slug'];

}