@component('mail::message')
# Hola {{ $clientName }}

Tienes una nueva orden, para ver mas detalles de la misma pulsa el boton que estas mas abajo.

@component('mail::button', ['url' => route('order')])
Ver Orden
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
