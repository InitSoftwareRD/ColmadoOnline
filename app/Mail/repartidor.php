<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class repartidor extends Mailable
{
    use Queueable, SerializesModels;

    
    private $nombre;

    public function __construct($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('cafeteria3a@gmail.com')
        ->markdown('emails.orders.repartidor')
        ->subject('Orden lista para entrega')
        ->with([
            'nombre' => $this->nombre
        ]);
    }
}
