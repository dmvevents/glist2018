<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    //
    protected $table = 'number';

    protected $fillable = ['number','type', 'carrier','state','area'];

}
