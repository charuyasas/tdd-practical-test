<?php

namespace App\Jobs;

use App\Mail\SendPostMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPostEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $subject;
    public $content;

    public function __construct($mail, $sub, $con)
    {
        $this->subject = $sub;
        $this->content = $con;
        $this->email = $mail;
    }

    public function handle(): void
    {
        Mail::to($this->email)->send(new SendPostMail($this->subject, $this->content));
    }
}
