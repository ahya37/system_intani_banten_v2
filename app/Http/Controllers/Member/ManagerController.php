<?php

namespace App\Http\Controllers\Member;

use App\AgriculturalGroup;
use App\Farmer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Manager;
use App\Member;

class ManagerController extends Controller
{
    public function nextManagement()
    {
        return view('pages.members.next-management');
    }

    public function nextStore(Request $request)
    {
        // mendefinisikan variabel
        $is_manager = $request->is_manager;
        $member_id  = $this->getMember();

        // jika pengelolanya adalah dirinya sendiri
        if ($is_manager == 'true') {
            // maka simpan ke tb manager dengan get member_id loginnya
            Manager::create(['member_id' => $member_id]);

            // update status_management / status_kelola pada kelompok pertaniannya = 1
            $this->getUpdateStatusManagement($member_id);
        
        // jika orang lain
        }else{
            //maka, buat data member baru
            $members = Member::create([
                'name' => $request->name,
                'address' => $request->address,
                ]);
            // dan simpan ke tb manager
            Manager::create(['member_id' => $members->id]);

            // update status_management / status_kelola pada kelompok pertaniannya = 1
            $this->getUpdateStatusManagement($member_id);
           
        }

        return redirect()->route('member-next-investor')->with(['success' => 'Pengelola telah dibuat']);
        
    }

    public function getUpdateStatusManagement($member_id)
    {
        $farmer = Farmer::where('member_id', $member_id)->first();
        $agriculturGroup =  AgriculturalGroup::where('farmer_id', $farmer->id)->first();
        $agriculturGroup->update(['status_management' => 1]);
        return $agriculturGroup;
    }

    public function getMember()
    {
        $member = auth()->guard('member')->user()->id;
        return $member;
    }
}
