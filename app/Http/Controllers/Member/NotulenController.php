<?php

namespace App\Http\Controllers\Member;

use App\Member;
use App\Notulen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;

class NotulenController extends Controller
{
    public function index()
    {
        $notulens = Notulen::with(['member'])->orderBy('id','Desc')->get();
        return view('pages.members.notulens.index', compact('notulens'));
    }

    public function create()
    {
        $member_id = $this->getMember();
        $member = Member::select('signature')->where('id',$member_id)->first();
        // jika blm ada ttd alihkan untuk upload terlebih dahulu
        if ($member->signature == null) {
            return view('pages.members.notulens.upload-signature');
        }

        return view('pages.members.notulens.create');
    }

    public function saveSignature(Request $request)
    {
         $member_id = $this->getMember();
         $signatue  = $request->file('file')->store('assets/member/photo/signature','public');
         $member    = Member::where('id', $member_id)->first();
         $save      = $member->update(['signature' => $signatue]);

         if ($save) {
             return redirect()->route('member-notulen-create');
         }
         return redirect()->back();

    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['title'] = ucwords($request->title);
        $data['member_id'] = $this->getMember();
        Notulen::create($data);

        return redirect()->route('member-notulen')->with(['success' => 'Notulensi telah dibuat']);

    }

    public function getMember()
    {
        $member = auth()->guard('member')->user()->id;
        return $member;
    }

    public function show($id)
    {
        $notulens = Notulen::with(['member'])->orderBy('id','Desc')->first();
        $global_fungsi = app('IntaniProvider');

        $mounth = date('n', strtotime($notulens->created_at));
        $romawi = $global_fungsi->getRomawi($mounth);
        $year   = date('Y', strtotime($notulens->created_at));
        
        return view('pages.members.notulens.show', compact('notulens','romawi','year'));

    } 
    
    public function notulenPdf($id)
    {
        $notulens = Notulen::with(['member'])->orderBy('id','Desc')->first();
        $global_fungsi = app('IntaniProvider');

        $no     = $notulens->id;
        $mounth = date('n', strtotime($notulens->created_at));
        $romawi = $global_fungsi->getRomawi($mounth);
        $year   = date('Y', strtotime($notulens->created_at));

        $title  = 'notulensi-'.$id.'-'.$romawi.'-'.$year;
        $pdf = PDF::loadView('pages.members.notulens.pdf', compact('notulens','romawi','year','title'));
        return $pdf->stream($title.'.pdf');
    }
}
