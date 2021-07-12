<?php

namespace App\Http\Controllers\Member;

use App\Farms;
use App\Member;
use App\Fisherman;
use App\Cultivators;
use App\Enterpreneurs;
use App\AgriculturalGroup;
use App\Capital;
use App\Farmer;
use App\Http\Controllers\Controller;
use App\Management;
use App\Manager;
use App\Providers\IntaniProvider;

class HomeController extends Controller
{
    public function getMember()
    {
        $member = Member::with('profession')->select('id', 'professional_category_id')
                    ->where('id', auth()->guard('member')->user()->id)
                    ->first();
        return $member;

    }
    public function index()
    {
        #jika member berprofesi sebagai petani dan belum mengisi informasi lengkap data pertaniannya
        #maka alihkan ke form lengkap kelompok pertanian
        #mengambil profesi berdasarkan loginnya
        $provider = new IntaniProvider();

        $member = $this->getMember();
        $farmer = Farmer::select('id')->where('member_id', $member->id)->first();

        $cultivator      = Cultivators::with('member')->where('member_id', $member->id)->first();
        $enterpreneur    = Enterpreneurs::with('member')->where('member_id', $member->id)->first();
        $farm            = Farms::with('member')->where('member_id', $member->id)->first();
        $fisherman       = Fisherman::with('member')->where('member_id', $member->id)->first();
        $agriculturalGroupModel = new AgriculturalGroup();
        $capital         = new Capital();

        #jika sebagai petani = 1
        if ($member->professional_category_id == 1) {
                $agriculturalGroup = $agriculturalGroupModel->with(['typeAgricultur','village','capital'])->where('farmer_id', $farmer->id)->first();

                $total_capital     = $capital->getTotalCapital($member->id);
                if ($agriculturalGroup == null) {
                    return redirect()->route('member-invalid-profesion');
                }
                return view('pages.members.dashboard', compact('agriculturalGroup','member','cultivator','enterpreneur','farm','fisherman','provider','total_capital'));
                
        }elseif ($member->professional_category_id == 2) {
            #jika sebagai nelayan = 2
            return 'saya nelayan';
        }elseif ($member->professional_category_id == 5) {
            #jika sebagai peternak = 5
            return 'saya peternak';
        }elseif ($member->professional_category_id == 6) {
            #jika sebagai pengusaha = 6
            return 'saya pengusaha';
        }elseif ($member->professional_category_id == 8) {
            #jika sebagai pembudidaya = 8
            return 'saya pembudidaya';
        }
        elseif ($member->professional_category_id == 4) {
            #jika sebagai akademisi = 4
            return 'saya akademisi';

        } elseif ($member->professional_category_id == 3) {
            #jika sebagai tokoh = 3
            return 'saya akademisi';
        }
        else{

            #jumlah investor
            $manager = auth()->guard('member')->user()->id;
            $managementModel = new Management();
            $investor        = $managementModel->getInvestorByManagement($manager);
            $total_investor  = count($investor);

            #jumlah petani
            $farmerModel = new Farmer();
            $farmer      = $farmerModel->getFarmerByManagement($manager);
            $total_farmer  = count($farmer);

            #jumlah kelompok pertanian
            $agricultureGroupModel = new AgriculturalGroup();
            $agriculture_group     = $agricultureGroupModel->getAgriculturGroupByManagement($manager);
            $total_agriculture_group = count($agriculture_group);

            #jumlah seluruh nominal permodalan yang di kelolanya
            $capitalModel = new Capital();
            $total_capital      = $capitalModel->getInvestorAndTotalCapitalByManagement($manager);
            
            $provider = new IntaniProvider();


            return view('pages.members.dashboard-management', compact('total_investor','total_farmer','total_agriculture_group','total_capital','provider'));
        }
    }

    public function invalidProfesion()
    {
        $member_id = $this->getMember();
        $member    = new Member();
        $profession= $member->getProfesion($member_id->id);

        return view('pages.members.invalid', compact('profession'));
    }

    public function cekFormValidationProfession()
    {
        $member = $this->getMember();
        $profession = $member->professional_category_id;

        switch ($profession) {
            case 1:
                #jika petani
                return view('pages.members.agriculturalgroup');
                break;
            case 2:
                # jika nalayan
                return 'neleyan';
                break;
            case 5:
                # jika nalayan
                return 'peternak';
                break;
            case 6:
                # jika nalayan
                return 'pengusaha';
                break;
            case 8:
                # jika nalayan
                return 'pembudidaya';
                break;
            default:
                # code...
                return view('pages.members.dashboard');
                break;
        }
    }
}
