  <!-- Modal -->
  <?php $filas = $result2->fetch(); ?>
  <form action="index.php?accion=actualizarCliente" method="POST" id="agregarcliente">
    <div class="modal-body">
      <div class="input-group mb-3">
        <span class="input-group-text" for="registrardocumento">Documento</span>
        <input type="text" class="form-control" placeholder="Documento del Cliente" aria-label="Documento" aria-describedby="basic-addon1" value="<?php echo $filas['docclie']; ?>" name="documento" readonly id="doccliente">
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" for="registrarnombre">Nombre</span>
        <input type="text" class="form-control" placeholder="Nombre del Cliente" aria-label="Nombre" aria-describedby="basic-addon1" value="<?php echo $filas['nombreclie']; ?>" name="nombre" id="nombrecliente">
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" for="registrartelefono">Telefono</span>
        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono del Cliente" maxlength="10" value="<?php echo $filas['telefonoclie']; ?>">
      </div>
      <script>
        document.getElementById('telefono').addEventListener('input', function(e) {
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
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </div>
  </form>