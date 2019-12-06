 <!--Checkout-->
 @extends('front.layout.layout')

@section('content')

 <div class="clv_checkout_wrapper clv_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <form method="POST" action="{{ route('order.store') }}">
                        @csrf
                        <div class="checkout_inner">
                            <div class="checkout_heading">
                                <h3>Verificando tu información</h3>
                                <h5>Información de contacto</h5>
                            </div>
                            <div class="checkout_form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form_block"><input type="text" class="form_field" placeholder="Cliente" readonly value="{{ auth()->user()->name }}"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form_block"><input type="text" class="form_field" placeholder="Email" readonly value="{{ auth()->user()->email }}"></div>
                                    </div>
                                    <div class="col-md-12">
                                        @if($hasLocation)
                                            <label><input type="checkbox" name="location_default" value="1" checked> Usar mi ubicacion por defecto</label>
                                        @else
                                            <span>Aparentemente no hay una ubicación predeterminada, seleccione la ubicación y márquela como predeterminada</span>
                                            <br>
                                            <br>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            <div class="checkout_heading">
                                <h5>Punto de entrega</h5>
                            </div>
                            <div class="checkout_form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form_block">
                                            <input type="hidden" class="form_field" id="lat" name="lat" value="19.224167">
                                            <input type="hidden" class="form_field" id="lng" name="lng" value="-70.528333">
                                            <div style="height: 300px; width: 100%;" class="mt-4" id="map"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label><input type="checkbox" name="location_store" value="1"> Marcar esta ubicacion predeterminada</label>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form_block">
                                            <input type="number" name="paid_with" class="form_field" placeholder="Pagaré con: RD$" min="{{$total}}" max="999999">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout_submit">
                                        <button type="submit" class="clv_btn">¡Ordenar!</button>
                                        <a href="{{ route('cart') }}"><span><i class="fa fa-angle-left" aria-hidden="true"></i></span> Ir al carrito</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="cart_summery_block">
                        <h3>Resumen de carrito</h3>
                        <h5>Tienes {{ $carts->count() }} artículos</h5>
                        <ul>
                            @foreach($carts as $item)
                                <li>
                                    <div class="product_img">
                                        <img width="75" height="75" src="{{ url(\App\Products::find($item['id'])->images[0]['ruta']) ?: 'https://via.placeholder.com/60x60' }}" alt="image">
                                    </div>
                                    <div class="product_quantity">
                                        <h6 title="{{$item['name']}}" class="text-black-50">{{ Str::limit($item['name'], 10, '...') }}</h6>
                                        <p>x{{ $item['quantity'] }}</p>
                                    </div>
                                    <div class="product_price">
                                        <h4>$RD {{ number_format($item['price']) }}</h4>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <h5>Total: RD$ {{ number_format($total) }}</h5>
                    </div>

                </div>
            </div>
        </div>
    </div>

    @endsection

 @push('js')
 <script>
     function initMap() {
         var map = new google.maps.Map(document.getElementById('map'), {
             zoom: 15,
             center: {lat: 19.224167, lng: -70.528333 }
         });

         var marker = new google.maps.Marker({
             position: {lat: 19.224167, lng: -70.528333 },
             map: map,
             draggable: true
         });

         google.maps.event.addListener(marker, 'position_changed', function() {
             var lat = marker.getPosition().lat();
             var lng = marker.getPosition().lng();
             $('#lat').val(lat);
             $('#lng').val(lng);
         });

         /*marker.addEventListener('click', function () {
             var lat = marker.getPosition().lat();
             var lng = marker.getPosition().lng();

             $('#lat').val(lat);
             $('#lng').val(lng);
         })*/
     }
 </script>
 <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAv2H-7W5S5ZWN196l5zS3Lk8s99-N2Dek&callback=initMap"></script>
 @endpush
