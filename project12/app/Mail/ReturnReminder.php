<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReturnReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $item;

    public function __construct($item)
    {
        $this->item = $item;
    }

    public function build()
    {
        return $this->view('emails.return_reminder')
                    ->with([
                        'itemName' => $this->item->name,
                        'returnDate' => $this->item->return_date,
                    ]);
    }
}
