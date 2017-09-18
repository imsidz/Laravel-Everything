<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Sets the password attribute.
     * This Will bcrypt All Requested password To Database
     * @param      Return  $password  The password
     */
    public function setPasswordAttribute($password)
    {   
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * this user has many slider
     *
     * @return     string  many sliders
     */
    public function sliders(){

        return $this->hasMany('App\Slider');
    
    }

    /**
     * this user has many blogs
     *
     * @return     string  many blogs
     */
    public function blogs(){

        return $this->hasMany('App\Blog');
    
    }
    /**
     * this user has many portfolios
     *
     * @return     string  many portfolios
     */
    public function portfolios(){

        return $this->hasMany('App\Portfolio');
    
    }

    public function videos(){

        return $this->hasMany('App\Video');
    
    }


}
