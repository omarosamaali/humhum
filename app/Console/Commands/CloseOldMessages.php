<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Message; // تأكد من استيراد موديل الرسالة
use Carbon\Carbon; // تأكد من استيراد Carbon للتعامل مع الوقت
use Illuminate\Support\Facades\Log; // لغرض التسجيل والمراقبة

class CloseOldMessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'messages:close-old'; // اسم الكوماند الذي ستستخدمه لتشغيله

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Closes messages that have been replied to or opened for more than 48 hours.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('Running CloseOldMessages command.');

        $fortyEightHoursAgo = Carbon::now()->subHours(48);

        $messagesToClose = Message::whereIn('status', ['opened', 'replied'])
            ->where('updated_at', '<', $fortyEightHoursAgo)
            ->get();

        $count = 0;
        foreach ($messagesToClose as $message) {
            $message->status = 'closed';
            $message->save();
            $count++;
        }

        $this->info("Successfully closed {$count} messages.");
        Log::info("Finished CloseOldMessages command. Closed {$count} messages.");
    }
}
