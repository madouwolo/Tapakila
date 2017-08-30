<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payement_mode extends Model
{
    //
    protected $table = 'payement_mode';

    public function tickets()
    {
        return $this->belongsToMany('App\Models\Ticket');
    }
}
