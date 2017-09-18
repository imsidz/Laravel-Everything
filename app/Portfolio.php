<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolio extends Model
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
        'title', 'image', 'published_at',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'portfolios';

    /**
     * This model associated with a user
     *
     * @return     string  User's id
     */
    public function user(){

      return $this->belongsTo('App\User');

   	}
}
