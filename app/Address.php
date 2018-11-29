<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
  protected $table = 'address';

  protected $fillable = array('address1', 'address2', 'city','state', 'zip','postalcode','country');


}
