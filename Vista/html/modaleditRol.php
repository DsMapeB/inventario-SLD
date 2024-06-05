<?php $filas = $result->fetch(); ?>
<form action="index.php?accion=actualizarRol" method="post" class="row g-3 needs-validation">
<div class="col-12">
    <label for="validationDefault02" class="form-label">Id Rol</label>
    <input type="text" class="form-control" id="validationDefault02" name="numrol2" value="<?php echo $filas['cargoUsu'] ?>" required readonly>
  </div>
  <div class="col-12">
    <label for="validationDefault02" class="form-label">Nombre Rol</label>
    <input type="text" class="form-control" id="validationDefault02" name="rol2" value="<?php echo $filas['nombrerol'] ?>" required>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
  </div>
</form>