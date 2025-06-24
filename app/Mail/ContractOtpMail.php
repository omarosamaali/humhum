<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContractOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otpCode;

    /**
     * Create a new message instance.
     *
     * @param string $otpCode
     * @return void
     */
    public function __construct(string $otpCode)
    {
        $this->otpCode = $otpCode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('رمز التحقق لتوقيع الاتفاقية')
            ->view('emails.contract_otp'); // سيتم إنشاء هذا الملف في الخطوة التالية
    }
}
