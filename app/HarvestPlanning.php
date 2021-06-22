<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HarvestPlanning extends Model
{
    protected $guarded = [];

    public function agriculturalGroup()
    {
        return $this->belongsTo(AgriculturalGroup::class);
    }
}
