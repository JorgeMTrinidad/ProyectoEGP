    <script type="text/javascript">
    function noenter() {
    return !(window.event && window.event.keyCode == 13); }
    </script>
   
    <div class="form-group row">
                <label class="col-md-3 form-control-label" for="nombre">Nombre</label>
                <div class="col-md-9">
                    <input type="text" id="nombre" onkeypress="return noenter()" name="nombre" class="form-control" placeholder="Ingrese el Nombre" required>
                    
                </div>
    </div>
    
    <div class="form-group row">
                <label class="col-md-3 form-control-label" for="direccion">Dirección</label>
                <div class="col-md-9">
                    <input type="text" id="direccion" onkeypress="return noenter()" name="direccion" class="form-control" placeholder="Ingrese la dirección">
                </div>
    </div>

     <div class="form-group row">
            <label class="col-md-3 form-control-label" for="documento">Documento</label>
            
            <div class="col-md-9">
            
                <select class="form-control" name="tipo_documento" id="tipo_documento">
                                                
                    <option value="0" disabled>Seleccione</option>
                    <option value="NIT">NIT</option>
                    <option value="CodE">Código de Empresa</option>
                    

                </select>
            
            </div>
                                       
    </div>
    
    
     <div class="form-group row">
                <label class="col-md-3 form-control-label" for="num_documento">Número documento</label>
                <div class="col-md-9">
                    <input type="text" id="num_documento" onkeypress="return noenter()" name="num_documento" class="form-control" placeholder="Ingrese el número documento">
                </div>
    </div>

    <div class="form-group row">
                <label class="col-md-3 form-control-label" for="telefono">Telefono</label>
                <div class="col-md-9">
                  
                    <input type="text" id="telefono" onkeypress="return noenter()" name="telefono" class="form-control" placeholder="Ingrese el telefono" pattern="[0-9]{0,15}">
                       
                </div>
    </div>

    <div class="form-group row">
                <label class="col-md-3 form-control-label" for="telefono">Correo</label>
                <div class="col-md-9">
                  
                <input type="email" class="form-control" id="email" onkeypress="return noenter()" name="email" placeholder="Ingrese el correo">
                       
                </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times fa-2x"></i> Cerrar</button>
        <button type="submit" class="btn btn-success"><i class="fa fa-save fa-2x"></i> Guardar</button>
        
    </div>