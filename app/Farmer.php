<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    protected $guarded = [];

    public function member()
    {
        return $this->belongsTo(Member::class,'member_id','id');
    }

    public function apiGetFarmer($member)
    {
        return DB::table('farmers as a')
                ->join('members as b','a.member_id','=','b.id')
                ->select('a.id as farmer_id','b.name as farmer_name')
                ->where('a.created_by', $member)
                ->get();

    }

    public function getFarmerByManagement($member)
    {
        return DB::table('farmers as a')
                ->join('members as b','a.member_id','=','b.id')
                ->join('villages as c','b.village_id','=','c.id')
                ->join('districts as d','c.district_id','=','d.id')
                ->join('regencies as e','d.regency_id','=','e.id')
                ->select('a.id as farmer_id','b.name as farmer_name','b.photo','b.phone_number','b.id as member_id','c.name as village','d.name as district','e.name as regency')
                ->where('a.created_by', $member)
                ->get();
    }
}
