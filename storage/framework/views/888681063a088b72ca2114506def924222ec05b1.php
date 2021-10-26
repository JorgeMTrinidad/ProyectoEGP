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

                       <h2>Listado de Categorías</h2><br/>
                       <?php if(session('user_roll')!==3): ?>
                        <button class="btn btn-primary btn-lg" type="button" data-toggle="modal" data-target="#abrirmodal">
                            <i class="fa fa-plus fa-2x"></i>&nbsp;&nbsp;Agregar Categoría
                        </button>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                            <?php echo Form::open(array('url'=>'categoria','method'=>'GET','autocomplete'=>'off','role'=>'search')); ?>

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

                                    <th>Código</th>
                                    <th>Categoría</th>
                                    <th>Descripción</th>
                                    <th>Estado</th>
                                    <?php if(session('user_roll')!==3): ?>
                                    <th>Editar</th>
                                    <th>Cambiar Estado</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>

                               <?php $__currentLoopData = $categorias; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <tr>
                                    <td><?php echo e($cat->id); ?></td>
                                    <td><?php echo e($cat->nombre); ?></td>
                                    <td><?php echo e($cat->descripcion); ?></td>
                                    <td>

                                      <?php if($cat->condicion=="1"): ?>

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
                                        <button type="button" class="btn btn-info btn-md" data-id_categoria="<?php echo e($cat->id); ?>" data-nombre="<?php echo e($cat->nombre); ?>" data-descripcion="<?php echo e($cat->descripcion); ?>" data-toggle="modal" data-target="#abrirmodalEditar">

                                          <i class="fa fa-edit fa-2x"></i> Editar
                                        </button> &nbsp;
                                    </td>

                                    <td>


                                        <?php if($cat->condicion): ?>

                                        <button type="button" class="btn btn-danger btn-sm" data-id_categoria="<?php echo e($cat->id); ?>" data-toggle="modal" data-target="#cambiarEstado">
                                            <i class="fa fa-times fa-2x"></i> Desactivar
                                        </button>

                                        <?php else: ?>

                                        <button type="button" class="btn btn-success btn-sm" data-id_categoria="<?php echo e($cat->id); ?>" data-toggle="modal" data-target="#cambiarEstado">
                                            <i class="fa fa-lock fa-2x"></i> Activar
                                        </button>

                                        <?php endif; ?>

                                    </td>
                                    <?php endif; ?>
                                </tr>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>

                            <?php echo e($categorias->render()); ?>


                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar-->
            <div class="modal fade" id="abrirmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar categoría</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-body">


                            <form action="<?php echo e(route('categoria.store')); ?>" method="post" class="form-horizontal">

                                <?php echo e(csrf_field()); ?>


                                <?php echo $__env->make('categoria.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                            <h4 class="modal-title">Actualizar categoría</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-body">


                            <form action="<?php echo e(route('categoria.update','test')); ?>" method="post" class="form-horizontal">

                                <?php echo e(method_field('patch')); ?>

                                <?php echo e(csrf_field()); ?>


                                <input type="hidden" id="id_categoria" name="id_categoria" value="">

                                <?php echo $__env->make('categoria.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                            <h4 class="modal-title">Cambiar Estado de la Categoría</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <div class="modal-body">


                            <form action="<?php echo e(route('categoria.destroy','test')); ?>" method="post" class="form-horizontal">

                                <?php echo e(method_field('delete')); ?>

                                <?php echo e(csrf_field()); ?>


                                <input type="hidden" id="id_categoria" name="id_categoria" value="">

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

<?php echo $__env->make('principal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Proyecto_EGP\ProyectoEGP\resources\views/categoria/index.blade.php ENDPATH**/ ?>