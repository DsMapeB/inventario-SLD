<?php $filas = $result->fetch(); ?>
<form action="index.php?accion=actualizarRol" method="post">
<div class="input-group mb-3">
    <span for="validationDefault01" class="input-group-text">Rol</span>
    <input type="text" class="form-control" id="validationDefault01" name="numrol2" value="<?php echo $filas['cargoUsu'] ?>" required readonly>
  </div>
  <div class="input-group mb-3">
    <span for="validationDefault02" class="input-group-text">Nombre Rol</span>
    <input type="text" class="form-control" id="validationDefault02" name="rol2" value="<?php echo $filas['nombrerol'] ?>" required>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
  </div>
</form>