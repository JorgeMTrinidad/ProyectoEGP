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
                        <a class="nav-link" href="{{url('ingreso')}}" onclick="event.preventDefault(); document.getElementById('ingreso-form').submit();"><i class="fa fa-shopping-cart"></i> Ingresos</a>
                        <form id="ingreso-form" action="{{url('ingreso')}}" method="GET" style="display: none;">
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
                        <a class="nav-link" href="files/Manual.pdf" download target="_blank"><i class="fa fa-list"></i> Manual de Usuario</a>
                    </li>



                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>
