<?php

namespace App\Http\Controllers;

use App\Member;
use App\Mail\IntaniMail;
use App\Management;
use App\Manager;
use App\TypeOfAgricultur;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\ProfessionalCategory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function registerMember()
    {
        $professional_category   = ProfessionalCategory::select('id','name')->orderBy('name','ASC')->get();
        $type_agricultur         = TypeOfAgricultur::select('id','name_type')->get();
        return view('auth.register-member', compact('professional_category','type_agricultur'));
    }

    public function addTypeAgricultur(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        TypeOfAgricultur::create([
            'name_type' => $request->name
        ]);

        return redirect()->back()->with(['success' => 'Kelompok pertanian telah dibuat']);
    }

    public function processRegisterMember(Request $request)
    {
        if ($request->hasFile('photo')){
            $data = $request->all();
            $data['activate_token']     = Str::random(10);
            $data['password']           = Hash::make($request->password);
            $data['base_id']            = 2;
            $data['photo'] = $request->file('photo')->store('assets/member/photo','public');
            $data['photo_idcard'] = $request->file('photo_idcard')->store('assets/member/photo-idcard','public');
            
            $member    =  Member::create($data);
            Mail::to($request->email)->send(new IntaniMail($member));

        }
        return redirect(route('login'))->with(['success' => 'Pendaftaran berhasil, silahkan cek email Anda untuk verifikasi Akun']);

    }

    public function verifyMemberRegistration($token)
    {
        $member = Member::where('activate_token', $token)->first();
        if ($member) {
            
            $member->update([
                'activate_token' => null,
                'status' => 1
            ]);

            return redirect()->route('login')->with(['success' => 'Verifikasi berhasil, silahkan login']);
        }

        return redirect()->route('login')->with(['error' => 'Invalid Verifikasi Token']);
    }

    public function registerManagement()
    {
        return view('auth.register-management');
    }

    public function saveRegisterManagement(Request $request)
    {
        if ($request->hasFile('photo')){
            $data = $request->all();
            $data['activate_token']     = Str::random(10);
            $data['password']           = Hash::make($request->password);
            $data['base_id']            = 2;
            $data['photo'] = $request->file('photo')->store('assets/member/photo','public');
            $data['photo_idcard'] = $request->file('photo_idcard')->store('assets/member/photo-idcard','public');
            $data['photo_family_card'] = $request->file('photo_family_card')->store('assets/member/photo_family_card','public');
            $data['roles_manager'] = 1;
            
            $member    =  Member::create($data);
            Mail::to($request->email)->send(new IntaniMail($member));

            // simpan ke tb manager_sebagai mangement
            Manager::create(['member_id' => $member->id]);

        }
        return redirect(route('login'))->with(['success' => 'Pendaftaran berhasil, silahkan cek email Anda untuk verifikasi Akun']);
    }
}
