<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecycleMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->subject($this->data['title'])
                    ->view('mail.recycle') // Assuming the view is in `resources/views/emails/recycle.blade.php`
                    ->with('data', $this->data);
    }
}
