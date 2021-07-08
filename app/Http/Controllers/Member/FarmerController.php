<?php

namespace App\Http\Controllers\Member;

use App\Farmer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FarmerController extends Controller
{
    public function getMember()
    {
        $member = auth()->guard('member')->user()->id;
        return $member;
    }

    public function index()
    {
        $member   = $this->getMember();
        $farmerModel = new Farmer();
        $farmer      = $farmerModel->getFarmerByManagement($member);
        $no = 1;
        return view('pages.members.managements.farmers.index', compact('farmer','no'));
    }
}
