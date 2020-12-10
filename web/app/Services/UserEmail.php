<?php

namespace App\Services;

use App\Mail\ContactRequest;
use App\Mail\ReviewSend;
use Illuminate\Support\Facades\Mail;

/**
 * UserFile specific functionality
 */
class UserEmail
{
    /**
     * Send mail to user
     *
     * @param array $data
     * 
     * @return void
     */
    public function sendContactFormToAdmin(array $data): void
    {
        // send to company
        Mail::to(\config('mail.to_admin.address'))
            ->send(new ContactRequest($data));
    }

    /**
     * Send mail to user
     *
     * @param array $data
     * 
     * @return void
     */
    public function sendReviewToAdmin(array $data): void
    {
        // send to company
        Mail::to(\config('mail.to_admin.address'))
            ->send(new ReviewSend($data));
    }
}
