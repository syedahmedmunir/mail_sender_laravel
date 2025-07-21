<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class MailSenderHelper
{

    public static function send(array $data): bool
    {
        try {
            Mail::raw($data['body'], function ($message) use ($data) {
                $message->to($data['email'])
                        ->subject($data['subject']);
            });

            return true;
        } catch (\Exception $e) {
            Log::error('Email sending failed: ' . $e->getMessage());
            return false;
        }
    }
}
