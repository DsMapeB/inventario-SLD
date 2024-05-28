<?php $filas = $result->fetch(); ?>
<form action="index.php?accion=actualizarVenta" novalidate method="POST" id="agregarproveedor">
    <div class="input-group mb-3">
        <span class="input-group-text" id="codventa2">Codigo de venta</span>
        <input type="text" class="form-control" placeholder="Codigo de venta" aria-label="Codigo" aria-describedby="basic-addon1" value="<?php echo $filas['codventa']; ?>" readonly id="codventa2" name="codventa2">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="fecha2">Fecha</span>
        <input type="date" class="form-control" placeholder="Fecha" aria-label="fecha" aria-describedby="basic-addon1" value="<?php echo $filas['fecha']; ?>" id="fecha2" name="fecha2">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="hora2">Hora</span>
        <input type="time" class="form-control" placeholder="Hora" aria-label="hora" aria-describedby="basic-addon1" value="<?php echo $filas['hora']; ?>" id="hora2" name="hora2">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" for="inputGroupSelect01">Usuario</span>
        <select class="form-select" id="idUsu2" name="idUsu2"> 
        <option value=""><?php echo $filas['docUsu']; ?></option>
        </select>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" for="inputGroupSelect02">Documento Cliente</span>
        <select class="form-select" id="docclie2" name="docclie2">
        <option value=""><?php echo $filas['docclie']; ?></option>
        </select>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" for="inputGroupSelect03">Codigo de producto</span>
        <select class="form-select" id="codprodu2" name="codprodu2">
        <option value=""><?php echo $filas['codprodu']; ?></option>
        </select>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Observación</span>
        <input type="text" class="form-control" placeholder="Observación" aria-label="Observación" aria-describedby="basic-addon1" value="<?php echo $filas['observacion']; ?>" id="obs2" name="obs2">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Total</span>
        <input type="text" class="form-control" placeholder="Total" aria-label="total" aria-describedby="basic-addon1" value="<?php echo $filas['total']; ?>" id="total2" name="total2">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </div>
</form>

<script src="Vista/js/java_.js"></script>
<script src="Vista/js/java.js"></script>