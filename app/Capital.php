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
                where b.member_id = $memberid ";
        $result = collect(\DB::select($sql))->first();
        return $result;
    }
}
