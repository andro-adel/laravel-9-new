<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider_ar extends Model
{
    protected $fillable = ['id','subtitle_text','title_text','details_text','photo'];
    public $timestamps = false;
}
