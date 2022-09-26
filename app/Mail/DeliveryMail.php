<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeliveryMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $currentDate = date('Y-m-d');
        return $this->from('development@detroitaxle.com', 'DetroitAxle Automated Alerts')
            ->attach(storage_path("app/tmp/reportdelivery$currentDate.csv"))
            ->subject('Daily Report')->view('mail.delivery');
    }
}
