<div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                    <a class="nav-link active" href="{{url('home')}}" onclick="event.preventDefault(); document.getElementById('home-form').submit();"><i class="icon-speedometer"></i> Dashboard</a>

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
                        <a class="nav-link" href="{{url('producto')}}" onclick="event.preventDefault(); document.getElementById('producto-form').submit();"><i class="fa fa-tasks"></i> Productos</a>
                        <form id="producto-form" action="{{url('producto')}}" method="GET" style="display: none;">
                            {{csrf_field()}}
                         </form>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="{{url('venta')}}" onclick="event.preventDefault(); document.getElementById('venta-form').submit();"><i class="fa fa-suitcase"></i> Ventas</a>
                        <form id="venta-form" action="{{url('venta')}}" method="GET" style="display: none;">
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


                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>
