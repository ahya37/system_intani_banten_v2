<?php

namespace App\Http\Controllers\Member;

use App\Farmer;
use App\Member;
use App\Investor;
use App\Management;
use App\SurveyTeam;
use App\HarvestPlanning;
use App\AgriculturalGroup;
use App\Capital;
use Illuminate\Http\Request;
use App\Providers\IntaniProvider;
use App\Http\Controllers\Controller;
use App\Manager;

class ManagementController extends Controller
{
    public function getMember()
    {
        $member = auth()->guard('member')->user()->id;
        return $member;
    }
    public function index()
    {
        $member_id = $this->getMember();
        // cek apakah member tersebut sudah memiliki kartu keluarga
        $member = Member::select('photo_family_card')->where('id', $member_id)->first();
        if ($member->photo_family_card == null) {
            return view('pages.members.managements.upload-family-card');
        }
        
        return view('pages.members.managements.index');
        // jika belum redirect ke page upload KK
        // jika sudah ke page index management
    }

    public function saveFamilyCard(Request $request)
    {
         $member_id = $this->getMember();
         $family_card  = $request->file('file')->store('assets/member/photo/photo_family_card','public');
         $member    = Member::where('id', $member_id)->first();
         $save      = $member->update([
             'photo_family_card' => $family_card,
             'roles_manager' => 1
             ]);

         if ($save) {
             return redirect()->route('member-management-index')->with(['success' => 'Kartu keluarga telah diupload']);
         }
         return redirect()->back();

    }

    public function createInvestor()
    {
        return view('pages.members.managements.investors.create');
    }

    public function saveInvestor(Request $request)
    {
        $data['name']        = $request->name;
        $data['gender']      = $request->gender;
        $data['village_id']  = $request->village_id;
        $data['phone_number']= $request->phone_number;
        $data['wa_number']   = $request->wa_number;
        $data['address']     = $request->address;

        
        // simpan ke tb member
        $member = Member::create($data);
        $dataInvestor['member_id'] = $member->id; 
        
        // simpan ke tb investor dengan get member_id yg baru
        $investor = Investor::create($dataInvestor);

        $member_id = $this->getMember();
        $manager   = Manager::create(['member_id' => $member_id]);
        
        // simpan ke tb management dengan get investor_id baru, dan manager_id dari login member
        $management['investor_id'] = $investor->id;
        $management['manager_id']  = $manager->id;
        $management['type_management'] = $request->is_manager == 'false' ? 'Instansi' : 'individu';
        $management['name_agency'] = $request->name_agency == null ? '' : $request->name_agency;
        Management::create($management);

        return redirect()->route('member-management-investor-create')->with(['success' => 'Investor telah disimpan']);
    }

    public function createFarmer()
    {
        return view('pages.members.managements.farmers.create');
    }

    public function saveFarmer(Request $request)
    {
        // get id survey_team berdasarkan login untuk mengetahui siapa yg melakukan survei
        $member_id = $this->getMember();
        $survey_team = SurveyTeam::select('id')->where('member_id', $member_id)->first();
        if ($request->hasFile('photo')){
            $data = $request->all();
            $data['base_id']            = 2;
            $data['survey_team_id']     = $survey_team->id;
            $data['photo']              = $request->file('photo')->store('assets/member/photo','public');
            $data['photo_idcard'] = $request->file('photo_idcard')->store('assets/member/photo-idcard','public');

            $photo_family_card         = $request->photo_family_card != null ? $request->file('photo_family_card')->store('assets/member/photo_family_card','public') : null;
            $data['photo_family_card'] = $photo_family_card;
            
            $member =  Member::create($data);
            $dataFarmer['member_id']  = $member->id;
            $dataFarmer['created_by'] = $member_id;

            // simpan ke tb farmer sebagai petani
            Farmer::create($dataFarmer);

            return redirect()->route('member-management-farmer-create')->with(['success' => 'Petani telah disimpan']);

        }
    }

    public function createAgriculturGroup()
    {
        return view('pages.members.managements.agriculturalgroups.create');
    }

