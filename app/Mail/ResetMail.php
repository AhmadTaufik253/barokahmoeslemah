<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetMail extends Mailable
{
    use Queueable, SerializesModels;
    public $token;
    public function __construct($token)
    {
        $this->token = $token;
    }
    public function build()
    {
        return $this->subject('Reset Password')->from('laravel.mail20@gmail.com')->view('page.email.reset');
    }
}
