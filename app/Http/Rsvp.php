<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rsvp extends Model
{
    //
    protected $table = 'rsvp';
    protected $fillable = ['event_id','user_id','guest_id','num_of_guest'];
    
    public function user() {
        return $this->belongsTo('\App\User', 'user_id');
    }

    public function guest() {
        return $this->belongsTo('\App\Guest', 'guest_id');
    }  
    
    public function event() {
        return $this->belongsTo('\App\Event', 'event_id');
    } 
    
    public function number() {
        return $this->belongsTo('\App\Number', 'number_id');
    } 
}
