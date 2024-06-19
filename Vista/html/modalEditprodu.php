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
            <select class="form-select" name="proprodu" required>
                <option value="<?php echo $filas['nitprodu']; ?>">Proveedor Actual: <?php echo $filas['nombrePro']; ?></option>
                <option disabled>-- Seleccione el Nit del Proveedor --</option>
                <?php
                while ($filas2 = $result2->fetch()) {
                    if ($filas2['nitpro'] != $filas['nitprodu']) {
                ?>
                        <option value="<?php echo $filas2['nitpro'] ?>"><?php echo $filas2['nombrePro'] ?></option>
                    <?php
                    }
                }
                // Si no se encontraron proveedores adicionales, mostrar el mensaje
                if (!$filas2['nitpro']) {
                    ?>
                    <option disabled>No hay más Proveedores disponibles</option>
                <?php
                }
                ?>
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