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

    public function getAgriculturGroupByManagement($member)
    {
        $sql = "SELECT
                e.name_type, e.id as type_of_agriculture_id,
                SUM(d.land_area) as total_luas_lahan,
                SUM(IF(d.unit = 'satuan', d.number_of_seeds, 0)) as total_satuan,
                sum(a.cost_of_seeds+a.rental_cost+a.material_processing_costs+a.planting_costs+a.maintenance_cost+a.fertilizer_costs+a.harvest_costs+a.other_costs+a.accounts_receivable) as total_biaya,
                SUM(IF(d.unit = 'kg', d.number_of_seeds, 0)) as total_kg
                from capitals as a
                join managements as b on a.management_id = b.id
                join managers as c on b.manager_id = c.id
                left join agricultural_groups as d on a.agricultural_group_id = d.id
                join type_of_agriculturs as e on d.type_of_agriculture_id = e.id
                where c.member_id = $member
                GROUP BY e.name_type, e.id order by e.name_type asc";
        $result = DB::select($sql);
        return $result;
    }

    public function getTotalAgriculturGroupByManagement($member)
    {
        $sql = "SELECT
                SUM(d.land_area) as total_luas_lahan,
                SUM(IF(d.unit = 'kg', d.number_of_seeds, 0)) as total_kg,
                SUM(IF(d.unit = 'satuan', d.number_of_seeds, 0)) as total_satuan,
                sum(a.cost_of_seeds+a.rental_cost+a.material_processing_costs+a.planting_costs+a.maintenance_cost+a.fertilizer_costs+a.harvest_costs+a.other_costs+a.accounts_receivable) as total_all_biaya
                from capitals as a
                join managements as b on a.management_id = b.id
                join managers as c on b.manager_id = c.id
                left join agricultural_groups as d on a.agricultural_group_id = d.id
                where c.member_id = $member ";
        $result = collect(\DB::select($sql))->first();
        return $result;
    }

    public function detailFarmerByAgriculturGroupId($type_of_agriculture_id)
    {
        $sql = "SELECT a.type_of_agriculture_id, b.id as farmer_id, c.name as farmer_name, d.name as village, e.name as district, f.name as regency from agricultural_groups as a
                join farmers as b on a.farmer_id = b.id
                join members as c on b.member_id = c.id
                join villages as d on c.village_id = d.id
                join districts as e on d.district_id = e.id
                join regencies as f on e.regency_id = f.id
                where a.type_of_agriculture_id = $type_of_agriculture_id
                group by b.id, a.type_of_agriculture_id , c.name, d.name , e.name, f.name order by c.name asc";
        $result = DB::select($sql);
        return $result;
    }

    public function getAgriculturGroupByFarmer($farmer_id, $type_of_agriculture_id)
    {
        $sql = "SELECT a.id as farmer_id, b.land_area, c.name as village, d.name as district, e.name as regency,
                b.type_of_seed,
                SUM(IF(b.unit = 'kg', b.number_of_seeds,0)) as total_kg,
                SUM(IF(b.unit = 'satuan', b.number_of_seeds,0)) as total_satuan,
                sum(f.cost_of_seeds+f.rental_cost+f.material_processing_costs+f.planting_costs+f.maintenance_cost+f.fertilizer_costs+f.harvest_costs+f.other_costs+f.accounts_receivable) as total_all_biaya
                from farmers as a
                join agricultural_groups as b on a.id = b.farmer_id
                join villages as c on b.village_id = c.id
                join districts as d on c.district_id = d.id 
                join regencies as e on d.regency_id = e.id
                join capitals as f on b.id = f.agricultural_group_id 
                where b.type_of_agriculture_id = $type_of_agriculture_id and a.id = $farmer_id
                group by a.id, b.land_area, c.name , d.name , e.name , b.type_of_seed ";
        $result = DB::select($sql);
        return $result;
    }

    public function getTotalAgriculturGroupByFarmer($farmer_id, $type_of_agriculture_id)
    {
         $sql = "SELECT 
                SUM(a.land_area) as luas_lahan,
                SUM(IF(a.unit = 'kg', a.number_of_seeds,0)) as total_kg,
                SUM(IF(a.unit = 'satuan', a.number_of_seeds,0)) as total_satuan,
                sum(f.cost_of_seeds+f.rental_cost+f.material_processing_costs+f.planting_costs+f.maintenance_cost+f.fertilizer_costs+f.harvest_costs+f.other_costs+f.accounts_receivable) as total_all_biaya
                from agricultural_groups as a
                join capitals as f on a.id = f.agricultural_group_id
                where farmer_id = $farmer_id and a.type_of_agriculture_id = $type_of_agriculture_id ";
        $result = collect(\DB::select($sql))->first();
        return $result;
    }

    

}
