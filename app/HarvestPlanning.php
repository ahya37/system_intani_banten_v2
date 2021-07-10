<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class HarvestPlanning extends Model
{
    protected $guarded = [];

    public function agriculturalGroup()
    {
        return $this->belongsTo(AgriculturalGroup::class);
    }

    public function getHarvestPlanningByAgriculturGroupId($agricultur_group_id)
    {
        return DB::table('harvest_plannings')->where('agricultural_group_id', $agricultur_group_id)->get();
    }

    public function getTotalHarvestByAgriculturGroupId($agricultur_group_id)
    {
        $sql = "SELECT sum(a.qty) as jumlah_panen, SUM(a.estimated_selling_price) as estimasi_harga_jual,
                SUM(a.total_income) as estimasi_keuntungan 
                from harvest_plannings as a
                where a.agricultural_group_id = $agricultur_group_id";
        $result = collect(\DB::select($sql))->first();
        return $result;
    }
}
