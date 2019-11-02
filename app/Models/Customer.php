<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'last_name',
        'id_number',
        'email',
        'address',
        'phone'
    ];

    public function devices()
    {
        return $this->hasMany('App\Models\Device');
    }
}
