 <!--Checkout-->
 @extends('front.layout.layout')

@section('content')    

 <div class="clv_checkout_wrapper clv_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <div class="checkout_inner">
                        <div class="checkout_heading">
                            <h3>Verificando tu información</h3>
                            <h5>Información de contacto</h5>
                        </div>
                        <div class="checkout_form">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form_block"><input type="text" class="form_field" placeholder="Cliente" readonly=""></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form_block"><input type="text" class="form_field" placeholder="Email" readonly=""></div>
                                </div>
                            </div>
                        </div>
                        <div class="checkout_heading">
                            <h5>Otros datos</h5>
                        </div>
                        <div class="checkout_form">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form_block"><input type="text" class="form_field" placeholder="Lugar de entrega" ></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form_block"><input type="text" class="form_field" placeholder="Pagaré con: RD$" ></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="checkout_submit">
                                    <button class="clv_btn">¡Ordenar!</button>
                                    <a href="cart_single.html"><span><i class="fa fa-angle-left" aria-hidden="true"></i></span> Ir al carrito</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="cart_summery_block">
                        <h3>Resumen de carrito</h3>
                        <h5>Tienes 2 artículos</h5>
                        <ul>
                            <li>
                                <div class="product_img"><img src="https://via.placeholder.com/60x60" alt="image"></div>
                                <div class="product_quantity">
                                    <h6>fresh meat</h6>
                                    <p>x02</p>
                                </div>
                                <div class="product_price">
                                    <h4>$12</h4>
                                </div>
                            </li>
                            <li>
                                <div class="product_img"><img src="https://via.placeholder.com/60x60" alt="image"></div>
                                <div class="product_quantity">
                                    <h6>dairy milk</h6>
                                    <p>x02</p>
                                </div>
                                <div class="product_price">
                                    <h4>$16</h4>
                                </div>
                            </li>
                            <li>
                                <div class="total_amount">
                                    <h4>total</h4>
                                </div>
                                <div class="product_price">
                                    <h4>$28</h4>
                                </div>
                            </li>
                        </ul>
                        <!-- <a href="javascript:;">Codigo?</a> -->
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    @endsection