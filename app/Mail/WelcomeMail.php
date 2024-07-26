<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WelcomeMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $token;
    public function __construct($user,$token)
    {
        $this->user = $user;
        $this->token = $token;
    }
    public function build()
    {
        return $this->subject('Thanks for join us')->from('laravel.mail20@gmail.com')->view('page.email.welcome');
    }
}
