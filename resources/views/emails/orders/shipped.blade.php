@component('mail::message')
# Hola {{ $clientName }}

@component('mail::panel')
Tiene una nueva orden, para ver mas detalles de la misma pulsa el boton que estas mas abajo.
@endcomponent


@component('mail::button', ['url' => route('order')])
Ver Orden
@endcomponent

Gracias por preferirnos
@endcomponent
