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

    public function getFarmerByInvestor($investor_id)
    {
        $sql = "SELECT f.id as farmer_id FROM  managements as a
                join managers as b on a.manager_id = b.id
                join investors as c on a.investor_id = c.id
                left join capitals as d on a.id = d.management_id
                join agricultural_groups as e on d.agricultural_group_id = e.id
                join farmers as f on e.farmer_id = f.id
                join members as g on f.member_id = g.id
                where c.member_id = $investor_id group by f.id";
        return DB::select($sql);
    }

    public function getFarmerByAccountInvestor($investor)
    {
        $sql = "SELECT a.id as member_id, a.name as farmer_name, g.name as village, h.name as district, 
                i.name as regency, a.phone_number, a.photo
                from members as a
                join farmers as b on a.id = b.member_id
                join agricultural_groups as c on b.id = c.farmer_id
                join capitals as d on c.id = d.agricultural_group_id
                join managements as e on d.management_id = e.id
                join investors as f on e.investor_id = f.id
                join villages as g on a.village_id = g.id
                join districts as h on g.district_id = h.id
                join regencies as i on h.regency_id = i.id
                where f.member_id = $investor
                group by a.name, a.id, g.name, h.name, i.name, a.phone_number, a.photo";
        return DB::select($sql);
    }
}
