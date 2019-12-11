@component('mail::message')
# Hola {{ $clientName }}

@component('mail::panel')
Su orden está en proceso.
@endcomponent


@component('mail::button', ['url' => route('order')])
Ver Orden
@endcomponent

Gracias por preferirnos
@endcomponent
