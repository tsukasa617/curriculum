<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Mail;

class MailSend extends Mailable
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
    {}

    public function client($forms)
    {
        $data = [
            'first_client' => $forms['first_client'],
            'second_client' => '',
            'third_client' => '',
            'matter' => $forms['matter'],
            'status_after' => $forms['status_after'],
            'status_before' => $forms['status_before']
        ];

        Mail::send('emails.status_send', $data, function($message) use($forms){
            $message->to([$forms['first_mail']])
            // $message->to('szn0125@gmail.com')
            // ->from('info@re-grant.com', 'リグラント')
            ->from('epkotsoftware@gmail.com')
            ->subject('案件進捗のご報告');
            // $message->to('szn0125@gmail.com')
        });
    }

    public function matter_first($forms)
    {
        $data = [
            'first_client' => $forms['first_client'],
            'second_client' => '',
            'third_client' => '',
            'matter' => $forms['matter'],
            'status_after' => $forms['status_after'],
            'status_before' => $forms['status_before']
        ];

        Mail::send('emails.status_send', $data, function($message) use($forms){
            $message->to([$forms['first_mail']])
            ->from('epkotsoftware@gmail.com')
            ->subject('案件進捗のご報告');
        });
    }

    public function matter_second($forms)
    {
        $data = [
            'first_client' => '',
            'second_client' => $forms['second_client'],
            'third_client' => '',
            'matter' => $forms['matter'],
            'status_after' => $forms['status_after'],
            'status_before' => $forms['status_before']
        ];

        Mail::send('emails.status_send', $data, function($message) use($forms){
            $message->to([$forms['second_mail']])
            ->from('epkotsoftware@gmail.com')
            ->subject('案件進捗のご報告');
        });
    }

    public function matter_third($forms)
    {
        $data = [
            'first_client' => '',
            'second_client' => '',
            'third_client' => $forms['third_client'],
            'matter' => $forms['matter'],
            'status_after' => $forms['status_after'],
            'status_before' => $forms['status_before']
        ];

        Mail::send('emails.status_send', $data, function($message) use($forms){
            $message->to([$forms['third_mail']])
            ->from('epkotsoftware@gmail.com')
            ->subject('案件進捗のご報告');
        });
    }
}
