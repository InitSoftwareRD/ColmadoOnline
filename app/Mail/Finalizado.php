<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class Finalizado extends Mailable
{
    use Queueable, SerializesModels;

  
    private $user;
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }



    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('cafeteria3a@gmail.com')
            ->markdown('emails.orders.finalizada')
            ->subject('Notificación Cafeteria AAA')
            ->with([
                'clientName' => $this->user->name. ' ' . $this->user->last_name
            ]);
    }
}
