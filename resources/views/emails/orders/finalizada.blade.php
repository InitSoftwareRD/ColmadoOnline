@component('mail::message')
# Hola {{ $clientName }}

@component('mail::panel')
Su orden ha sido finalizada gracias por preferirnos.
@endcomponent


@component('mail::button', ['url' => route('order')])
Ver Orden
@endcomponent

@endcomponent
