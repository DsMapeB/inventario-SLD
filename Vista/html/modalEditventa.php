<?php $filas = $result->fetch(); ?>
<form action="index.php?accion=actualizarVenta" method="POST" id="agregarproveedor">
    <div class="input-group mb-3">
        <span class="input-group-text" id="codventa2">Codigo de venta</span>
        <input type="text" class="form-control" placeholder="Codigo de venta" aria-label="Codigo" aria-describedby="basic-addon1" value="<?php echo $filas['codventa']; ?>" readonly id="codventa2" name="codventa2" required>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="fecha2">Fecha</span>
        <input type="date" class="form-control" placeholder="Fecha" aria-label="fecha" aria-describedby="basic-addon1" value="<?php echo $filas['fecha']; ?>" id="fecha2" name="fecha2" required>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="hora2">Hora</span>
        <input type="time" class="form-control" placeholder="Hora" aria-label="hora" aria-describedby="basic-addon1" value="<?php echo $filas['hora']; ?>" id="hora2" name="hora2" required>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" for="inputGroupSelect01">Trabajador</span>
        <select class="form-select" name="idUsu2" required>
            <option value="<?php echo $filas['Usu']; ?>"><?php echo $filas['usuario']; ?></option>
            <?php
            $Trabajadores = false;
            
            while ($filas2 = $result2->fetch()) {
                if ($filas2['Usudoc'] != $filas['Usu']) {
                    if (!$filas2['Usu'] && !$Trabajadores) {
                ?>
                    <option disabled>-- Seleccione el Trabajador a Actualizar --</option>
                    <?php
                    $Trabajadores = true;
                    }
                    ?>
                    <option value="<?php echo $filas2['Usudoc']; ?>"><?php echo $filas2['usuario']; ?></option>
                <?php
                }
            }

            if (!$filas2['Usudoc']) {
                ?>
                <option disabled>No hay mas Trabajadores disponibles</option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" for="inputGroupSelect02">Documento Cliente</span>
        <select class="form-select" name="docclie2" required>
            <option value="<?php echo $filas['clie']; ?>"><?php echo $filas['nombreclie']; ?></option>
            <?php
            $Clientes = false; // Variable de control

            while ($filas3 = $result3->fetch()) {
                if ($filas3['docclie'] != $filas['clie']) {
                    if (!$filas3['clie'] && !$Clientes) {
                        // Imprimir solo una vez
            ?>
                        <option disabled>-- Seleccione el Cliente a Actualizar --</option>
                    <?php
                        $Clientes = true; // Actualizar variable de control
                    }
                    ?>
                    <option value="<?php echo $filas3['docclie']; ?>"><?php echo $filas3['nombreclie']; ?></option>
                <?php
                }
            }
            if (!$filas3['docclie']) {
                // Si la opción "Seleccione el Cliente a Actualizar" nunca fue imprimida
                ?>
                <option disabled>No hay mas Clientes disponibles</option>
            <?php
            }
            ?>
        </select>

    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" for="inputGroupSelect03">Codigo de producto</span>
        <select class="form-select" name="codprodu2" required>
            <option value="<?php echo $filas['produ']; ?>"><?php echo $filas['nombreprodu']; ?></option>
            <?php
            $Productos = false;

            while ($filas4 = $result4->fetch()) {
                if ($filas4['codprodu'] != $filas['produ']) {
                    if (!$filas4['produ'] && !$Productos) {
            ?>
                        <option disabled>-- Seleccione el Producto a Actualizar --</option>
                    <?php
                        $Productos = true;
                    }
                    ?>
                    <option value="<?php echo $filas4['codprodu']; ?>"><?php echo $filas4['nombreprodu']; ?></option>
                <?php
                }
            }

            if (!$filas4['codprodu']) {
                ?>
                <option disabled>No hay mas Productos disponibles</option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Observación</span>
        <input type="text" class="form-control" placeholder="Observación" aria-label="Observación" aria-describedby="basic-addon1" value="<?php echo $filas['observacion']; ?>" id="obs2" name="obs2" required>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Total</span>
        <input type="text" class="form-control" placeholder="Total" aria-label="total" aria-describedby="basic-addon1" value="<?php echo $filas['total']; ?>" id="total2" name="total2" required>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </div>
</form>

<script src="Vista/js/java_.js"></script>
<script src="Vista/js/java.js"></script>