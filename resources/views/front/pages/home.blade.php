@extends('front.layout.layout')


@section('content')

<div class="products_wrapper clv_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    @include('front.shared._filters')
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="product_section">
                        <div class="ads_section"><img src="https://via.placeholder.com/870x296" alt="image"></div>
                    </div>
                    <div class="product_list_section">
                        <div class="product_list_filter">
                            <ul>
                                <li>
                                    <p>Mostrando <span>1-6 of 9</span> Resultados</p>
                                </li>
                                <li style="float: right;">
                                    <ul class="list_view_toggle">
                                        <li><span>Vista</span></li>
                                        <li>
                                            <a href="javascript:;" class="active grid_view">
                                                <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                width="12px" height="12px">
                                                <path fill-rule="evenodd"  fill="rgb(112, 112, 112)"
                                                d="M6.861,12.000 L6.861,6.861 L12.000,6.861 L12.000,12.000 L6.861,12.000 ZM6.861,-0.000 L12.000,-0.000 L12.000,5.139 L6.861,5.139 L6.861,-0.000 ZM-0.000,6.861 L5.139,6.861 L5.139,12.000 L-0.000,12.000 L-0.000,6.861 ZM-0.000,-0.000 L5.139,-0.000 L5.139,5.139 L-0.000,5.139 L-0.000,-0.000 Z"/>
                                                </svg>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" class="list_view">
                                                <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                width="12px" height="10px">
                                                <path fill-rule="evenodd"  fill="rgb(112, 112, 112)"
                                                d="M3.847,10.000 L3.847,7.783 L12.000,7.783 L12.000,10.000 L3.847,10.000 ZM3.847,3.892 L12.000,3.892 L12.000,6.108 L3.847,6.108 L3.847,3.892 ZM3.847,-0.000 L12.000,-0.000 L12.000,2.216 L3.847,2.216 L3.847,-0.000 ZM-0.000,7.783 L2.297,7.783 L2.297,10.000 L-0.000,10.000 L-0.000,7.783 ZM-0.000,3.892 L2.297,3.892 L2.297,6.108 L-0.000,6.108 L-0.000,3.892 ZM-0.000,-0.000 L2.297,-0.000 L2.297,2.216 L-0.000,2.216 L-0.000,-0.000 Z"/>
                                                </svg>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="product_items_section">
                            <ul>
                                @foreach($productos as $producto)
                                    <li>
                                        <div class="product_item_block">
                                            <div class="org_product_block">
                                                {{--<span class="product_label">30% off</span>--}}
                                                <div class="org_product_image"><img src="{{ $producto->imagen_portada }}"></div>
                                                <h4>{{ $producto->name }}</h4>
                                                <h3><span><i class="fa fa-usd" aria-hidden="true"></i></span>{{ $producto->price }}</h3>
                                                <a href="javascript:;">Agregar a carrito</a>
                                            </div>
                                            <div class="content_block">
                                                <div class="product_price_box">
                                                    <h3>{{ $producto->name }}</h3>
                                                    <h5><span><i class="fa fa-usd" aria-hidden="true"></i></span>{{ $producto->price }}</h5>
                                                </div>

                                                <a href="product_single.html" style="color: #fec007;"><strong>Ver producto</strong></a>
                                                <ul class="product_code">
                                                    <li>
                                                        <p>Disponibilidad: <span>en stock</span></p>
                                                    </li>
                                                </ul>
                                                <p>{{ $producto->description }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        {{ $productos->links() }}
                       {{-- <div class="blog_pagination_section">
                            <ul>
                                <li class="blog_page_arrow">
                                    <a href="javascript:;">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="10px" height="15px">
                                        <path fill-rule="evenodd" fill="rgb(112, 112, 112)" d="M0.324,8.222 L7.117,14.685 C7.549,15.097 8.249,15.097 8.681,14.685 C9.113,14.273 9.113,13.608 8.681,13.197 L2.670,7.478 L8.681,1.760 C9.113,1.348 9.113,0.682 8.681,0.270 C8.249,-0.139 7.548,-0.139 7.116,0.270 L0.323,6.735 C0.107,6.940 -0.000,7.209 -0.000,7.478 C-0.000,7.747 0.108,8.017 0.324,8.222 Z"></path>
                                        </svg>
                                        <span>prev</span>
                                    </a>
                                </li>
                                <li><a href="javascript:;">01</a></li>
                                <li><a href="javascript:;">02</a></li>
                                <li><a href="javascript:;">....</a></li>
                                <li><a href="javascript:;">12</a></li>
                                <li><a href="javascript:;">13</a></li>
                                <li class="blog_page_arrow">
                                    <a href="javascript:;">
                                        <span>next</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19px" height="25px">
                                        <path fill-rule="evenodd" fill="rgb(112, 112, 112)" d="M13.676,13.222 L6.883,19.685 C6.451,20.097 5.751,20.097 5.319,19.685 C4.887,19.273 4.887,18.608 5.319,18.197 L11.329,12.478 L5.319,6.760 C4.887,6.348 4.887,5.682 5.319,5.270 C5.751,4.861 6.451,4.861 6.884,5.270 L13.676,11.735 C13.892,11.940 14.000,12.209 14.000,12.478 C14.000,12.747 13.892,13.017 13.676,13.222 Z"></path>
                                        </svg>
                                    </a>
                                </li>
                            </ul>
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


