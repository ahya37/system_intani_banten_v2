<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeOfAgricultur extends Model
{
    protected $guarded = [];
    
    public function agriculturalGroup()
    {
        return $this->hasMany(AgriculturalGroup::class,'id');
    }
}
