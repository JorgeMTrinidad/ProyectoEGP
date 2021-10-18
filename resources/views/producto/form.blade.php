<script type="text/javascript">
    function noenter() {
    return !(window.event && window.event.keyCode == 13); }
    </script>

    <div class="form-group row">
            <label class="col-md-3 form-control-label" for="titulo">Categoría</label>
            
            <div class="col-md-9">
            
                <select class="form-control" name="id" id="id" required>
                                                
                <option value="0" disabled>Seleccione</option>
                
                @foreach($categorias as $cat)
                  
                   <option value="{{$cat->id}}">{{$cat->nombre}}</option>
                        
                @endforeach

                </select>
            
            </div>
                                       
    </div>
    
    
    <div class="form-group row">
                <label class="col-md-3 form-control-label" for="codigo">Código</label>
                <div class="col-md-9">
                    <input type="text" id="codigo" onkeypress="return noenter()" name="codigo" class="form-control" placeholder="Ingrese el Código" required">
                   
                </div>
    </div>
    
    <div class="form-group row">
                <label class="col-md-3 form-control-label" for="stock">Stock Jalapa</label>
                <div class="col-md-9">
                    <input type="text" id="stock" name="stock" class="form-control" placeholder="Ingrese el stock">
                </div>
    </div>

    <div class="form-group row">
        <label class="col-md-3 form-control-label" for="stock2">Stock Monjas</label>
        <div class="col-md-9">
            <input type="text" id="stock2" name="stock2" class="form-control" placeholder="Ingrese el stock">
        </div>
</div>

     <div class="form-group row">
                <label class="col-md-3 form-control-label" for="nombre">Nombre</label>
                <div class="col-md-9">
                    <input type="text" id="nombre" onkeypress="return noenter()" name="nombre" class="form-control" placeholder="Ingrese el nombre">
                </div>
    </div>
    <div class="form-group row">
        <label class="col-md-3 form-control-label" for="marca">Marca</label>
        <div class="col-md-9">
            <input type="text" id="marca" onkeypress="return noenter()" name="marca" class="form-control" placeholder="Ingrese la marca">
        </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Precio Costo</label>
    <div class="col-md-9">
        <input type="number" step="0.01" id="precio_costo" name="precio_costo" class="form-control" placeholder="Ingrese el precio de costo" required pattern="^[a-zA-Z_áéíóúñ\s]{0,100}$">
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Porcentaje Máximo</label>
    <div class="col-md-9">
        <input type="number" step="0.01" id="por_max" name="por_max" class="form-control" placeholder="Ingrese el porcentaje máximo de venta" required pattern="^[a-zA-Z_áéíóúñ\s]{0,100}$">
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Porcentaje Sugerido</label>
    <div class="col-md-9">
        <input type="number" step="0.01" id="por_sug" name="por_sug" class="form-control" placeholder="Ingrese el porcentaje sugerido" required pattern="^[a-zA-Z_áéíóúñ\s]{0,100}$">
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Porcentaje Mínimo</label>
    <div class="col-md-9">
        <input type="number" step="0.01" id="por_min" name="por_min" class="form-control" placeholder="Ingrese el porcentaje mínimo de venta" required pattern="^[a-zA-Z_áéíóúñ\s]{0,100}$">
    </div>
</div>

    <div class="form-group row">
        <label class="col-md-3 form-control-label" for="nombre">Cantidad Máxima Existencias Jalapa</label>
        <div class="col-md-9">
            <input type="number" step="0.01" id="max_existencia" name="max_existencia" class="form-control" placeholder="Ingrese la cantidad máxima para las existencias" required pattern="^[a-zA-Z_áéíóúñ\s]{0,100}$">
        </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Cantidad Mínima Existencias Jalapa</label>
    <div class="col-md-9">
        <input type="number" step="0.01" id="min_existencia" name="min_existencia" class="form-control" placeholder="Ingrese la cantidad mínima para las existencias" required pattern="^[a-zA-Z_áéíóúñ\s]{0,100}$">
    </div>
</div>

<div class="form-group row">
    <label class="col-md-3 form-control-label" for="nombre">Cantidad Máxima Existencias Monjas</label>
    <div class="col-md-9">
        <input type="number" step="0.01" id="max_existencia2" name="max_existencia2" class="form-control" placeholder="Ingrese la cantidad máxima para las existencias" required pattern="^[a-zA-Z_áéíóúñ\s]{0,100}$">
    </div>
</div>

<div class="form-group row">
<label class="col-md-3 form-control-label" for="nombre">Cantidad Mínima Existencias Monjas</label>
<div class="col-md-9">
    <input type="number" step="0.01" id="min_existencia2" name="min_existencia2" class="form-control" placeholder="Ingrese la cantidad mínima para las existencias" required pattern="^[a-zA-Z_áéíóúñ\s]{0,100}$">
</div>
</div>

    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Guardar</button>
        
    </div>