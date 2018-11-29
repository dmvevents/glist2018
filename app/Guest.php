<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    //
    protected $table = 'guest';
    protected $fillable = ['first, last, number_id, address_id, number_id,
    email, dob, gender, instagram, twitter, facebook'];


    public function number() {
        return $this->belongsTo('\App\Number', 'number_id');
    }
}
