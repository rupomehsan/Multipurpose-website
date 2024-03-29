<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderReply extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $subject;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$subject)
    {
        $this->data = $data;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $admin_mail_check = is_null(tenant()) ? get_static_option_central('site_global_email') : get_static_option('site_global_email');
        return $this->from($admin_mail_check, get_static_option('site_'.get_default_language().'_title'))
            ->subject($this->subject)
            ->view('emails.order-reply');
    }
}
