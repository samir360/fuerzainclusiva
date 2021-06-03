<?php

namespace App\Events;

use Illuminate\Support\Facades\Event;
use Illuminate\Queue\SerializesModels;

class ResetPasswordSendMail extends Event
{
    use SerializesModels;
    public $firstName;
    public $emailUser;
    public $templateEmail;
    public $attach;
    public $valid_template;
    public $subject;

    public function __construct($firstName, $emailUser, $templateEmail, $subject, $attach='', $valid_template=false)
    {

        $this->firstName = $firstName;
        $this->emailUser = $emailUser;
        $this->templateEmail = $templateEmail;
        $this->attach = $attach;
        $this->valid_template = $valid_template;
        $this->subject = $subject;
    }

    public function broadcastOn()
    {
        return [];
    }
}
