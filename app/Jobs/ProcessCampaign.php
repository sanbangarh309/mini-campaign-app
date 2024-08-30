<?php

namespace App\Jobs;

use App\Models\ { User, Campaign };
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ProcessCampaign implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $campaign;
    protected $user;
    protected $chunkSize = 100; // Number of rows to process in each chunk

    public function __construct(Campaign $campaign, User $user)
    {
        $this->campaign = $campaign;
        $this->user = $user;
    }

    public function handle()
    {
        $file = Storage::get($this->campaign->csv_file);
        $lines = explode(PHP_EOL, $file);
        $header = str_getcsv(array_shift($lines));
        
        $nameIndex = array_search('name', $header);
        $emailIndex = array_search('email', $header);

        $chunks = array_chunk($lines, $this->chunkSize);

        foreach ($chunks as $chunk) {
            foreach ($chunk as $line) {
                $data = str_getcsv($line);
                if (isset($data[$nameIndex]) && isset($data[$emailIndex])) {
                    $emailData = ['name' => $data[$nameIndex], 'email' => $data[$emailIndex]];

                    Mail::send('emails.campaign', ['name' => $emailData['name']], function($message) use ($emailData) {
                        $message->to($emailData['email'])->subject('Your Campaign Email');
                    });
                }
            }
            $this->campaign->increment('processed_count', count($chunk));
            sleep(1); // This will pause processing for 1 second between chunks
        }

        $this->campaign->update(['status' => 'completed']);
        // Notify user about completion
        Mail::send('emails.notify', ['name' => $this->user->name], function($message) use ($emailData) {
            $message->to($emailData['email'])->subject('Campaign Email status');
        });
    }
}
