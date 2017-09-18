<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use SoftDeletes;


    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * This attributes tell fillable column name
     *
     * @var        array
     */
    protected $fillable = [
        'videoid',
    ];


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'videos';

    public function user(){

      return $this->belongsTo('App\User');

   	}
}
