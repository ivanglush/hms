<?php

namespace App\Mail;

use App\Models\RequestHistory;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RequestStateChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $history;

    /**
     * Create a new message instance.
     *
     * @param RequestHistory $history
     */
    public function __construct(RequestHistory $history)
    {
        $this->history = $history;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.state_changed', ['history' => $this->history]);
    }
}
