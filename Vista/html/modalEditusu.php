<?php $fila = $result->fetch(); ?>
<form action="index.php?accion=actualizarUsuario" method="post" class="row g-3" enctype="multipart/form-data">
  <div class="col-12">
    <label for="validationDefault01" class="form-label">Documento</label>
    <input type="text" class="form-control" id="validationDefault01" name="Usudoc2" value="<?php echo $fila['Usudoc']; ?>" required readonly>
  </div>
  <div class="col-12">
    <label for="validationDefault02" class="form-label">Usuario</label>
    <input type="text" class="form-control" id="validationDefault02" name="usuario2" value="<?php echo $fila['usuario']; ?>" required>
  </div>
  <div class="col-12">
    <label for="validationDefault03" class="form-label">Contraseña</label>
    <input type="password" class="form-control" name="password2" id="validationDefault03" value="<?php echo $fila['password']; ?>" required>
  </div>
  <div class="col-12">
    <label for="validationDefault04" class="form-label">Foto</label>
    <input type="file" class="form-control" name="foto2" id="validationDefault04" required>
  </div>
  <div class="col-12">
    <label for="validationDefault05" class="form-label">Rol</label>
    <select class="form-select" id="rol2" name="cargo2" required>
    </select>
  </div>
  <div class="col-12">
    <button class="btn btn-primary" type="submit">Registrar</button>
  </div>
</form>

<script src="Vista/js/java_.js"></script>
<script src="Vista/js/java.js"></script>