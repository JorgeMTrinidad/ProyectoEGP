<?php $__env->startSection('contenido'); ?>
<main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item active"><a href="/">SISTEMA DE INGRESOS - EGRESOS</a></li>
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">

                       <h2>Listado de Productos</h2><br/>
                       <?php if(session('user_roll')!==3): ?>
                        <button class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#abrirmodal">
                            <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Producto
                        </button>
                        <a href="<?php echo e(url('listarProductoPdf')); ?>" target="_blank">
                            <button type="button" class="btn btn-success btn-lg">
                                <i class="fa fa-file fa-2x"></i>&nbsp;&nbsp;Picking List

                            </button>
                        </a>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                            <?php echo Form::open(array('url'=>'producto','method'=>'GET','autocomplete'=>'off','role'=>'search')); ?>

                                <div class="input-group">

                                    <input type="text" name="buscarTexto" class="form-control" placeholder="Buscar texto" value="<?php echo e($buscarTexto); ?>">
                                    <button type="submit"  class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr class="bg-primary">

                                    <th>Categoria</th>
                                    <th>Producto</th>
                                    <th>Codigo</th>
                                    <th>Precio Venta (Q)
                                    <th>Stock</th>
                                    <th>Estado</th>
                                    <?php if(session('user_roll')!==3): ?>
                                    <th>Editar</th>
                                    <th>Cambiar Estado</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>

                               <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>

                                   <td><?php echo e($prod->categoria); ?></td>
                                    <td><?php echo e($prod->nombre); ?></td>
                                    <td><?php echo e($prod->codigo); ?></td>
                                    <td><?php echo e($prod->precio_venta); ?></td>
                                    <td><?php echo e($prod->stock); ?></td>


                                    <td>

                                      <?php if($prod->condicion=="1"): ?>
                                        <button type="button" class="btn btn-success btn-md">

                                          <i class="fa fa-check fa-2x"></i> Activo
                                        </button>

                                      <?php else: ?>

                                        <button type="button" class="btn btn-danger btn-md">

                                          <i class="fa fa-check fa-2x"></i> Desactivado
                                        </button>

                                       <?php endif; ?>

                                    </td>
                                    <?php if(session('user_roll')!==3): ?>
                                    <td>
                                        <button type="button" class="btn btn-info btn-md" data-id_producto="<?php echo e($prod->id); ?>" data-id_categoria="<?php echo e($prod->idcategoria); ?>" data-stock="<?php echo e($prod->stock); ?>" data-nombre="<?php echo e($prod->nombre); ?>" data-precio_venta="<?php echo e($prod->precio_venta); ?>"  data-toggle="modal" data-target="#abrirmodalEditar">
                                          <i class="fa fa-edit fa-2x"></i> Editar
                                        </button> &nbsp;
                                    </td>


                                    <td>

                                       <?php if($prod->condicion): ?>

                                        <button type="button" class="btn btn-danger btn-sm" data-id_producto="<?php echo e($prod->id); ?>" data-toggle="modal" data-target="#cambiarEstado">
                                            <i class="fa fa-times fa-2x"></i> Desactivar
                                        </button>

                                        <?php else: ?>

                                         <button type="button" class="btn btn-success btn-sm" data-id_producto="<?php echo e($prod->id); ?>" data-toggle="modal" data-target="#cambiarEstado">
                                            <i class="fa fa-lock fa-2x"></i> Activar
                                        </button>

                                        <?php endif; ?>

                                    </td>
                                    <?php endif; ?>
                                </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>

                            <?php echo e($productos->render()); ?>


                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar-->
            <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar producto</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-body">


                            <form action="<?php echo e(route('producto.store')); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">

                                <?php echo e(csrf_field()); ?>


                                <?php echo $__env->make('producto.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            </form>
                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->


             <!--Inicio del modal actualizar-->
             <div class="modal fade" id="abrirmodalEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Actualizar producto</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-body">


                            <form action="<?php echo e(route('producto.update','test')); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">

                                <?php echo e(method_field('patch')); ?>

                                <?php echo e(csrf_field()); ?>


                                <input type="hidden" id="id_producto" name="id_producto" value="">

                                <?php echo $__env->make('producto.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                            </form>
                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->


             <!--Inicio del modal Cambiar Estado-->
             <div class="modal fade" id="cambiarEstado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Cambiar Estado del Producto</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-body">


                            <form action="<?php echo e(route('producto.destroy','test')); ?>" method="post" class="form-horizontal">

                                <?php echo e(method_field('delete')); ?>

                                <?php echo e(csrf_field()); ?>


                                <input type="hidden" id="id_producto" name="id_producto" value="">

                                <p>Estas seguro de cambiar el estado?</p>


                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-2x"></i>Cerrar</button>
                                    <button type="submit" class="btn btn-success"><i class="fa fa-lock fa-2x"></i>Aceptar</button>
                                </div>


                            </form>
                        </div>

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->




        </main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('principal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Proyecto_EGP\ProyectoEGP\resources\views/producto/index.blade.php ENDPATH**/ ?>