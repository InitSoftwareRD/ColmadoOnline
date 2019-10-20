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
                            <tr>
                                <td>
                                    #O-000122
                                </td>
                                <td>
                                    5
                                </td>
                                <td>
                                    <div>
                                        <h5>$1,200.00</h5>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <span class="badge badge-pill badge-secondary" style="padding: 10px;">Ordenado</span>
                                    </div>
                                </td>
                                <td>
                                    00383u1u
                                </td>
                                <td>
                                    15/10/2019
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    #O-000123
                                </td>
                                <td>
                                    5
                                </td>
                                <td>
                                    <div>
                                        <h5>$1,200.00</h5>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <span class="badge badge-pill badge-warning" style="padding: 10px;">En proceso</span>
                                    </div>
                                </td>
                                <td>
                                    00383u1u
                                </td>
                                <td>
                                    15/10/2019
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    #O-000123
                                </td>
                                <td>
                                    5
                                </td>
                                <td>
                                    <div>
                                        <h5>$1,200.00</h5>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <span class="badge badge-pill badge-info" style="padding: 10px;">Terminado</span>
                                    </div>
                                </td>
                                <td>
                                    00383u1u
                                </td>
                                <td>
                                    15/10/2019
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    #O-000122
                                </td>
                                <td>
                                    5
                                </td>
                                <td>
                                    <div>
                                        <h5>$1,200.00</h5>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <span class="badge badge-pill badge-success" style="padding: 10px;">Entregado</span>
                                    </div>
                                </td>
                                <td>
                                    00383u1u
                                </td>
                                <td>
                                    15/10/2019
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    
@endsection