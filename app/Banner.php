<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Banner extends Authenticatable
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

    public function setImgPathAttribute($image)
    {
        if (is_array($image)) {
            $this->attributes['img_path'] = json_encode($image);
        }
    }

    public function getImgPathAttribute($image)
    {
        return json_decode($image, true);
    }

}
