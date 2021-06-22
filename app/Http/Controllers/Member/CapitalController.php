<?php

namespace App\Http\Controllers\Member;

use App\AgriculturalGroup;
use App\Capital;
use App\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Management;

class CapitalController extends Controller
{
    public function createPersonal()
    {
        return view('pages.members.next-capital');
    }

    public function getMember()
    {
        $member = auth()->guard('member')->user()->id;
        return $member;
    }

    public function nextStore(Request $request)
    {
        // get investor_id dan manager_id berdasarkan member_id loginnya
        $member_id   = $this->getMember();
        $memberModel = new Member();
        $getId       = $memberModel->getManagerIdAndInvestorIdByMemberId($member_id);

        // get agricultural_group id berdasarkan member dan status_capital = 0
        $agricultur  = AgriculturalGroup::select('id','status_capital')->where('member_id', $member_id)->where('status_capital',0)->first();
       
        $data['investor_id'] = $getId->investor_id;
        $data['manager_id']  = $getId->manager_id;
        $data['type_management'] = 'individu';
        $data['name_agency']     = '';

        // menyimpan ke tabel management
        $management = Management::create($data);

        $dataCapital= $request->all();
        $dataCapital['management_id'] = $management->id;
        $dataCapital['agricultural_group_id'] = $agricultur->id;
        // menyimpan permodalan
        Capital::create($dataCapital);

        // update status permodalan = 1
        $agricultur->update(['status_capital' => 1]);

        return redirect()->route('member-dashboard')->with(['success' => 'Informasi profesi Anda telah tersimpan']);
    }
}
