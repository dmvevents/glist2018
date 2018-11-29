<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    //
    {
      protected $table = 'company';

      protected $fillable = array('name, email,website,address_id,instagram,twitter,facebook');

    }
}
