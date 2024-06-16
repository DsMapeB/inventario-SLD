<?php $fila = $result->fetch(); ?>
<form action="index.php?accion=actualizarUsuario" method="post" enctype="multipart/form-data">
  <div class="input-group mb-3">
    <span for="validationDefault01" class="input-group-text">Documento</span>
    <input type="text" class="form-control" id="validationDefault01" name="Usudoc2" value="<?php echo $fila['Usudoc']; ?>" required readonly>
  </div>
  <div class="input-group mb-3">
    <span for="validationDefault02" class="input-group-text">Usuario</span>
    <input type="text" class="form-control" id="validationDefault02" name="usuario2" value="<?php echo $fila['usuario']; ?>" required>
  </div>
  <div class="input-group mb-3">
    <span for="validationDefault03" class="input-group-text">Telefono</span>
    <input type="tel" class="form-control" name="tel2" id="validationDefault03" value="<?php echo $fila['telefono']; ?>" required>
  </div>
  <div class="input-group mb-3">
    <span for="validationDefault04" class="input-group-text">Contraseña</span>
    <input type="password" class="form-control" name="password2" id="validationDefault04" value="<?php echo $fila['password']; ?>" required>
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

      <?php
      // Iniciar el bucle para las opciones adicionales
      while ($filas2 = $result2->fetch()) {
        // Omitir la impresión del rol actual dentro del bucle
        if ($filas2['cargoUsu'] != $fila['rol']) {
      ?>
          <option disabled>-- Seleccione el Rol a Actualizar --</option>
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