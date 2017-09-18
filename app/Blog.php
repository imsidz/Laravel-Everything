<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'published_at'];

    /**
     * This attributes tell fillable column name
     *
     * @var        array
     */
    protected $fillable = [
        'title', 'content', 'image', 'published_at',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blogs';

    /**
     * This model associated with a user
     *
     * @return     string  User's id
     */
    public function user(){

      return $this->belongsTo('App\User');

   	}

    public function tags(){

        return $this->belongsToMany('App\Tagblog')->withTimestamps();

    }
}
