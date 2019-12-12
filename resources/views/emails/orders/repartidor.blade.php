@component('mail::message')
# {{ $nombre }}

@component('mail::panel')
Nueva orden en cola asignada a: {{ $nombre }} lista para entrega.
@endcomponent


@endcomponent
