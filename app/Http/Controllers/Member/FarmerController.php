<?php

namespace App\Http\Controllers\Member;

use App\Farmer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Member;

class FarmerController extends Controller
{
    public function getMember()
    {
        $member = auth()->guard('member')->user()->id;
        return $member;
    }

    public function index()
    {
        $member   = $this->getMember();
        $farmerModel = new Farmer();
        $farmer      = $farmerModel->getFarmerByManagement($member);
        $no = 1;
        return view('pages.members.managements.farmers.index', compact('farmer','no'));
    }

    public function edit($member_id)
    {
        $member = Member::where('id', $member_id)->first();

        return view('pages.members.managements.farmers.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {

        $member = Member::where('id', $id)->first();

            $data['nik']          = $request->nik;
            $data['name']         = $request->name == null ? $member->name : $request->name;
            $data['place_of_berth']       = $request->place_of_berth == null ? $member->place_of_berth : $request->place_of_berth;
            $data['date_of_berth'] = $request->date_of_berth == null ? $member->date_of_berth : $request->date_of_berth;
            $data['gender'] = $request->gender == null ? $member->gender : $request->gender;
            $data['village_id'] = $request->village_id == null ? $member->village_id : $request->village_id;
            $data['address'] = $request->address == null ? $member->address : $request->address;
            $data['phone_number'] = $request->phone_number == null ? $member->phone_number : $request->phone_number;
            $data['wa_number'] = $request->wa_number == null ? $member->wa_number : $request->wa_number;
            $data['sosmed_facebook'] = $request->sosmed_facebook == null ? $member->sosmed_facebook : $request->sosmed_facebook;
            $data['sosmed_instagram'] = $request->sosmed_instagram == null ? $member->sosmed_instagram : $request->sosmed_instagram;
            $data['sosmed_youtube'] = $request->sosmed_youtube == null ? $member->sosmed_youtube : $request->sosmed_youtube;

            $photo = $request->photo == null ? $member->photo : $request->file('photo')->store('assets/member/photo','public');
            $photo_idcard = $request->photo_idcard == null ? $member->photo_idcard : $request->file('photo_idcard')->store('assets/member/photo-idcard','public');
            $photo_family_card         = $request->photo_family_card == null ? $member->photo_family_card : $request->file('photo_family_card')->store('assets/member/photo_family_card','public');
            
            $data['photo']        = $photo;
            $data['photo_idcard'] = $photo_idcard;
            $data['photo_family_card'] = $photo_family_card;

            $member->update($data);

            return redirect()->route('member-management-farmer-index')->with(['success' => 'Petani telah diubah']);
    }

    public function detail($id)
    {
        $member = Member::where('id', $id)->first();
        return view('pages.members.managements.farmers.detail', compact('member'));
    }

    public function farmerByInvestor()
    {
        $investor = $this->getMember();

        $farmerModel = new Farmer();
        $farmer      = $farmerModel->getFarmerByAccountInvestor($investor);
        $no          = 1;
        return view('pages.members.investors.farmers.index', compact('farmer','no'));
    }
}
