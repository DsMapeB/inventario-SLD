<!-- Modal -->
<?php $filas = $result->fetch(); ?>
<form action="index.php?accion=actualizarProveedor" method="POST">
  <div class="modal-body">
    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1">Nit</span>
      <input type="text" class="form-control" placeholder="Nit del proveedor" aria-label="Ciudad" aria-describedby="basic-addon1" value="<?php echo $filas['nitpro']; ?>" id="nitprovee" name="nitprovee" readonly>
    </div>
    <script>
      document.getElementById('nitprovee').addEventListener('input', function(e) {
        var input = e.target;
        var value = input.value;
        // Eliminar cualquier carácter no numérico
        value = value.replace(/\D/g, '');
        // Aplicar la longitud mínima y máxima
        if (value.length < 7) {
          input.setCustomValidity('El Nit debe tener al menos 7 dígitos.');
        } else if (value.length > 10) {
          input.setCustomValidity('El Nit no puede tener más de 10 dígitos.');
        } else {
          input.setCustomValidity('');
        }
        input.value = value;
      });
    </script>
    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1">Proveedor</span>
      <input type="text" class="form-control" placeholder="Nombre del Proveedor" aria-label="Nombre" aria-describedby="basic-addon1" value="<?php echo $filas['nombrePro']; ?>" id="nombreprovee" name="nombreprovee" required>
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1">Contacto</span>
      <input type="text" class="form-control" placeholder="Nombre completo del contacto" aria-label="contacto" aria-describedby="basic-addon1" value="<?php echo $filas['contactoPro']; ?>" aria-describedby="basic-addon1" id="contactoprovee" name="contactoprovee" required>
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text" for="inputGroupSelect01">Telefono</span>
      <input type="text" class="form-control" id="telefono" name="telprovee" placeholder="Numero de Telefono" aria-label="Telefono" aria-describedby="basic-addon1" maxlength="10" value="<?php echo $filas['telefonoPro']; ?>" required>
    </div>
    <script>
      document.getElementById('telefono').addEventListener('input', function(e) {
        var input = e.target;
        var value = input.value;
        // Eliminar cualquier carácter no numérico
        value = value.replace(/\D/g, '');
        // Aplicar la longitud mínima y máxima
        if (value.length < 7) {
          input.setCustomValidity('El Telefono debe tener al menos 7 dígitos.');
        } else if (value.length > 10) {
          input.setCustomValidity('El Telefono no puede tener más de 10 dígitos.');
        } else {
          input.setCustomValidity('');
        }
        input.value = value;
      });
    </script>
    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1">Dirección</span>
      <input type="text" class="form-control" placeholder="Direccion" aria-label="Direccion" aria-describedby="basic-addon1" value="<?php echo $filas['direccionPro']; ?>" id="direcprovee" name="direcprovee" required>
    </div>
    <div class="input-group mb-3">
      <span class="input-group-text" id="basic-addon1">Ciudad</span>
      <input type="text" class="form-control" placeholder="Ciudad" aria-label="Ciudad" aria-describedby="basic-addon1" value="<?php echo $filas['ciudadPro']; ?>" id="ciuprovee" name="ciuprovee" required>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
  </div>
</form>