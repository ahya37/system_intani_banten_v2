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
}