    public function saveAgriculturGroup(Request $request)
    {

        if ($request->hasFile('proof_land_ownership')) {
            $photo_proof = $request->file('proof_land_ownership')->store('assets/member/photo/agriculturgrup','public');
            $photo_area  = '';
            if ($request->hasFile('photo_area')) {
                $photo_area = $request->file('photo_area')->store('assets/member/photo/agriculturgrup','public');
            }

            $data = $this->getAgriculturRequest($request, $photo_area, $photo_proof);
            $agriculture_group = AgriculturalGroup::create($data);
            $agriculture_group_id = $agriculture_group->id;

            // menyimpan ke table perencanaan panen
            $intaniProvider = new IntaniProvider();
            $datas = $intaniProvider->getHarvestPlanningRequest($request, $agriculture_group_id);
            HarvestPlanning::create($datas);
        }else{

             if ($request->hasFile('photo_area')) {
                $photo_area = $request->file('photo_area')->store('assets/member/photo/agriculturgrup','public');
                $photo_proof = NULL;
            }

            $data = $this->getAgriculturRequest($request, $photo_area, $photo_proof);
            $agriculture_group = AgriculturalGroup::create($data);
            $agriculture_group_id = $agriculture_group->id;

            // menyimpan ke table perencanaan panen
            $intaniProvider = new IntaniProvider();
            $datas = $intaniProvider->getHarvestPlanningRequest($request, $agriculture_group_id);
            HarvestPlanning::create($datas);
        }

        return redirect()->route('member-management-agriculturalgroup-create')->with(['success' => 'Kelompok pertanian telah di tambahkan']);
    }

    public function getAgriculturRequest($request, $photo_area, $photo_proof)
    {
        $data = [
                'farmer_id' => $request->farmer_id,
                'type_of_agriculture_id' => $request->type_of_agriculture_id,
                'land_area' => $request->land_area,
                'address_area' => $request->address_area,
                'village_id' => $request->village_id,
                'photo_area' => $photo_area == NULL ? NULL : $photo_area,
                'land_owner' => $request->land_owner,
                'land_certificate_number' => $request->land_certificate_number,
                'proof_land_ownership' => $photo_proof == NULL ? NULL : $photo_proof,
                'type_of_seed' => $request->type_of_seed,
                'number_of_seeds' => $request->number_of_seeds,
                'unit' => $request->unit,
                'origin_of_seed' => $request->origin_of_seed,
                'planting_date' => $request->planting_date,
                'problem' => $request->problem,
                'status' => 'SURVEI',
                'status_survey' => 1,
                'created_by' => auth()->guard('member')->user()->id
        ];
        return $data;
    }

    public function createCapital()
    {
        // menampilkan investor berdasarkan yg di input oleh member login sebagai pengelola
        $manager = $this->getMember();
        $managementModel = new Management();
        $investor      = $managementModel->getInvestorByManagement($manager);

        return view('pages.members.managements.capitals.create', compact('investor'));
    }

    public function saveCapital(Request $request)
    {
        // get management_id berdasarkan investor yg dipilih
        $management = Management::select('id')->where('investor_id', $request->investor_id)->first();

        // simpan permodalan
        $data = [
                'management_id' => $management->id,
                'agricultural_group_id' =>  $request->agricultural_group_id,
                'cost_of_seeds' => $request->cost_of_seeds == null ? 0 : $request->cost_of_seeds,
                'rental_cost' => $request->rental_cost == null ? 0 : $request->rental_cost,
                'material_processing_costs' => $request->planting_costs == null ? 0 : $request->planting_costs,
                'planting_costs' => $request->planting_costs == null ? 0 : $request->planting_costs,
                'maintenance_cost' => $request->maintenance_cost == null ? 0 : $request->maintenance_cost,
                'fertilizer_costs' => $request->fertilizer_costs == null ? 0 : $request->fertilizer_costs,
                'harvest_costs' => $request->harvest_costs == null ? 0 : $request->harvest_costs,
                'other_costs' => $request->other_costs == null ? 0 : $request->other_costs,
                'accounts_receivable' => $request->accounts_receivable == null ? 0 : $request->accounts_receivable
            ];

        Capital::create($data);

        return redirect()->back()->with(['success' => 'Permodalan telah disimpan']);
    }

    public function managementByInvestor()
    {
        $investor = $this->getMember();

        $managementModel = new Management();
        $management      = $managementModel->getManagementByInvestor($investor);
        $no = 1;

        return view('pages.members.investors.management.index', compact('management','no'));
    }

    public function getFarmerByManagement($management_id)
    {
        $investorModel   = new Investor();
        $managementModel = new Management();
        $provider        = new IntaniProvider();

        $manager         = $managementModel->getNameManager($management_id);
        $farmer          = $managementModel->getFarmerByManagementId($management_id);
        $no = 1;
        return view('pages.members.investors.management.detail-farmer', compact('no','manager','farmer','investorModel','provider'));
    }

}
