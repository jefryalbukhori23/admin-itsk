<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class notification_mail extends Mailable
{
    use Queueable, SerializesModels;
    public $mail_data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_data)
    {
        $this->mail_data = $mail_data;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Notification Mail',
        );
    }

    public function build(){
        // dd($this->mail_data);
        if($this->mail_data['att'] == "N"){
            return $this->from('itsksh99@gmail.com', $this->mail_data['subject'])
                    ->view('mails.pengumuman_mail');
        }else{
            $file = public_path('mail_templates/att/'.$this->mail_data['att']);
            $file_name = $this->mail_data['att'];
            return $this->from('itsksh99@gmail.com', $this->mail_data['subject'])
            ->attach($file, [
                'as' => $file_name,
                ])
                ->view('mails.pengumuman_mail');
        }
        // return $this->from('itsksh99@gmail.com', 'Notifikasi')
        //         ->view('mails.pengumuman_mail');
    }
    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    // public function content()
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
