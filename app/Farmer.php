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
}
