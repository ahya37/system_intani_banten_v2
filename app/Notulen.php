<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notulen extends Model
{
    protected $table  = 'notulensis'; 
    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
