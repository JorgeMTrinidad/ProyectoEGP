<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                    <a class="nav-link" href="{{url('home')}}" onclick="event.preventDefault(); document.getElementById('home-form').submit();"><i class="fa fa-list"></i> Dashbord</a>

                            <form id="home-form" action="{{url('home')}}" method="GET" style="display: none;">
                            {{csrf_field()}}
                            </form>
                    </li>
                    <li class="nav-title">
                        Menú
                    </li>


                    <li class="nav-item">

                           <a class="nav-link" href="{{url('categoria')}}" onclick="event.preventDefault(); document.getElementById('categoria-form').submit();"><i class="fa fa-list"></i> Categorías</a>

                            <form id="categoria-form" action="{{url('categoria')}}" method="GET" style="display: none;">
                            {{csrf_field()}}
                            </form>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('producto')}}" onclick="event.preventDefault(); document.getElementById('producto-form').submit();"><i class="fa fa-list"></i> Productos</a>

                            <form id="producto-form" action="{{url('producto')}}" method="GET" style="display: none;">
                            {{csrf_field()}}
                            </form>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{url('ingreso')}}" onclick="event.preventDefault(); document.getElementById('ingreso-form').submit();"><i class="fa fa-shopping-cart"></i> Ingresos</a>
                        <form id="ingreso-form" action="{{url('ingreso')}}" method="GET" style="display: none;">
                            {{csrf_field()}}
                         </form>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('proveedor')}}" onclick="event.preventDefault(); document.getElementById('proveedor-form').submit();"><i class="fa fa-users"></i> Proveedores</a>
                        <form id="proveedor-form" action="{{url('proveedor')}}" method="GET" style="display: none;">
                            {{csrf_field()}}
                         </form>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{url('egreso')}}" onclick="event.preventDefault(); document.getElementById('egreso-form').submit();"><i class="fa fa-suitcase"></i> Egresos</a>
                        <form id="egreso-form" action="{{url('egreso')}}" method="GET" style="display: none;">
                            {{csrf_field()}}
                         </form>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('maestroObras')}}" onclick="event.preventDefault(); document.getElementById('maestroObras-form').submit();"><i class="fa fa-users"></i> Maestro de obras</a>
                        <form id="maestroObras-form" action="{{url('maestroObras')}}" method="GET" style="display: none;">
                            {{csrf_field()}}
                         </form>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{url('user')}}" onclick="event.preventDefault(); document.getElementById('user-form').submit();"><i class="fa fa-user"></i> Usuarios</a>
                        <form id="user-form" action="{{url('user')}}" method="GET" style="display: none;">
                            {{csrf_field()}}
                         </form>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{url('rol')}}" onclick="event.preventDefault(); document.getElementById('rol-form').submit();"><i class="fa fa-list"></i> Roles</a>
                        <form id="rol-form" action="{{url('rol')}}" method="GET" style="display: none;">
                            {{csrf_field()}}
                         </form>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="files/Manual.pdf" download target="_blank"><i class="fa fa-list"></i> Manual de Usuario</a>
                    </li>


                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>
