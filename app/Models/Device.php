<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = ['customer_id', 'user_id', 'description', 'status', 'entry_date'];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function maintenances()
    {
        return $this->belongsToMany('App\Models\Maintenance')->withTimestamps();
    }

    public function getEntryDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getDepartureDateAttribute($value)
    {
        if (is_null($value)) {
            return '';
        }

        return Carbon::parse($value)->format('d/m/Y');
    }
}
