<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tapakila extends Model
{
    protected $table = 'tapakila';

    protected $guarded = [
        'code_unique'
    ];

    protected $fillable = ['code_unique', 'vendu', 'scanne', 'reponse', 'users_id', 'ticket_id'];

    public function tickets()
    {
        return $this->belongsTo('App\Models\Ticket');
    }
}
