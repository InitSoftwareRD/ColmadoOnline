@extends('front.layout.layout')

@section('content')
    
<!--Cart Single-->
 <div class="cart_single_wrapper clv_section woocommerce-cart">
        <div class="container">
            <div class="cart_table_section table-responsive">
                <div class="table_heading">
                    <h3>Carrito</h3>
                    <h4>4 artículos en tu carrito</h4>
                </div>
                <table class=" cart_table table-responsive woocommerce-cart-form__contents">
                    <tr>
                        <th>items</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>total</th>
                        <th>remover</th>
                    </tr>
                    <tr>
                        <td>
                            <div class="product_img">
                                <img src="https://via.placeholder.com/60x60" alt="image">
                                <h6>fresh meat</h6>
                            </div>
                        </td>
                        <td>
                            <div class="item_quantity">
                                <a href="javascript:;" class="quantity_minus">-</a>
                                <input type="text" value="2" class="quantity" disabled="">
                                <a href="javascript:;" class="quantity_plus">+</a>
                            </div>
                        </td>
                        <td>
                            <div class="pro_price">
                                <h5>$12</h5>
                            </div>
                        </td>
                        <td>
                            <div class="pro_price">
                                <h5>$24</h5>
                            </div>
                        </td>
                        <td>
                            <div class="pro_remove">
                                <span>
                                    <?xml version="1.0" encoding="iso-8859-1"?>
                                    <svg version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 47.971 47.971" style="enable-background:new 0 0 47.971 47.971;" xml:space="preserve" width="12px" height="12px">
                                    <g>
                                        <path d="M28.228,23.986L47.092,5.122c1.172-1.171,1.172-3.071,0-4.242c-1.172-1.172-3.07-1.172-4.242,0L23.986,19.744L5.121,0.88
                                            c-1.172-1.172-3.07-1.172-4.242,0c-1.172,1.171-1.172,3.071,0,4.242l18.865,18.864L0.879,42.85c-1.172,1.171-1.172,3.071,0,4.242
                                            C1.465,47.677,2.233,47.97,3,47.97s1.535-0.293,2.121-0.879l18.865-18.864L42.85,47.091c0.586,0.586,1.354,0.879,2.121,0.879
                                            s1.535-0.293,2.121-0.879c1.172-1.171,1.172-3.071,0-4.242L28.228,23.986z"/>
                                    </g>
                                    </svg>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="product_img">
                                <img src="https://via.placeholder.com/60x60" alt="image">
                                <h6>dairy milk</h6>
                            </div>
                        </td>
                        <td>
                            <div class="item_quantity">
                                <a href="javascript:;" class="quantity_minus">-</a>
                                <input type="text" value="2" class="quantity" disabled="">
                                <a href="javascript:;" class="quantity_plus">+</a>
                            </div>
                        </td>
                        <td>
                            <div class="pro_price">
                                <h5>$16</h5>
                            </div>
                        </td>
                        <td>
                            <div class="pro_price">
                                <h5>$32</h5>
                            </div>
                        </td>
                        <td>
                            <div class="pro_remove">
                                <span>
                                    <?xml version="1.0" encoding="iso-8859-1"?>
                                    <svg version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 47.971 47.971" style="enable-background:new 0 0 47.971 47.971;" xml:space="preserve" width="12px" height="12px">
                                    <g>
                                        <path d="M28.228,23.986L47.092,5.122c1.172-1.171,1.172-3.071,0-4.242c-1.172-1.172-3.07-1.172-4.242,0L23.986,19.744L5.121,0.88
                                            c-1.172-1.172-3.07-1.172-4.242,0c-1.172,1.171-1.172,3.071,0,4.242l18.865,18.864L0.879,42.85c-1.172,1.171-1.172,3.071,0,4.242
                                            C1.465,47.677,2.233,47.97,3,47.97s1.535-0.293,2.121-0.879l18.865-18.864L42.85,47.091c0.586,0.586,1.354,0.879,2.121,0.879
                                            s1.535-0.293,2.121-0.879c1.172-1.171,1.172-3.071,0-4.242L28.228,23.986z"/>
                                    </g>
                                    </svg>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="product_img">
                                <img src="https://via.placeholder.com/60x60" alt="image">
                                <h6>fresh meat</h6>
                            </div>
                        </td>
                        <td>
                            <div class="item_quantity">
                                <a href="javascript:;" class="quantity_minus">-</a>
                                <input type="text" value="2" class="quantity" disabled="">
                                <a href="javascript:;" class="quantity_plus">+</a>
                            </div>
                        </td>
                        <td>
                            <div class="pro_price">
                                <h5>$12</h5>
                            </div>
                        </td>
                        <td>
                            <div class="pro_price">
                                <h5>$24</h5>
                            </div>
                        </td>
                        <td>
                            <div class="pro_remove">
                                <span>
                                    <?xml version="1.0" encoding="iso-8859-1"?>
                                    <svg version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 47.971 47.971" style="enable-background:new 0 0 47.971 47.971;" xml:space="preserve" width="12px" height="12px">
                                    <g>
                                        <path d="M28.228,23.986L47.092,5.122c1.172-1.171,1.172-3.071,0-4.242c-1.172-1.172-3.07-1.172-4.242,0L23.986,19.744L5.121,0.88
                                            c-1.172-1.172-3.07-1.172-4.242,0c-1.172,1.171-1.172,3.071,0,4.242l18.865,18.864L0.879,42.85c-1.172,1.171-1.172,3.071,0,4.242
                                            C1.465,47.677,2.233,47.97,3,47.97s1.535-0.293,2.121-0.879l18.865-18.864L42.85,47.091c0.586,0.586,1.354,0.879,2.121,0.879
                                            s1.535-0.293,2.121-0.879c1.172-1.171,1.172-3.071,0-4.242L28.228,23.986z"/>
                                    </g>
                                    </svg>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="product_img">
                                <img src="https://via.placeholder.com/60x60" alt="image">
                                <h6>dairy milk</h6>
                            </div>
                        </td>
                        <td>
                            <div class="item_quantity">
                                <a href="javascript:;" class="quantity_minus">-</a>
                                <input type="text" value="2" class="quantity" disabled="">
                                <a href="javascript:;" class="quantity_plus">+</a>
                            </div>
                        </td>
                        <td>
                            <div class="pro_price">
                                <h5>$16</h5>
                            </div>
                        </td>
                        <td>
                            <div class="pro_price">
                                <h5>$32</h5>
                            </div>
                        </td>
                        <td>
                            <div class="pro_remove">
                                <span>
                                    <?xml version="1.0" encoding="iso-8859-1"?>
                                    <svg version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                            viewBox="0 0 47.971 47.971" style="enable-background:new 0 0 47.971 47.971;" xml:space="preserve" width="12px" height="12px">
                                    <g>
                                        <path d="M28.228,23.986L47.092,5.122c1.172-1.171,1.172-3.071,0-4.242c-1.172-1.172-3.07-1.172-4.242,0L23.986,19.744L5.121,0.88
                                            c-1.172-1.172-3.07-1.172-4.242,0c-1.172,1.171-1.172,3.071,0,4.242l18.865,18.864L0.879,42.85c-1.172,1.171-1.172,3.071,0,4.242
                                            C1.465,47.677,2.233,47.97,3,47.97s1.535-0.293,2.121-0.879l18.865-18.864L42.85,47.091c0.586,0.586,1.354,0.879,2.121,0.879
                                            s1.535-0.293,2.121-0.879c1.172-1.171,1.172-3.071,0-4.242L28.228,23.986z"/>
                                    </g>
                                    </svg>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="pro_price">
                                <h5>sub-total</h5>
                            </div>
                        </td>
                        <td></td>
                        <td></td>
                        <td>
                            <div class="pro_price">
                                <h5>$112</h5>
                            </div>
                        </td>
                        <td></td>
                    </tr>
                </table>
                <div class="checkout_btn_block">
                    <a href="checkout.html" class="clv_btn checkout-button">¡Ordenar!</a>
                </div>
            </div>
        </div>
    </div>

@endsection    