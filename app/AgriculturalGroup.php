<?php

namespace App;

use App\Models\Village;
use Illuminate\Support\Facades\DB;
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


    public function farmer()
    {
        return $this->belongsTo(Farmer::class,'farmer_id','id');
    }

    public function village()
    {
        return $this->hasOne(Village::class,'id','village_id');
    }

    public function ApiAgriculturByFarmer($farmers_id)
    {
        return DB::table('members as a')
                ->join('farmers as b','a.id','=','b.member_id')
                ->join('agricultural_groups as c','b.id','=','c.farmer_id')
                ->join('type_of_agriculturs as d','c.type_of_agriculture_id','=','d.id')
                ->select('c.id as agricultural_group_id','d.name_type')
                ->where('c.farmer_id', $farmers_id)
                ->get();
    }

    

}
