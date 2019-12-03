@extends('admin.layout.layout')

@section('title')
    Estatus Orden
@endsection



@section('content')

<div class="row">
    <div class="col-md-12">
     <nav>
       <div class="nav nav-tabs" id="nav-tab" role="tablist">
           <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Ordenes Online
           </a>
           <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Ordenes Internas
           </a>
       </div>
     </nav>

    </div>

</div>


<div class="tab-content"  id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
              <onlinestatus-component></onlinestatus-component>
           
  
    </div>
  
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

            <status-component></status-component>
       
    </div>
  
  </div>
   

    
@endsection