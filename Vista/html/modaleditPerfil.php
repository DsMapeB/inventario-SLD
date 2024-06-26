<?php $filas = $result->fetch(); ?>
<form action="index.php?accion=actualizarPerfilF" method="post" enctype="multipart/form-data">
  <div class="modal-body">
    <div class="input-group mb-3">
      <span for="validationDefault01" class="input-group-text">Documento</span>
      <input type="text" class="form-control" placeholder="Documento" name="Usudoc3" value="<?php echo $filas['Usudoc']; ?>" minlength="6" maxlength="10" required readonly>
    </div>
    <div class="input-group mb-3">
      <span for="validationDefault02" class="input-group-text">Usuario</span>
      <input type="text" class="form-control" placeholder="Ingrese su Usuario" name="usuario3" value="<?php echo $filas['usuario']; ?>" required>
    </div>
    <div class="input-group mb-3">
      <span for="validationDefault03" class="input-group-text">Telefono</span>
      <input type="text" class="form-control" placeholder="Ingrese su Telefono" name="tel3" id="tel3" value="<?php echo $filas['telefono']; ?>" maxlength="10" required>
    </div>
    <script>
      document.getElementById('tel3').addEventListener('input', function(e) {
        var input = e.target;
        var value = input.value;
        // Eliminar cualquier carácter no numérico
        value = value.replace(/\D/g, '');
        // Aplicar la longitud mínima y máxima
        if (value.length < 7) {
          input.setCustomValidity('El Teléfono debe tener al menos 7 dígitos.');
        } else if (value.length > 10) {
          input.setCustomValidity('El Teléfono no puede tener más de 10 dígitos.');
        } else {
          input.setCustomValidity('');
        }
        input.value = value;
      });
    </script>
    <div class="input-group mb-3">
      <span for="validationDefault04" class="input-group-text">Contraseña</span>
      <input type="text" class="form-control" placeholder="Ingrese su Contraseña" name="contraseña3" id="validationDefault04" value="<?php echo $filas['password']; ?>" required>
    </div>
    <div class="input-group mb-3">
      <span for="validationDefault05" class="input-group-text">Foto</span>
      <input type="file" class="form-control" name="foto3" id="validationDefault05">
      <input type="hidden" name="foto_existente" value="<?php echo $filas['foto']; ?>">
    </div>
    <div class="input-group mb-3">
      <span for="validationDefault06" class="input-group-text">Rol</span>
      <input type="text" class="form-control" placeholder="Ingrese su Rol" name="rol3" id="validationDefault06" value="<?php echo $filas['nombrerol']; ?>" readonly required>
    </div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
  </div>
</form>

<script src="Vista/js/java.js"></script>
<script src="Vista/js/java_.js"></script>