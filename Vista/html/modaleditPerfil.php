<?php $filas = $result->fetch(); ?>
<form action="index.php?accion=actualizarPerfilF" method="post" enctype="multipart/form-data">
  <div class="input-group mb-3">
    <span for="validationDefault01" class="input-group-text">Documento</span>
    <input type="text" class="form-control" value="<?php echo $filas['Usudoc']; ?>" name="Usudoc3" required readonly>
  </div>
  <div class="input-group mb-3">
    <span for="validationDefault02" class="input-group-text">Usuario</span>
    <input type="text" class="form-control" value="<?php echo $filas['usuario']; ?>" name="usuario3" required>
  </div>
  <div class="input-group mb-3">
    <span for="validationDefault03" class="input-group-text">Contraseña</span>
    <input type="text" class="form-control" value="<?php echo $filas['password']; ?>" name="contraseña3" required>
  </div>
  <div class="input-group mb-3">
    <span for="validationDefault04" class="input-group-text">Foto</span>
    <input type="file" class="form-control" name="foto3" id="validationDefault04" required>
  </div>
  <div class="input-group mb-3">
    <span for="validationDefault05" class="input-group-text">Rol</span>
    <select class="form-select" id="rolP" name="rol3" id="validationDefault05" readonly required>
      <!-- Opciones del rol -->
    </select>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
  </div>
</form>

<script src="Vista/js/java.js"></script>
<script src="Vista/js/java_.js"></script>