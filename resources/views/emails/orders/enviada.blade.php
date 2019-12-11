@component('mail::message')
# Hola {{ $clientName }}

@component('mail::panel')
Su orden ha sido enviada dentro de unos minutos recibira sus articulos.
@endcomponent


@component('mail::button', ['url' => route('order')])
Ver Orden
@endcomponent

Gracias por preferirnos
@endcomponent
