<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'event';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = ['content'];


    /**
     * Returns a formatted post content entry,
     * this ensures that line breaks are returned.
     *
     * @return string
     */
    public function description()
    {
        return nl2br($this->description);
    }

    /**
     * Get the post's author.
     *
     * @return User
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    /**
     * Get the post's language.
     *
     * @return Language
     */
    public function address()
    {
        return $this->belongsTo('App\Address');
    }

    /**
     * Get the post's category.
     *
     * @return ArticleCategory
     */
    public function venue()
    {
        return $this->belongsTo('App\Venue');
    }

}
