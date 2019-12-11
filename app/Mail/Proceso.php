<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Proceso extends Mailable
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
    {
        return $this->from('cafeteria3a@gmail.com')
            ->markdown('emails.orders.proceso')
            ->cc('cafeteria3a@gmail.com')
            ->subject('Notificación Cafeteria AAA')
            ->with([
                'clientName' => 'Hola'
            ]);
    }
}
