<?php $filas = $result->fetch(); ?>
<form action="index.php?accion=actualizarprodu" method="POST" id="agregarusuario">
    <div class="modal-body">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Codigo</span>
            <input type="text" class="form-control" placeholder="Codigo del Producto" aria-label="Nombre" aria-describedby="basic-addon1" value="<?php echo $filas['codprodu']; ?>" readonly id="codprodu" name="codprodu" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nombre</span>
            <input type="text" class="form-control" placeholder="Nombre del Producto" aria-label="Nombre" aria-describedby="basic-addon1" value="<?php echo $filas['nombreprodu']; ?>" id="nombreprodu" name="nombreprodu" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" for="inputGroupSelect01">Precio</span>
            <input type="text" class="form-control" placeholder="Precio del Producto" aria-label="Telefono" aria-describedby="basic-addon1" value="<?php echo $filas['precioprodu']; ?>" id="precioprodu" name="precioprodu" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Existencia</span>
            <input type="text" class="form-control" placeholder="Existencia" aria-label="existencia" aria-describedby="basic-addon1" value="<?php echo $filas['existenciaprodu']; ?>" id="exisprodu" name="exisprodu" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Proveedor</span>
            <select class="form-select" id="nitEdit" name="proprodu" required>
            </select>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </div>
</form>

<script src="Vista/js/java_.js"></script>
<script src="Vista/js/java.js"></script>