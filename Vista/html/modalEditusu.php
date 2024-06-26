<?php $fila = $result->fetch(); ?>
<form action="index.php?accion=actualizarUsuario" method="post" enctype="multipart/form-data">
  <div class="input-group mb-3">
    <span for="validationDefault01" class="input-group-text">Documento</span>
    <input type="text" id="doc" class="form-control" placeholder="Ingrese su Documento" id="validationDefault01" name="Usudoc2" value="<?php echo $fila['Usudoc']; ?>" required readonly>
  </div>
  <script>
    document.getElementById('doc').addEventListener('input', function(e) {
      var input = e.target;
      var value = input.value;
      // Eliminar cualquier carácter no numérico
      value = value.replace(/\D/g, '');
      // Aplicar la longitud mínima y máxima
      if (value.length < 7) {
        input.setCustomValidity('El Documento debe tener al menos 7 dígitos.');
      } else if (value.length > 10) {
        input.setCustomValidity('El Documento no puede tener más de 10 dígitos.');
      } else {
        input.setCustomValidity('');
      }
      input.value = value;
    });
  </script>
  <div class="input-group mb-3">
    <span for="validationDefault02" class="input-group-text">Usuario</span>
    <input type="text" class="form-control" id="validationDefault02" placeholder="Ingrese su Usuario" name="usuario2" value="<?php echo $fila['usuario']; ?>" required>
  </div>
  <div class="input-group mb-3">
    <span for="validationDefault03" class="input-group-text">Telefono</span>
    <input type="tel" class="form-control" name="tel2" id="tel2" placeholder="Ingrese su Telefono" value="<?php echo $fila['telefono']; ?>"  maxlength="10" required>
  </div>
  <script>
    document.getElementById('tel2').addEventListener('input', function(e) {
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
    <input type="password" class="form-control" name="password2" placeholder="Ingrese su Contraseña" id="validationDefault04" value="<?php echo $fila['password']; ?>" required>
  </div>
  <div class="input-group mb-3">
    <span for="validationDefault05" class="input-group-text">Foto</span>
    <input type="file" class="form-control" name="foto2" id="validationDefault05">
    <input type="hidden" name="foto_existente" value="<?php echo $fila['foto']; ?>">
  </div>
  <div class="input-group mb-3">
    <span class="input-group-text">Rol</span>
    <select class="form-select" name="cargo2" id="validationDefault06" required>
      <!-- Imprimir opción del rol actual fuera del bucle -->
      <option value="<?php echo $fila['rol']; ?>">Rol actual: <?php echo $fila['nombrerol']; ?></option>
      <option disabled>-- Seleccione el Rol a Actualizar --</option>
      <?php
      // Iniciar el bucle para las opciones adicionales
      while ($filas2 = $result2->fetch()) {
        // Omitir la impresión del rol actual dentro del bucle
        if ($filas2['cargoUsu'] != $fila['rol']) {
      ?>
          <option value="<?php echo $filas2['cargoUsu'] ?>"><?php echo $filas2['nombrerol'] ?></option>
        <?php
        }
      }
      if (!$filas2['cargoUsu']) {
        ?>
        <option disabled>No hay mas Roles disponibles</option>
      <?php
      }
      ?>
    </select>
  </div>

  <div class="modal-footer">
    <button class="btn btn-primary" type="submit">Guardar Cambios</button>
  </div>
</form>

<script src="Vista/js/java_.js"></script>
<script src="Vista/js/java.js"></script>