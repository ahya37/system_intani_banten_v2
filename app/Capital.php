<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Capital extends Model
{
    protected $guarded = [];

    public function agriculturalGroup()
    {
        return $this->belongsTo(AgriculturalGroup::class,'agricultural_group_id');
    }

    public function getTotalCapital($memberid)
    {
        $sql = "SELECT SUM(a.cost_of_seeds + a.rental_cost + a.material_processing_costs
                + a.planting_costs + a.maintenance_cost
                + a.fertilizer_costs + a.harvest_costs 
                + a.other_costs + a.accounts_receivable) as total from capitals as a
                join agricultural_groups as b on a.agricultural_group_id = b.id 
                join farmers  as c on b.farmer_id = c.id 
                where c.member_id = $memberid ";
        $result = collect(\DB::select($sql))->first();
        return $result;
    }

    public function getInvestorAndCapitalByManagement($manager)
    {
        $sql = "SELECT b.id as investor_id, c.name as investor_name,
                SUM(e.cost_of_seeds + e.rental_cost + e.material_processing_costs
                                + e.planting_costs + e.maintenance_cost
                                + e.fertilizer_costs + e.harvest_costs 
                                + e.other_costs + e.accounts_receivable) as total
                from managements as a
                join investors as b on a.investor_id = b.id
                join members as c on b.member_id = c.id
                join managers as d on a.manager_id = d.id
                left join capitals as e on a.id = e.management_id 
                where d.member_id = $manager
                GROUP by b.id, c.name" ;
        $result = DB::select($sql);
        return $result;
    }

    public function getInvestorAndTotalCapitalByManagement($manager)
    {
         $sql = "SELECT 
                SUM(e.cost_of_seeds + e.rental_cost + e.material_processing_costs
                                + e.planting_costs + e.maintenance_cost
                                + e.fertilizer_costs + e.harvest_costs 
                                + e.other_costs + e.accounts_receivable) as total
                from managements as a
                join managers as d on a.manager_id = d.id
                left join capitals as e on a.id = e.management_id 
                where d.member_id = $manager ";
        $result = collect(\DB::select($sql))->first();
        return $result;
    }
}
