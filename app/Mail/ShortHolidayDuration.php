<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ShortHolidayDuration extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $emailTo;

    /**
     * Create a new message instance.
     *
     * @param $url
     * @param $emailTo
     */
    public function __construct($url, $emailTo)
    {
        $this->url = $url;
        $this->emailTo = $emailTo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.short_holiday', ['url' => $this->url,
            'emailTo' => $this->emailTo]);
    }
}
