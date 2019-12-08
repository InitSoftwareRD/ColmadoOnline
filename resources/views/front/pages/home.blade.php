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
                        <div class="ads_section"><img src="{{ asset('img/cafeteria2.jpg') }}" alt="image" width="1000" height="250" ></div>
                    </div>
                    <div class="product_list_section">
                        <div class="product_items_section">
                            <ul>
                                @foreach($productos as $producto)
                                    <li>
                                        <cart-add :product='@json($producto)'
                                                  is-auth="{{ auth()->check() }}"
                                                  has-product="{{ auth()->check() && Cart::session(auth()->id())->get($producto['id']) ? 1 : 0 }}"/>
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


