<?php

namespace App\Http\Controllers\Member;

use App\HarvestPlanning;
use App\AgriculturalGroup;
use App\Farmer;
use Illuminate\Http\Request;
use App\Providers\IntaniProvider;
use App\Http\Controllers\Controller;
use App\TypeOfAgricultur;

class AgriculturGroupController extends Controller
{
    public function getMember()
    {
        $member = auth()->guard('member')->user()->id;
        return $member;
    }

    public function store(Request $request)
    {
        
        if ($request->hasFile('proof_land_ownership')) {
            $photo_proof = $request->file('proof_land_ownership')->store('assets/member/photo/agriculturgrup','public');
            $photo_area  = '';
            if ($request->hasFile('photo_area')) {
                $photo_area = $request->file('photo_area')->store('assets/member/photo/agriculturgrup','public');
            }

            // simpan ke tb farmer / petani
            $dataFarmer['member_id'] = auth()->guard('member')->user()->id;
            $savefarmer =  Farmer::create($dataFarmer);
            $farmer     = $savefarmer->id;

            $data = $this->getAgriculturRequest($request, $photo_area, $photo_proof, $farmer);
            
            $agriculture_group =  AgriculturalGroup::create($data);
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

             // simpan ke tb farmer / petani
            $dataFarmer['member_id'] = auth()->guard('member')->user()->id;
            $savefarmer =  Farmer::create($dataFarmer);
            $farmer     = $savefarmer->id;

            $data = $this->getAgriculturRequest($request, $photo_area, $photo_proof, $farmer);

            $agriculture_group =  AgriculturalGroup::create($data);
            $agriculture_group_id = $agriculture_group->id;

           // menyimpan ke table perencanaan panen
            $intaniProvider = new IntaniProvider();
            $datas = $intaniProvider->getHarvestPlanningRequest($request, $agriculture_group_id);
            HarvestPlanning::create($datas);
        }

        return redirect()->route('member-next-management')->with(['success' => 'Kelompok pertanian telah di tambahkan']);
    }

    public function getAgriculturRequest($request, $photo_area, $photo_proof, $farmer)
    {
        $data = [
                'farmer_id' => $farmer,
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
                'status' => 'PERSONAL',
        ];
        return $data;
    }

    public function index()
    {
        $member = $this->getMember();
        $agricultureGroupModel = new AgriculturalGroup();
        $agriculture_group     = $agricultureGroupModel->getAgriculturGroupByManagement($member);
        $provider = new IntaniProvider();

        // mengambil total total nominal dan biaya
        $getTotal = $agricultureGroupModel->getTotalAgriculturGroupByManagement($member);

        // persentasi total
        $persentage = [];
        foreach ($agriculture_group as $val) {
            $persentage[] = ($val->total_biaya/$getTotal->total_all_biaya) * 100;
        }

        $total_persentage = array_sum($persentage);

        return view('pages.members.managements.agriculturalgroups.index', compact('agriculture_group','provider','getTotal','total_persentage'));
    }

    public function detailFarmerByAgriculturGroupId($type_of_agriculture_id)
    {
        $provider = new IntaniProvider();
        $no_type = 1;
        $no_farmer = 1;

        $agricultureGroupModel = new AgriculturalGroup();
        $type_of_agriculture   = TypeOfAgricultur::select('name_type')->where('id', $type_of_agriculture_id)->first();
        $name_type             = $type_of_agriculture->name_type;
        
        $detailFarmer          = $agricultureGroupModel->detailFarmerByAgriculturGroupId($type_of_agriculture_id);

        return view('pages.members.managements.agriculturalgroups.detail-farmer', compact('name_type','detailFarmer','agricultureGroupModel','provider','no_type','no_farmer'));
    }

}
