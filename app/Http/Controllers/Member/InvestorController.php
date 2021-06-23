<?php

namespace App\Http\Controllers\Member;

use App\Member;
use App\Investor;
use App\AgriculturalGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InvestorController extends Controller
{
    public function nextInvestor()
    {
        return view('pages.members.next-investor');
    }

    public function nextStore(Request $request)
    {
        // mendefinisikan variabel
        $is_investor = $request->is_investor;
        $member_id  = $this->getMember();

        // jika pengelolanya adalah dirinya sendiri
        if ($is_investor == 'true') {
            // maka simpan ke tb manager dengan get member_id loginnya
            Investor::create(['member_id' => $member_id]);
           

        // update status_management / status_kelola pada kelompok pertaniannya = 1
        $this->getUpdateStatusInvestor($member_id);
        
        // jika orang lain
        }else{
            //maka, buat data member baru
            $members = Member::create([
                'name' => $request->name,
                'address' => $request->address,
                ]);
            // dan simpan ke tb manager
            Investor::create(['member_id' => $members->id]);

            // update status_management / status_kelola pada kelompok pertaniannya = 1
            $this->getUpdateStatusInvestor($member_id);
        }

        // next ke permodalan

        return redirect()->route('member-next-capital')->with(['success' => 'Pemdoal telah dibuat']);;
    
    }

     public function getUpdateStatusInvestor($member_id)
    {
        $agriculturGroup =  AgriculturalGroup::where('member_id', $member_id)->first();
        $agriculturGroup->update(['status_investor' => 1]);
        return $agriculturGroup;
    }

    public function getMember()
    {
        $member = auth()->guard('member')->user()->id;
        return $member;
    }
}
