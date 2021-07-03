<?php

namespace App\Http\Controllers\Member;

use App\Member;
use App\Capital;
use App\Manager;
use App\Investor;
use App\Management;
use App\SurveyTeam;
use App\HarvestPlanning;
use App\AgriculturalGroup;
use App\Farmer;
use App\Mail\SubmissionMail;
use Illuminate\Http\Request;
use App\Providers\IntaniProvider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class SurveyTeamController extends Controller
{
    public function index()
    {
        $member_id = $this->getMember();
        $member    = Member::select('id','roles_survey_team')->where('id', $member_id)->first();
        $roles     =$member->roles_survey_team;
        // jika belum mengajukan menjadi tim survey
        switch ($roles) {
            case 0:
                return view('pages.members.survey-teams.before-aprove');
                break;
            case 1:
                return view('pages.members.survey-teams.process-aprove');
                break;
            default:
                return view('pages.members.survey-teams.index');
                break;
        }
    }

    public function saveSubmission()
    {
        $member_id = $this->getMember();
        $sekjen    = 'ahyadev101@gmail.com';

        $member = Member::with(['village','profession'])->where('id', $member_id)->first();
        $member->update(['roles_survey_team' => 1]);

        // mengirim email ke akun sekjen
        Mail::to($sekjen)->send(new SubmissionMail($member));

        return redirect()->route('member-surveyteam')->with(['success' => 'Pengajuan Anda berhasil']);

    }

    public function getMember()
    {
        $member = auth()->guard('member')->user()->id;
        return $member;
    }

    public function getSurveyTeamId()
    {
        $member_id      = $this->getMember();
        $survey_team    = SurveyTeam::select('id','member_id')->where('member_id', $member_id)->first();
        $surveyor       = array(['member_id' => $member_id,'survey_team' => $survey_team]);
        return $surveyor;
    }

    public function successAproveSubmission($code)
    {
        $member = Member::where('code', $code)->first();
        $member->update(['roles_survey_team' => 2]);

        // sampan ke tb survey_team
        SurveyTeam::create(['member_id' => $member->id]);

        return view('pages.members.success-aprove-submission',compact('member'));
    }

    public function pageFarmer()
    {
        // cek apakah ada kelompok pertanian yang belum memiliki jenis pertanian 
        // berdasarkan survey_team_id berdasrkan member_login (penyurvei)
        $member_id      = $this->getMember();
        $survey_team    = SurveyTeam::select('id','member_id')->where('member_id', $member_id)->first();
        $survey_team_id = $survey_team->id;

        $agricultur_group = AgriculturalGroup::with('member')->where('status_survey','=',0)
                            ->where('survey_team_id', $survey_team_id)->get();

        return view('pages.members.survey-teams.farmers.index', compact('agricultur_group'));
    }

    public function createFarmer()
    {
        // cek apakah ada kelompok pertanian yang belum memiliki jenis pertanian 
        // berdasarkan survey_team_id berdasrkan member_login (penyurvei)
        $member_id      = $this->getMember();
        $survey_team    = SurveyTeam::select('id','member_id')->where('member_id', $member_id)->first();
        $survey_team_id = $survey_team->id;

        $agricultur_group = AgriculturalGroup::with('farmer.member')->where('status_survey','=',0)
                            ->where('survey_team_id', $survey_team_id)->get();

        return view('pages.members.survey-teams.farmers.create', compact('agricultur_group'));
    }

    public function saveAddFarmer(Request $request)
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
            $datafarmer['member_id'] = $member->id;

            // simpan ke tb farmer / sebagai petani
            $farmer =  Farmer::create($datafarmer);
            
            // simpan ke tb agiricultural_group / kelompok pertanian
            // dan set default status_management = 0 / belum ada pengelolanya
            AgriculturalGroup::create([
                'farmer_id' => $farmer->id,
                'status'     => 'SURVEI',
                'survey_team_id' => $survey_team->id
                ]);

        }
        return redirect()->route('member-farmer-create')->with(['success' => 'Petani' .$member->name.' telah disimpan']);

    }

    public function createAgriculturGroup($member_id)
    {
        $survey_team = $this->getSurveyTeamId();
        $survey_team_id = $survey_team[0]['survey_team']['id'];
        $farmer  = Farmer::select('id')->where('member_id', $member_id)->first();

        $agricultur_group = AgriculturalGroup::with('farmer.member')->where('status_survey','=',0)
                            ->where('farmer_id', $farmer->id)
                            ->where('survey_team_id', $survey_team_id)->first();
        return view('pages.members.survey-teams.agriculturalgroups.create', compact('agricultur_group'));
    }

    public function saveAddAgriculturGroup(Request $request)
    {     
        $agriculture_group = AgriculturalGroup::where('farmer_id', $request->farmer_id)->first();

        if ($request->hasFile('proof_land_ownership')) {
            $photo_proof = $request->file('proof_land_ownership')->store('assets/member/photo/agriculturgrup','public');
            $photo_area  = '';
            if ($request->hasFile('photo_area')) {
                $photo_area = $request->file('photo_area')->store('assets/member/photo/agriculturgrup','public');
            }

            $data['status_survey'] = 1;
            $data = $this->getAgriculturRequest($request, $photo_area, $photo_proof);
            
            $agriculture_group->update($data);
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

            $data['status_survey'] = 1;
            $data = $this->getAgriculturRequest($request, $photo_area, $photo_proof);

            $agriculture_group->update($data);
            $agriculture_group_id = $agriculture_group->id;

            // menyimpan ke table perencanaan panen
            $intaniProvider = new IntaniProvider();
            $datas = $intaniProvider->getHarvestPlanningRequest($request, $agriculture_group_id);
            HarvestPlanning::create($datas);
        }

        return redirect()->route('member-agricultur')->with(['success' => 'Kelompok pertanian telah di tambahkan']);
    }

    public function getAgriculturRequest($request, $photo_area, $photo_proof)
    {
         // get id survei berdasarkan member login
        $survey_team = $this->getSurveyTeamId();
        $survey_team_id = $survey_team[0]['survey_team']['id'];

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
                'survey_team_id' =>  $survey_team_id,
                'status_survey' => 1
        ];
        return $data;
    }

    public function pageAgriculturalGroup()
    {
        $survey_team = $this->getSurveyTeamId();
        $survey_team_id = $survey_team[0]['survey_team']['id'];
        $agricultur_group = AgriculturalGroup::with('farmer.member')
                            ->where('status_survey','=',1)
                            ->where('status_management','=',0)
                            ->where('survey_team_id', $survey_team_id)->get();

        return view('pages.members.survey-teams.agriculturalgroups.index', compact('agricultur_group'));
    }

    public function createManagement($id)
    {
        return view('pages.members.survey-teams.managements.create', compact('id'));
    }

    public function saveManagement(Request $request)
    {
        $member['name']        = $request->name;
        $member['gender']      = $request->gender;
        $member['village_id']  = $request->village_id;
        $member['phone_number']= $request->phone_number;
        $member['wa_number']   = $request->wa_number;
        $member['address']     = $request->address;

        // simpan ke tb member
        $member = Member::create($member);
        $manager['member_id'] = $member->id;

        // simpan ke tb manager dengan get id baru nya
        $manager = Manager::create($manager);
        $management['manager_id'] = $manager->id;
        
        // simpan ke tb mangement dengan get manager_id baru nya
        $management['type_management'] = $request->is_manager == 'true' ? 'Individu' : 'Instansi';
        $management['name_agency'] = $request->is_manager == 'true' ? $request->name_agency : '';
        $management =  Management::create($management);
        // get management->id / id management barunya untuk jadikan parameter
        $management_id = $management->id;

        // update status_management pada kelompok pertanian
        $agricultur_group_id = $request->agricultur_group_id;
        $agricultur_group    = AgriculturalGroup::where('id', $agricultur_group_id)->first();
        $agricultur_group->update(['status_management' => 1]);
        
        // redirect ke page form investor
        return redirect()->route('member-investor-create',['management_id' => $management_id,'agricultur_group_id' => $agricultur_group_id])->with(['success' => 'Pengelola telah di tambahkan']);;

    }

    public function createInvestor($management_id, $agricultur_group_id)
    {
        return view('pages.members.survey-teams.investors.create', compact('management_id','agricultur_group_id'));
    }

    public function saveInvestor(Request $request)
    {
        $member['name']        = $request->name;
        $member['gender']      = $request->gender;
        $member['village_id']  = $request->village_id;
        $member['phone_number']= $request->phone_number;
        $member['wa_number']   = $request->wa_number;
        $member['address']     = $request->address;

        // simpan ke tb member
        $member = Member::create($member);
        $datainvestor['member_id'] = $member->id;

        // simpan sebagai investor ke tb investor
        $investor = Investor::create($datainvestor);

        // get id member barunya
        $investor_id = $investor->id;
        // update management, isi investor nya dengan member_id baru
        $management = Management::where('id', $request->management_id)->first();
        $management->update(['investor_id' => $investor_id]);

        // update status_management pada kelompok pertanian
        $agricultur_group_id = $request->agricultur_group_id;
        $agricultur_group    = AgriculturalGroup::where('id', $agricultur_group_id)->first();
        $agricultur_group->update(['status_investor' => 1]);

        // simpan ke tb capital untuk permodalan, isi management_id dan agricultural_group_id terlebih dahulu
        $dataCapital['management_id'] = $management->id;
        $dataCapital['agricultural_group_id'] = $agricultur_group_id;
        Capital::create($dataCapital);

        // redirect ke page form permodalan capital
        return redirect()->route('member-capital')->with(['success' => 'Investor telah di tambahkan']);

    }

    public function pageCapital()
    {
        $survey_team = $this->getSurveyTeamId();
        $survey_team_id = $survey_team[0]['survey_team']['id'];
        $agricultur_group = AgriculturalGroup::with(['farmer.member','typeAgricultur','capital'])
                            ->where('status_survey','=',1)
                            ->where('status_investor','=',1)
                            ->where('status_capital','=',0)
                            ->where('survey_team_id', $survey_team_id)->get();

        return view('pages.members.survey-teams.capitals.index', compact('agricultur_group'));
    }

    public function createCapital($capital_id)
    {
        return view('pages.members.survey-teams.capitals.create', compact('capital_id'));
    }

    public function saveCapital(Request $request)
    {
        if ($request->nilai == 'true') {
            $data = [
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
    
            $capital = Capital::where('id', $request->capital_id)->first();        
            $capital->update($data);
        }else{
            $data = [
                'cost_of_seeds' => 0,
                'rental_cost' => 0,
                'material_processing_costs' => 0,
                'planting_costs' => 0,
                'maintenance_cost' => 0,
                'fertilizer_costs' => 0,
                'harvest_costs' => 0,
                'other_costs' => 0,
                'accounts_receivable' => 0
            ];
    
            $capital = Capital::where('id', $request->capital_id)->first();        
            $capital->update($data);
        }

        // update tb agricultural_group status capital = 1
        $agricultur_group = AgriculturalGroup::with(['farmer.member','typeAgricultur'])->where('id', $capital->agricultural_group_id)->first();
        $agricultur_group->update(['status_capital' => 1]);

        return redirect()->route('member-capital')->with(['success' => 'Permodala / biaya '.$agricultur_group->typeAgricultur->name_type.' atas nama '.$agricultur_group->farmer->member->name .' telah di tambahkan']);
    }
    
}
