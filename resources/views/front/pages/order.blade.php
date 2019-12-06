@extends('front.layout.layout')

@section('content')

    <!--Cart Single-->
    <div class="cart_single_wrapper clv_section woocommerce-cart">
            <div class="container">
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
                                               <!-- \App\OrderStatus::find($order->last_status)->name -->
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        {{ $order->ping }}
                                    </td>
                                    <td>
                                        {{ $order->created_at->format('d/m/Y') }}
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
