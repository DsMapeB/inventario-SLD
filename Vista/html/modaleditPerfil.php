<?php $filas = $result->fetch(); ?>
<form action="index.php?accion=actualizarPerfilF" method="post" enctype="multipart/form-data">
  <div class="modal-body">
    <div class="input-group mb-3">
      <span for="validationDefault01" class="input-group-text">Documento</span>
      <input type="text" class="form-control" name="Usudoc3" value="<?php echo $filas['Usudoc']; ?>" required readonly>
    </div>
    <div class="input-group mb-3">
      <span for="validationDefault02" class="input-group-text">Usuario</span>
      <input type="text" class="form-control" name="usuario3" value="<?php echo $filas['usuario']; ?>" required>
    </div>
    <div class="input-group mb-3">
      <span for="validationDefault03" class="input-group-text">Telefono</span>
      <input type="text" class="form-control" name="tel3" id="validationDefault03" value="<?php echo $filas['telefono']; ?>" required>
    </div>
    <div class="input-group mb-3">
      <span for="validationDefault04" class="input-group-text">Contraseña</span>
      <input type="text" class="form-control" name="contraseña3" id="validationDefault04" value="<?php echo $filas['password']; ?>" required>
    </div>
    <div class="input-group mb-3">
      <span for="validationDefault05" class="input-group-text">Foto</span>
      <input type="file" class="form-control" name="foto3" id="validationDefault05" required>
    </div>
    <div class="input-group mb-3">
      <span for="validationDefault06" class="input-group-text">Rol</span>
      <input type="text" class="form-control" name="rol3" id="validationDefault04" value="<?php echo $filas['nombrerol']; ?>" readonly required>
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
  </div>
</form>

<script src="Vista/js/java.js"></script>
<script src="Vista/js/java_.js"></script>