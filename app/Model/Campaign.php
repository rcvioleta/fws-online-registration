<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $guarded = [];

    public function employee()
    {
        return $this->hasMany(Employee::class);
    }
}
