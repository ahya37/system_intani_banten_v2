<?php

namespace App\Http\Controllers\Member;

use App\AgriculturalGroup;
use App\Cultivators;
use App\Enterpreneurs;
use App\Farms;
use App\Fisherman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;

class ProfileController extends Controller
{
    public function getData()
    {
        $account_member = auth()->guard('member')->user()->id;
        $member         = Member::with(['village','base'])->where('id', $account_member)->first();
        return $member;
    }

    public function index()
    {
        $member = $this->getData();        
        return view('pages.members.profile.index', compact('member'));
    }

    public function ecard()
    {
        $member = $this->getData();       
        return view('pages.members.profile.ecard', compact('member'));
    }

    public function profession()
    {
        $member_id = auth()->guard('member')->user()->id;

        $agriculturGroup = AgriculturalGroup::with('member')->where('member_id', $member_id)->first();
        $cultivator      = Cultivators::with('member')->where('member_id', $member_id)->first();
        $enterpreneur    = Enterpreneurs::with('member')->where('member_id', $member_id)->first();
        $farm            = Farms::with('member')->where('member_id', $member_id)->first();
        $fisherman       = Fisherman::with('member')->where('member_id', $member_id)->first();    
        
        return view('pages.members.details-profession', compact('agriculturGroup','cultivator','enterpreneur','farm','fisherman'));
        
        
    }
}
