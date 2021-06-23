<?php

namespace App\Http\Controllers\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SubmissionMail;
use App\Member;
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

        return view('pages.members.success-aprove-submission',compact('member'));
    }

}
