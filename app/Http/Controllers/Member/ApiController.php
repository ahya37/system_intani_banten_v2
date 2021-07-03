<?php

namespace App\Http\Controllers\Member;

use App\AgriculturalGroup;
use App\Farmer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function getFarmerAPI()
    {
        // get data petani berdasarkan pembuatnya
        $member = auth()->guard('member')->user()->id;
        return  Farmer::with('member')->where('created_by',$member)->get();
    }

    public function getFarmerByManager()
    {
        $member  = auth()->guard('member')->user()->id;
        $farmer  = new Farmer();
        return $farmer->apiGetFarmer($member);

    }

    public function getTypeAgricultur($farmers_id)
    {
        $agriculturGroup = new AgriculturalGroup();
        return $agriculturGroup->ApiAgriculturByFarmer($farmers_id);
    }
}
