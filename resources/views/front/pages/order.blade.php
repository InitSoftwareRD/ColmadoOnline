@extends('front.layout.layout')

@section('content')

    <!--Cart Single-->
    <div class="cart_single_wrapper clv_section woocommerce-cart">
            <div class="container">
                @if(Session::has('success'))
                    <div class="container">
                        <div class="alert alert-success" role="alert">
                            <em> {!! session('success') !!}</em>
                        </div>
                    </div>
                @endif
                <div class="cart_table_section table-responsive">
                    <div class="table_heading">
                        <h3>Todos mis pedidos</h3>
                    </div>
                    <table class=" cart_table table-responsive woocommerce-cart-form__contents">
                        <thead>
                            <th>Orden No.</th>
                            <th>Cant. de Artículos</th>
                            <th>Total</th>
                            <th>Estatus</th>
                            <th>Pin</th>
                            <th>Fecha realización</th>
                            <th>Acciones</th>
                        </thead>

                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td>
                                        {{ $order->id }}
                                    </td>
                                    <td>
                                        {{ $order->products->sum('pivot.quantity') }}
                                    </td>
                                    <td>
                                        <div>
                                            <h5>RD$ {{ number_format($order->total) }}</h5>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="badge badge-pill badge-secondary" style="padding: 10px;">
                                               {{ optional(\App\OrderStatus::find($order->last_status))->name ?: 'Sin estatus'  }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $order->ping }}
                                    </td>
                                    <td>
                                        {{ $order->created_at->format('d/m/Y') }}
                                    </td>
                                    <td>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal{{$order->id}}">
                                            Detalles
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="Modal{{$order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Articulos Ordenados</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th scope="col">Articulo</th>
                                                                <th scope="col">Precio</th>
                                                                <th scope="col">Cantidad</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($order->products as $product)
                                                                <tr>
                                                                    <td>{{ $product->name }}</td>
                                                                    <td>{{ $product->price }}</td>
                                                                    <td>{{ $product->pivot->quantity }}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


@endsection
