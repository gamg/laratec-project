<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    protected $fillable = ['name', 'price'];

    public function devices()
    {
        return $this->belongsToMany('App\Models\Device')->withTimestamps();
    }
}
