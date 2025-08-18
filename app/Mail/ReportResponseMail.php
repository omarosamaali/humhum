<?php

namespace App\Mail;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportResponseMail extends Mailable
{
    use Queueable, SerializesModels;

    public $report;
    public $adminMessage; // Renamed from $message to $adminMessage

    public function __construct(Report $report, string $adminMessage)
    {
        $this->report = $report;
        $this->adminMessage = $adminMessage;
    }

    public function build()
    {
        return $this->subject('رد على بلاغك')
            ->view('emails.report_response')
            ->with([
                'report' => $this->report,
                'adminMessage' => $this->adminMessage,
            ]);
    }
}
