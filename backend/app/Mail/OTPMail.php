<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OTPMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $nama_lengkap;

    public function __construct($otp, $nama_lengkap)
    {
        $this->otp = $otp;
        $this->nama_lengkap = $nama_lengkap;
    }

    public function build()
    {
        return $this->subject('Kode OTP Verifikasi Anda')
            ->view('emails.otp')
            ->with([
                'otp' => $this->otp,
                'nama_lengkap' => $this->nama_lengkap,
            ]);
    }
}
