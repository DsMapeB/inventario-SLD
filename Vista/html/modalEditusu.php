<?php $fila = $result->fetch(); ?>
<form action="index.php?accion=actualizarUsuario" method="post" class="row g-3" enctype="multipart/form-data">
  <div class="input-group mb-3">
    <span for="validationDefault01" class="input-group-text">Documento</span>
    <input type="text" class="form-control" id="validationDefault01" name="Usudoc2" value="<?php echo $fila['Usudoc']; ?>" required readonly>
  </div>
  <div class="input-group mb-3">
    <span for="validationDefault02" class="input-group-text">Usuario</span>
    <input type="text" class="form-control" id="validationDefault02" name="usuario2" value="<?php echo $fila['usuario']; ?>" required>
  </div>
  <div class="input-group mb-3">
    <span for="validationDefault03" class="input-group-text">Contraseña</span>
    <input type="password" class="form-control" name="password2" id="validationDefault03" value="<?php echo $fila['password']; ?>" required>
  </div>
  <div class="input-group mb-3">
    <span for="validationDefault04" class="input-group-text">Foto</span>
    <input type="file" class="form-control" name="foto2" id="validationDefault04" required>
  </div>
  <div class="input-group mb-3">
    <span for="validationDefault05" class="input-group-text">Rol</span>
    <select class="form-select" id="rol2" name="cargo2" id="validationDefault05" required>
    </select>
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary" type="submit">Registrar</button>
  </div>
</form>

<script src="Vista/js/java_.js"></script>
<script src="Vista/js/java.js"></script>