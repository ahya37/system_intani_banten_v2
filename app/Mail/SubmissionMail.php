<?php

namespace App\Mail;

use App\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubmissionMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $member;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Member $member)
    {
        $this->member = $member;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('suport.intani.banten@gmail.com')
                    ->subject('Pengajuan Melakukan Survei Intani Banten ' . $this->member->name)
                    ->view('emails.submission')
                    ->with([
                        'member' => $this->member
                    ]);
    }
}
