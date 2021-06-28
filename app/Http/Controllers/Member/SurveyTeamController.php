<?php

namespace App\Http\Controllers\Member;

use App\AgriculturalGroup;
use App\Member;
use App\SurveyTeam;
use App\Mail\SubmissionMail;
use Illuminate\Http\Request;
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

    public function successAproveSubmission($code)
    {
        $member = Member::where('code', $code)->first();
        $member->update(['roles_survey_team' => 2]);

        // sampan ke tb survey_team
        SurveyTeam::create(['member_id' => $member->id]);

        return view('pages.members.success-aprove-submission',compact('member'));
    }

    public function createFarmer()
    {
        // cek apakah ada kelompok pertanian yang belum memiliki jenis pertanian 
        // berdasarkan survey_team_id berdasrkan member_login (penyurvei)
        $member_id      = $this->getMember();
        $survey_team    = SurveyTeam::select('id','member_id')->where('member_id', $member_id)->first();
        $survey_team_id = $survey_team->id;

        $agricultur_group = AgriculturalGroup::with('member')->where('type_of_agriculture_id','=',null)
                            ->where('survey_team_id', $survey_team_id)->first();
        if ($agricultur_group) {
            return view('pages.members.farmers.in-complate-data', compact('agricultur_group'));
        }
        return view('pages.members.survey-teams.farmers.create');
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
            $data['photo'] = $request->file('photo')->store('assets/member/photo','public');
            $data['photo_idcard'] = $request->file('photo_idcard')->store('assets/member/photo-idcard','public');

            $photo_family_card         = $request->photo_family_card != null ? $request->file('photo_family_card')->store('assets/member/photo_family_card','public') : null;
            $data['photo_family_card'] = $photo_family_card;
            
            $member =  Member::create($data);
            
            // simpan ke tb agiricultural_group / kelompok pertanian
            // dan set default status_management = 0 / belum ada pengelolanya
            AgriculturalGroup::create([
                'member_id' => $member->id,
                'status'     => 'SURVEI',
                'survey_team_id' => $survey_team->id
                ]);

        }
        return redirect()->route('member-agricultur-create')->with(['success' => 'Pendaftaran berhasil, silahkan cek email Anda untuk verifikasi Akun']);

    }

    public function createAgriculturGroup()
    {
        return view('pages.members.survey-teams.agriculturalgroups.create');
    }
    

}
