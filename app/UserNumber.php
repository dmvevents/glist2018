<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserNumber extends Model
{
    protected $table = 'user_number';

    protected $fillable = ['used_id','number_id', 'is_owner','google_doc'];

}
