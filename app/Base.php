<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    protected $table   = 'bases';
    protected $guarded = [];

    public function member()
    {
        return $this->hasOne(Member::class,'id');
    }
}
