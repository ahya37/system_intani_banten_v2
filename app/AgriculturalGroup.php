<?php

namespace App;

use App\Models\Village;
use Illuminate\Database\Eloquent\Model;

class AgriculturalGroup extends Model
{
    protected $guarded = [];

    public function harvestplanning()
    {
        return $this->hasMany(HarvestPlanning::class);
    }

    public function capital()
    {
        return $this->hasOne(Capital::class,'agricultural_group_id','id');
    }

    public function typeAgricultur()
    {
        return $this->belongsTo(TypeOfAgricultur::class,'type_of_agriculture_id','id');
    }


    public function member()
    {
        return $this->belongsTo(Member::class,'member_id','id');
    }

    public function village()
    {
        return $this->hasOne(Village::class,'id','village_id');
    }

    

}
