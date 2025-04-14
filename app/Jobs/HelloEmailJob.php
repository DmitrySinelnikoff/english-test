<?php

namespace App\Jobs;

use App\Mail\HelloEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class HelloEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $details;

    public function __construct(array $details)
    {
        $this->details = $details;
    }

    public function handle()
    {
        Mail::to($this->details['email'])->send(new HelloEmail($this->details['name']));
    }
}
