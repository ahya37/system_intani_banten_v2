<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Management extends Model
{
    protected $table   = 'managements';
    protected $guarded = [];

    public function investor()
    {
        return $this->belongsTo(Investor::class,'investor_id','id');
    }

    public function getInvestorByManagement($manager)
    {
        $result = DB::table('managements as a')
                    ->join('investors as b','a.investor_id','=','b.id')
                    ->join('members as c','b.member_id','=','c.id')
                    ->join('managers as d','a.manager_id','=','d.id')
                    ->select('a.type_management','a.name_agency','b.id as investor_id','c.name as investor','d.id as manager_id')
                    ->where('d.member_id', $manager)
                    ->get();
        return $result;
    }

    public function getManagerByInvestor($investor_id)
    {
        $sql = "SELECT b.id as manager_id FROM  managements as a
                join managers as b on a.manager_id = b.id
                join investors as c on a.investor_id = c.id
                where c.member_id = $investor_id";
        
        $result = DB::select($sql);
        return $result;
    }

    public function getManagementByInvestor($investor)
    {
        $sql = "SELECT a.name_agency, c.name manager_name, a.id as management_id, c.photo as manager_photo, c.address, 
                c.phone_number, b.id as manager_id from managements as a
                join managers as b on a.manager_id = b.id
                join members as c on b.member_id = c.id
                join investors as d on a.investor_id = d.id
                where d.member_id = $investor";
        
        $result = DB::select($sql);
        return $result;
    }

    public function getNameManager($management_id)
    {
        return DB::table('managements as a')
                    ->join('managers as b','a.manager_id','=','b.id')
                    ->join('members as c','b.member_id','=','c.id')
                    ->select('c.name as manager_name')
                    ->where('a.id', $management_id)->first();
    }

    public function getFarmerByManagementId($management_id)
    {
        return DB::table('managements as a')
                    ->join('investors as b','a.investor_id','=','b.id')
                    ->leftJoin('capitals as c','a.id','=','c.management_id')
                    ->join('agricultural_groups as d','c.agricultural_group_id','=','d.id')
                    ->join('farmers as e','d.farmer_id','=','e.id')
                    ->join('members as f','e.member_id','=','f.id')
                    ->join('villages as g','f.village_id','=','g.id')
                    ->join('districts as h','g.district_id','=','h.id')
                    ->join('regencies as i','h.regency_id','=','i.id')
                    ->select('f.name as farmer_name','e.id as farmer_id','g.name as village','h.name as district','i.name as regency','b.id as investor_id')
                    ->groupBy('f.name','e.id','g.name','h.name','i.name','b.id')
                    ->orderBy('f.name','asc')
                    ->where('a.id',$management_id)
                    ->get();
    }

}
