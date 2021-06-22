<?php

namespace App;

use App\Models\Village;
use Illuminate\Support\Facades\DB;
use Alfa6661\AutoNumber\AutoNumberTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use AutoNumberTrait;

    protected $table    = 'members';
    protected $guarded  = [];

    public function getAutoNumberOptions()
    {
        return [
            'code' => [
                'length' => 8
            ]
        ];
    }

    public function profession()
    {
        return $this->belongsTo(ProfessionalCategory::class,'professional_category_id','id');
    }

    public function village()
    {
        return $this->belongsTo(Village::class,'village_id');
    }

    public function notulens()
    {
        return $this->hasMany(Notulensi::class);
    }

    public function base()
    {
        return $this->belongsTo(Base::class,'base_id');
    }

    public function getProfesion($member_id)
    {
        $result = DB::table('members as a')
                    ->join('professional_categories as b','a.professional_category_id','=','b.id')
                    ->select('a.id as member_id','a.name as member_name','b.id as profession_id','b.name as profession')
                    ->where('a.id', $member_id)
                    ->first();
        return $result;
    }

    public function getManagerIdAndInvestorIdByMemberId($member_id)
    {
        $result = DB::table('investors as a')
                    ->join('members as b', 'b.id','=','a.member_id')
                    ->join('managers as c','c.member_id','=','b.id')
                    ->select('a.id as investor_id','c.id as manager_id')
                    ->where('b.id', $member_id)
                    ->first();
        return $result;
    }

}