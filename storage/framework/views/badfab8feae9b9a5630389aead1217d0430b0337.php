<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-item">
            <a class="nav-link" href="<?php echo e(url('home')); ?>" onclick="event.preventDefault(); document.getElementById('home-form').submit();"><i class="fa fa-list"></i> Dashbord</a>

                    <form id="home-form" action="<?php echo e(url('home')); ?>" method="GET" style="display: none;">
                    <?php echo e(csrf_field()); ?>

                    </form>
            </li>
            <li class="nav-title">
                Menú
            </li>


            <li class="nav-item">

                   <a class="nav-link" href="<?php echo e(url('categoria')); ?>" onclick="event.preventDefault(); document.getElementById('categoria-form').submit();"><i class="fa fa-list"></i> Categorías</a>

                    <form id="categoria-form" action="<?php echo e(url('categoria')); ?>" method="GET" style="display: none;">
                    <?php echo e(csrf_field()); ?>

                    </form>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('producto')); ?>" onclick="event.preventDefault(); document.getElementById('producto-form').submit();"><i class="fa fa-list"></i> Productos</a>

                    <form id="producto-form" action="<?php echo e(url('producto')); ?>" method="GET" style="display: none;">
                    <?php echo e(csrf_field()); ?>

                    </form>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('compra')); ?>" onclick="event.preventDefault(); document.getElementById('compra-form').submit();"><i class="fa fa-shopping-cart"></i> Compras</a>
                <form id="compra-form" action="<?php echo e(url('compra')); ?>" method="GET" style="display: none;">
                    <?php echo e(csrf_field()); ?>

                 </form>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('proveedor')); ?>" onclick="event.preventDefault(); document.getElementById('proveedor-form').submit();"><i class="fa fa-users"></i> Proveedores</a>
                <form id="proveedor-form" action="<?php echo e(url('proveedor')); ?>" method="GET" style="display: none;">
                    <?php echo e(csrf_field()); ?>

                 </form>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('venta')); ?>" onclick="event.preventDefault(); document.getElementById('venta-form').submit();"><i class="fa fa-suitcase"></i> Ventas</a>
                <form id="venta-form" action="<?php echo e(url('venta')); ?>" method="GET" style="display: none;">
                    <?php echo e(csrf_field()); ?>

                 </form>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('maestroObras')); ?>" onclick="event.preventDefault(); document.getElementById('maestroObras-form').submit();"><i class="fa fa-users"></i> Maestros de Obras</a>
                <form id="maestroObras-form" action="<?php echo e(url('maestroObras')); ?>" method="GET" style="display: none;">
                    <?php echo e(csrf_field()); ?>

                 </form>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('user')); ?>" onclick="event.preventDefault(); document.getElementById('user-form').submit();"><i class="fa fa-user"></i> Usuarios</a>
                <form id="user-form" action="<?php echo e(url('user')); ?>" method="GET" style="display: none;">
                    <?php echo e(csrf_field()); ?>

                 </form>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(url('rol')); ?>" onclick="event.preventDefault(); document.getElementById('rol-form').submit();"><i class="fa fa-list"></i> Roles</a>
                <form id="rol-form" action="<?php echo e(url('rol')); ?>" method="GET" style="display: none;">
                    <?php echo e(csrf_field()); ?>

                 </form>
            </li>


        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
<?php /**PATH C:\xampp\htdocs\Proyecto_EGP\ProyectoEGP\resources\views/plantilla/sidebar.blade.php ENDPATH**/ ?>