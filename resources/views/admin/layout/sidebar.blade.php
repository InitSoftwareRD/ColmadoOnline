<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
    <img src="{{ asset('dist/img/logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Cafereria AAA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>

        @auth

        <div class="info">
          <a href="#" class="d-block">{{  auth()->user()->name.' '.auth()->user()->last_name }}</a>
          </div>
            
        @endauth
       
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
      @if (Auth::user()->isAdmin())
        
         <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Gestión Usuarios
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
             <a href="{{ route('user') }}" class="nav-link active">
                <i class="fas fa-plus-circle nav-icon"></i>
                <p>Crear Usuario</p>
              </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('personal') }}" class="nav-link">
                  <i class="fas fa-building"></i>
                  <p>Empleados</p>
                </a>
              </li>

            <li class="nav-item">
              <a href="{{ route('cliente') }}" class="nav-link">
                <i class="fas fa-user-friends nav-icon"></i>
                <p>Clientes</p>
              </a>
            </li>
          </ul>
        </li>  
        
       
        
        

        
      

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fas fa-store"></i>
              <p>
                Productos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item">
                <a href="{{ route('create_category') }}" class="nav-link">
                      <i class="fas fa-tags"></i>
                      <p>Categorias</p>
                    </a>
                </li>

              <li class="nav-item">
               <a href="{{ route('crear_producto') }}" class="nav-link">
                  <i class="fas fa-plus-circle"></i>
                  <p>Crear Productos</p>
                </a>
              </li>

              <li class="nav-item">
              <a href="{{ route('editar-producto') }}" class="nav-link">
                  <i class="far fa-edit"></i>
                  <p>Editar Productos</p>
                </a>
              </li>

              <li class="nav-item">
              <a href="{{ route('crear-oferta') }}" class="nav-link">
                    <i class="fas fa-percentage"></i>
                    <p>Crear Ofertas</p>
                  </a>
              </li>


              <li class="nav-item">
                  <a href="{{ route('editar-oferta') }}" class="nav-link">
                      <i class="far fa-edit"></i>
                        <p>Editar Oferta</p>
                      </a>
                  </li>

            </ul>
            
          </li>
      @endif
          

          {{-- <li class="nav-item">
            <a href="pages/widgets.html" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Widgets
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li> --}}

         
        @if(Auth::user()->isAdmin() || Auth::user()->isCajero() )    

          <li class="nav-header">Cajeros</li>

          <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
                <i class="fas fa-cart-arrow-down"></i>
              <p>
                Ordenar
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
              <a href="{{ route('ordenar') }}" class="nav-link">
                  <i class="fas fa-shopping-bag"></i>
                  <p>Orden</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('orden_status') }}" class="nav-link">
                  <i class="fas fa-sync-alt"></i>
                  <p>Estatus Orden/Pedido</p>
                </a>
              </li>
            </ul>
          </li>
         
      @endif


      
      @if(Auth::user()->isAdmin() || Auth::user()->isDelivery() ) 

          <li class="nav-header">Delivery</li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
              <p>
                 Pedidos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('delivery') }}" class="nav-link">
                  <i class="fas fa-truck"></i>
                  <p>Envios</p>
                </a>
              </li>
            </ul>
          </li>

         @endif

          
         @if(Auth::user()->isAdmin() ) 
       
          <li class="nav-header">Estadistica</li>

        
          <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                  <i class="fas fa-chart-line"></i>
                <p>
                    General
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./index2.html" class="nav-link">
                    <i class="fas fa-chart-pie"></i>
                    <p>Graficos</p>
                  </a>
                </li>
                
              </ul>
            </li>

            @endif
               
          </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>