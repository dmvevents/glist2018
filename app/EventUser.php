<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventUser extends Model
{
    //

    protected $table = 'event_user';

    protected $fillable = ['event_id','user_id', 'is_owner','google_doc','table_doc'];


}
