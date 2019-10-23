<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Basic extends Authenticatable
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

    public function setLogoAttribute($image)
    {
        if (is_array($image)) {
            $this->attributes['logo'] = json_encode($image);
        }
    }

    public function getLogoAttribute($image)
    {
        return json_decode($image, true);
    }

    // 为table显示增加contact的属性
    public function getContactAttribute($extra)
    {
        return array_values(json_decode($extra, true) ?: []);
    }

    public function setContactAttribute($extra)
    {
        $this->attributes['contact'] = json_encode(array_values($extra));
    }
}
