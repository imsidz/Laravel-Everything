<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tagblog extends Model
{
    protected $table ='tagblogs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];


    public function blogs(){

        return $this->belongsToMany('App\Blog')->withTimestamps();
    }
}
