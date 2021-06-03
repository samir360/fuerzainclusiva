<?php

namespace App\Listeners;

use App\Events\ContactSendMail;
use App\Events\SendMail;
use Mail;

class ContactSendMailFired
{

    public function __construct()
    {

    }

    public function handle(ContactSendMail $event)
    {

        Mail::send('emails.email-default', ['body' => $event->templateEmail], function ($message) use ($event) {
            $message->to($event->emailUser, $event->firstName);
            $message->subject($event->subject);


            if ($event->attach) {
                $message->attachData($event->attach, 'doc.pdf', ['mime' => 'application/pdf']);
                return true;
            }

            if (!empty($event->attachedPath) && file_exists($event->attachedPath)) {
                $finfo = new \finfo(FILEINFO_MIME_TYPE);
                $message->attach($event->attachedPath, ['as' => $event->attachedName, 'mime' => $finfo->file($event->attachedPath)]);
            }

        });
    }

}
