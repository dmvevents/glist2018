<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  protected $table = 'group';

  protected $fillable = array('name, email,website,address_id,instagram,twitter,facebook');

}
