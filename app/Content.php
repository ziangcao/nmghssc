<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Content extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function setImagesAttribute($image)
    {
        if (is_array($image)) {
            $this->attributes['images'] = json_encode($image);
        }
    }

    public function getImagesAttribute($image)
    {
        return json_decode($image, true);
    }
}
