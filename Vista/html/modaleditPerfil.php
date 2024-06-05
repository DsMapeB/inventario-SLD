<?php $filas = $result->fetch(); ?>
<form action="index.php?accion=actualizarPerfil" method="post" enctype="multipart/form-data">
  <div class="row mb-3">
    <label for="validationDefault01" class="form-label">Documento</label>
    <input type="text" class="form-control" value="<?php echo $filas['Usudoc']; ?>" name="Usudoc3" required readonly>
  </div>
  <div class="row mb-3">
    <label for="validationDefault02" class="form-label">Usuario</label>
    <input type="text" class="form-control" value="<?php echo $filas['usuario']; ?>" name="usuario3" required>
  </div>
  <div class="row mb-3">
    <label for="validationDefault03" class="form-label">Contraseña</label>
    <input type="text" class="form-control" value="<?php echo $filas['password'] ?>" name="contraseña3" required>
  </div>
  <div class="row mb-3">
  <label for="validationDefault04" class="form-label">Foto</label>
    <input type="file" class="form-control" name="foto3" id="validationDefault04" required>
  </div>
  <div class="row mb-3">
    <label for="validationDefault05" class="form-label">Rol</label>
    <input type="text" class="form-control" value="<?php echo $filas['nombrerol']; ?>" name="rol3" readonly required>
  </div>

  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
  </div>
</form>