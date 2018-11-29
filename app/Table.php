<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    //
    protected $table = 'tables';
    protected $fillable = ['event_id','user_id','guest_id','table_date','budget','num_of_guest'];
}
