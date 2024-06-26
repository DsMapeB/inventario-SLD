<?php $filas = $result->fetch(); ?>
<form action="index.php?accion=actualizarprodu" method="POST" id="agregarusuario">
    <div class="modal-body">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Codigo</span>
            <input type="text" class="form-control" placeholder="Codigo del Producto" aria-label="Nombre" aria-describedby="basic-addon1" value="<?php echo $filas['codprodu']; ?>" readonly id="producod" name="codprodu" required>
        </div>
        <script>
            document.getElementById('producod').addEventListener('input', function(e) {
                var input = e.target;
                var value = input.value;
                // Eliminar cualquier carácter no numérico
                value = value.replace(/\D/g, '');
                // Aplicar la longitud mínima y máxima
                if (value.length < 7) {
                    input.setCustomValidity('El Documento debe tener al menos 7 dígitos.');
                } else if (value.length > 10) {
                    input.setCustomValidity('El Documento no puede tener más de 10 dígitos.');
                } else {
                    input.setCustomValidity('');
                }
                input.value = value;
            });
        </script>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Nombre</span>
            <input type="text" class="form-control" placeholder="Nombre del Producto" aria-label="Nombre" aria-describedby="basic-addon1" value="<?php echo $filas['nombreprodu']; ?>" id="nombreprodu" name="nombreprodu" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" for="inputGroupSelect01">Precio</span>
            <input type="text" class="form-control" placeholder="Precio del Producto" aria-describedby="basic-addon1" value="<?php echo $filas['precioprodu']; ?>" id="produprecio" name="precioprodu" required>
        </div>
        <script>
            document.getElementById('produprecio').addEventListener('input', function(e) {
                var input = e.target;
                var value = input.value;
                // Eliminar cualquier carácter no numérico
                input.value = value.replace(/\D/g, '');
            });
        </script>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Existencia</span>
            <input type="text" class="form-control" placeholder="Existencia" aria-label="existencia" aria-describedby="basic-addon1" value="<?php echo $filas['existenciaprodu']; ?>" id="produexis" name="exisprodu" required>
        </div>
        <script>
            document.getElementById('produexis').addEventListener('input', function(e) {
                var input = e.target;
                var value = input.value;
                // Eliminar cualquier carácter no numérico
                input.value = value.replace(/\D/g, '');
            });
        </script>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">Proveedor</span>
            <select class="form-select" name="proprodu" required>
                <option value="<?php echo $filas['nitprodu']; ?>">Proveedor Actual: <?php echo $filas['nombrePro']; ?></option>
                <?php
                $Proveedor = false;
                while ($filas2 = $result2->fetch()) {
                    if ($filas2['nitpro'] != $filas['nitprodu']) {
                        if (!$filas['nitprodu'] && !$Proveedor) {
                ?>
                            <option disabled>-- Seleccione el Proveedor --</option>
                        <?php
                            $Proveedor = true;
                        } ?>
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