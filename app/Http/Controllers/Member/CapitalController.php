<?php

namespace App\Http\Controllers\Member;

use App\Farmer;
use App\Member;
use App\Capital;
use App\Investor;
use App\Management;
use App\AgriculturalGroup;
use Illuminate\Http\Request;
use App\Providers\IntaniProvider;
use App\Http\Controllers\Controller;

class CapitalController extends Controller
{
    public function index()
    {
        $manager = $this->getMember();
        $capitalModel = new Capital();
        $capital      = $capitalModel->getInvestorAndCapitalByManagement($manager);
        $total_capital      = $capitalModel->getInvestorAndTotalCapitalByManagement($manager);
        $no = 1;
        $provider = new IntaniProvider();


        return view('pages.members.managements.capitals.index', compact('capital','no','provider','total_capital'));


    }
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
        $farmer = Farmer::where('member_id', $member_id)->first();
        $agricultur  = AgriculturalGroup::select('id','status_capital')->where('farmer_id', $farmer->id)->where('status_capital',0)->first();
       
        $data['investor_id'] = $getId->investor_id;
        $data['manager_id']  = $getId->manager_id;
        $data['type_management'] = 'individu';
        $data['name_agency']     = '';

        // menyimpan ke tabel management
        $management = Management::create($data);

        $dataCapital = [
                'cost_of_seeds' => $request->cost_of_seeds == null ? 0 : $request->cost_of_seeds,
                'rental_cost' => $request->rental_cost == null ? 0 : $request->rental_cost,
                'material_processing_costs' => $request->planting_costs == null ? 0 : $request->planting_costs,
                'planting_costs' => $request->planting_costs == null ? 0 : $request->planting_costs,
                'maintenance_cost' => $request->maintenance_cost == null ? 0 : $request->maintenance_cost,
                'fertilizer_costs' => $request->fertilizer_costs == null ? 0 : $request->fertilizer_costs,
                'harvest_costs' => $request->harvest_costs == null ? 0 : $request->harvest_costs,
                'other_costs' => $request->other_costs == null ? 0 : $request->other_costs,
                'accounts_receivable' => $request->accounts_receivable == null ? 0 : $request->accounts_receivable,
                'management_id' => $management->id,
                'agricultural_group_id' => $agricultur->id
            ];
        
        // menyimpan permodalan
        Capital::create($dataCapital);

        // update status permodalan = 1
        $agricultur->update(['status_capital' => 1]);

        return redirect()->route('member-dashboard')->with(['success' => 'Informasi profesi Anda telah tersimpan']);
    }

    public function detailCapital($investor_id)
    {
        $investorModel = new Investor();
        $capitalModel  = new Capital();
        $investor      = $investorModel->getNameInvestor($investor_id);
        $farmer        = $investorModel->getFarmerByInvestor($investor_id);
        $provider = new IntaniProvider();
        return view('pages.members.managements.capitals.detail',compact('investor','farmer','investorModel','provider','capitalModel'));
    }
}
