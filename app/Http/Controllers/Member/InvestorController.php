<?php

namespace App\Http\Controllers\Member;

use App\Farmer;
use App\Member;
use App\Investor;
use App\AgriculturalGroup;
use App\HarvestPlanning;
use Illuminate\Http\Request;
use App\Providers\IntaniProvider;
use App\Http\Controllers\Controller;

class InvestorController extends Controller
{
    public function index()
    {
        // get manager_id berdasarkan member_id login
        // get management berdasarkan 
        $manager = $this->getMember();
        $investorModel = new Investor();
        $investor      = $investorModel->getInvestorByManagement($manager);
        $no = 1;
        
        return view('pages.members.managements.investors.index', compact('no','investor'));
    }

    public function farmerByInvestor($investor_id)
    {
        $investorModel = new Investor();
        $investor      = $investorModel->getNameInvestor($investor_id);
        $farmer        = $investorModel->getFarmerByInvestor($investor_id);
        $provider = new IntaniProvider();

        return view('pages.members.managements.investors.detail-farmer', compact('investor','farmer','investorModel','provider'));

        
    }

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
        $farmer = Farmer::where('member_id', $member_id)->first();
        $agriculturGroup =  AgriculturalGroup::where('farmer_id', $farmer->id)->first();
        $agriculturGroup->update(['status_investor' => 1]);
        return $agriculturGroup;
    }

    public function getMember()
    {
        $member = auth()->guard('member')->user()->id;
        return $member;
    }

    public function capitalBreakdown($agricultur_group_id, $capital_id)
    {
        $investorModel = new Investor();
        $provider = new IntaniProvider();
        $farmer        = $investorModel->getFarmerByAgriculturId($agricultur_group_id);
        $capital_breakdown = $investorModel->getCapitalBreakdown($capital_id);
        $total_jumlah      = $investorModel->getJumlahCapitalBreakdown($agricultur_group_id); 
        return view('pages.members.managements.investors.capital-breakdown', compact('capital_breakdown','farmer','provider','total_jumlah'));
    }

    public function harvestPlanningByAgriculturId($agricultur_group_id)
    {
        $provider = new IntaniProvider();
        $investorModel = new Investor();
        $farmer        = $investorModel->getFarmerByAgriculturId($agricultur_group_id);
        $harvestPlanningModel = new HarvestPlanning();
        $harvest_planning     = $harvestPlanningModel->getHarvestPlanningByAgriculturGroupId($agricultur_group_id);
        $total_harvest        = $harvestPlanningModel->getTotalHarvestByAgriculturGroupId($agricultur_group_id);
        
        return view('pages.members.managements.investors.harvest-planning', compact('harvest_planning','farmer','provider','total_harvest'));

    }
}
