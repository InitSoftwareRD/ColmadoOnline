@extends('front.layout.layout')

@section('content')
  
  <!--Contact Block-->
  <div class="contact_blocks_wrapper clv_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="contact_block">
                        <span></span>
                        <div class="contact_icon"><img src="{{ asset('front_template/images/contact_icon1.png') }}" alt="image" /></div>
                        <h4>Contacto</h4>
                        <p>809-573-0000</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="contact_block">
                        <span></span>
                        <div class="contact_icon"><img src="{{ asset('front_template/images/contact_icon2.png') }}" alt="image" /></div>
                        <h4>email</h4>
                        <p>cafeteria3a@gmail.com</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="contact_block">
                        <span></span>
                        <div class="contact_icon"><img src="{{ asset('front_template/images/contact_icon3.png') }}" alt="image" /></div>
                        <h4>Dirección</h4>
                        <p>La Vega RD</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Contact Form-->
    <div class="contact_form_wrapper clv_section">
        <div class="container">
            <div class="row" style="justify-content: center;">
                <div class="col-lg-4">
                    <div class="working_time_section">
                        <div class="timetable_block">
                            <h5>Horario de Trabajo</h5>
                            <ul>
                                <li>
                                    <p>Lunes</p>
                                    <p>9:30 am - 6:00 pm</p>
                                </li>
                                <li>
                                    <p>Martes</p>
                                    <p>9:00 am - 6:00 pm</p>
                                </li>
                                <li>
                                    <p>Miércoles</p>
                                    <p>9:45 am - 6:00 pm</p>
                                </li>
                                <li>
                                    <p>Jueves</p>
                                    <p>10:30 am - 6:00 pm</p>
                                </li>
                                <li>
                                    <p>Viernes</p>
                                    <p>9:30 am - 6:00 pm</p>
                                </li>
                                <li>
                                    <p>Sábado</p>
                                    <p>9:30 am - 6:00 pm</p>
                                </li>
                                <li>
                                    <p>Domingo</p>
                                    <p>Cerrado</p>
                                </li>
                            </ul>
                        </div>
                        <div class="tollfree_block">
                            <h5>Puedes llamarnos al</h5>
                            <h3>809-000-0000</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Contact Map-->
    <div class="contact_map_wrapper">
        <div id="map">
                <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=La%20Vega&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://usave.co.uk">usave</a></div></div>

        </div>
    </div>
    
@endsection