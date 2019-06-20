<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
