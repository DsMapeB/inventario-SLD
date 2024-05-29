<?php $filas = $result->fetch(); ?>
<form action="index.php?accion=actualizarPerfil" method="post">
  <div class="row mb-3">
    <label for="validationDefault01" class="form-label">Usuario</label>
    <input type="text" class="form-control" value="<?php echo $_SESSION['usuario']; ?>" required>
  </div>
  <div class="row mb-3">
    <label for="validationDefault02" class="form-label">Contraseña</label>
    <input type="text" class="form-control" value="" required>
  </div>
  <div class="row mb-3">
    <label for="validationDefault03" class="form-label">Rol</label>
    <input type="text" class="form-control" value="<?php echo $_SESSION['nombrerol']; ?>" readonly required>
  </div>

  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
  </div>
</form>