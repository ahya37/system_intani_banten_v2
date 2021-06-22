<?php

namespace App\Http\Controllers\Member;

use App\HarvestPlanning;
use App\AgriculturalGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AgriculturGroupController extends Controller
{
    public function store(Request $request)
    {
        
        if ($request->hasFile('proof_land_ownership')) {
            $photo_proof = $request->file('proof_land_ownership')->store('assets/member/photo/agriculturgrup','public');
            $photo_area  = '';
            if ($request->hasFile('photo_area')) {
                $photo_area = $request->file('photo_area')->store('assets/member/photo/agriculturgrup','public');
            }

            $data = $this->getAgriculturRequest($request, $photo_area, $photo_proof);
            
            $agriculture_group =  AgriculturalGroup::create($data);
            $agriculture_group_id = $agriculture_group->id;

            // menyimpan ke table perencanaan panen
            $datas = $this->getHarvestPlanningRequest($request, $agriculture_group_id);
            HarvestPlanning::create($datas);
        }else{

             if ($request->hasFile('photo_area')) {
                $photo_area = $request->file('photo_area')->store('assets/member/photo/agriculturgrup','public');
                $photo_proof = NULL;
            }

            $data = $this->getAgriculturRequest($request, $photo_area, $photo_proof);

            $agriculture_group =  AgriculturalGroup::create($data);
            $agriculture_group_id = $agriculture_group->id;

           // menyimpan ke table perencanaan panen
            $datas = $this->getHarvestPlanningRequest($request, $agriculture_group_id);
            HarvestPlanning::create($datas);
        }

        return redirect()->route('member-next-management')->with(['success' => 'Kelompok pertanian telah di tambahkan']);
    }

    public function getAgriculturRequest($request, $photo_area, $photo_proof)
    {
        $data = [
                'member_id' => auth()->guard('member')->user()->id,
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

    public function getHarvestPlanningRequest($request, $agriculture_group_id)
    {
        $datas = [
            'agricultural_group_id' => $agriculture_group_id,
                'step' => $request->step,
                'type_harvest' => $request->type_harvest,
                'date' => $request->date,
                'qty' => $request->qty,
                'unit' => $request->unit,
                'estimated_selling_price' => $request->estimated_selling_price,
                'total_income' => $request->qty * $request->estimated_selling_price
        ];

        return $datas;
    }

}
