<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Investor extends Model
{
    protected $guarded = [];

    public function getInvestorByManagement($manager)
    {
        return  DB::table('managements as a')
                    ->join('investors as b','a.investor_id','=','b.id')
                    ->join('members as c','b.member_id','=','c.id')
                    ->join('managers as d','a.manager_id','=','d.id')
                    ->select('a.type_management','a.name_agency','b.id as investor_id','c.name as investor','d.id as manager_id')
                    ->where('d.member_id', $manager)
                    ->get();
        
    }

    public function getNameInvestor($investor_id)
    {
        return DB::table('investors as a')
                    ->join('members as b','a.member_id','=','b.id')
                    ->select('b.name as investor_name')
                    ->where('a.id', $investor_id)
                    ->first();
    }

    public function getFarmerByInvestor($investor_id)
    {
        return DB::table('managements as a')
                    ->join('investors as b','a.investor_id','=','b.id')
                    ->join('capitals as c','a.id','=','c.management_id')
                    ->join('agricultural_groups as d','c.agricultural_group_id','=','d.id')
                    ->join('farmers as e','d.farmer_id','=','e.id')
                    ->join('members as f','e.member_id','=','f.id')
                    ->join('villages as g','f.village_id','=','g.id')
                    ->join('districts as h','g.district_id','=','h.id')
                    ->join('regencies as i','h.regency_id','=','i.id')
                    ->select('f.name as farmer_name','e.id as farmer_id','g.name as village','h.name as district','i.name as regency','b.id as investor_id')
                    ->groupBy('f.name','e.id','g.name','h.name','i.name','b.id')
                    ->where('a.investor_id',$investor_id)
                    ->get();
    }

    public function getDetailAgricultur($farmer_id, $investor_id)
    {
        $sql = " SELECT a.land_area, a.farmer_id, c.id as capital_id, a.id, b.name_type, c.date as tgl_tanam, a.number_of_seeds, d.name as village,
                e.name as district, f.name as regency, a.type_of_seed, a.number_of_seeds, a.unit,
                SUM(g.cost_of_seeds+g.rental_cost+
                g.material_processing_costs+g.planting_costs+g.maintenance_cost+g.fertilizer_costs+
                g.harvest_costs
                +g.other_costs+g.accounts_receivable) as total_biaya 
                from agricultural_groups as a
                join type_of_agriculturs as b on a.type_of_agriculture_id = b.id
                join harvest_plannings as c on a.id = c.agricultural_group_id
                join villages as d on a.village_id = d.id
                join districts as e on d.district_id = e.id
                join regencies as f on e.regency_id = f.id
                join capitals as g on a.id = g.agricultural_group_id
                join managements as h on g.management_id = h.id
                where a.farmer_id = $farmer_id and h.investor_id = $investor_id
                GROUP BY a.land_area, a.farmer_id ,c.id, b.name_type, c.date, a.number_of_seeds, d.name, e.name, f.name, a.type_of_seed,
                a.number_of_seeds, a.unit ";
        $result = DB::select($sql);
        return $result;
    }

    public function getJumlahTotal($farmer_id, $investor_id)
    {
       $sql = "SELECT 
            SUM(a.land_area) as luas_lahan,
            SUM(IF(a.unit = 'kg', a.number_of_seeds,0)) as bibit_ditanam_kg,
            SUM(IF(a.unit = 'satuan', a.number_of_seeds,0)) as bibit_ditanam_satuan,
            SUM(b.cost_of_seeds+b.rental_cost+
            b.material_processing_costs+b.planting_costs+b.maintenance_cost+b.fertilizer_costs+
            b.harvest_costs
            +b.other_costs+b.accounts_receivable) as total_biaya
            from agricultural_groups as a
            join capitals as b on a.id = b.agricultural_group_id
            join managements as c on b.management_id = c.id
            where a.farmer_id = $farmer_id and c.investor_id = $investor_id ";
        return collect(\DB::select($sql))->first();
    }
}
