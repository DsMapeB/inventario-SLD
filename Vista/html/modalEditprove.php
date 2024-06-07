  <!-- Modal -->
  <?php $filas = $result->fetch(); ?>
  <form action="index.php?accion=actualizarProveedor" method="POST">
    <div class="modal-body">
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Nit</span>
        <input type="text" class="form-control" placeholder="Nit del proveedor" aria-label="Ciudad" aria-describedby="basic-addon1" value="<?php echo $filas['nitpro']; ?>" id="nitprovee" name="nitprovee" readonly>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Proveedor</span>
        <input type="text" class="form-control" placeholder="Nombre del Proveedor" aria-label="Nombre" aria-describedby="basic-addon1"
        value="<?php echo $filas['nombrePro']; ?>" id="nombreprovee" name="nombreprovee">
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Contacto</span>
        <input type="text" class="form-control" placeholder="Nombre completo del contacto" aria-label="contacto" aria-describedby="basic-addon1" value="<?php echo $filas['contactoPro']; ?>" aria-describedby="basic-addon1" id="contactoprovee" name="contactoprovee">
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" for="inputGroupSelect01">Telefono</span>
        <input type="text" class="form-control" placeholder="Numero de Telefono" aria-label="Telefono" aria-describedby="basic-addon1" value="<?php echo $filas['telefonoPro']; ?>" id="telprovee" name="telprovee">
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Dirección</span>
        <input type="text" class="form-control" placeholder="Direccion" aria-label="Direccion" aria-describedby="basic-addon1" value="<?php echo $filas['direccionPro']; ?>" id="direcprovee" name="direcprovee">
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Ciudad</span>
        <input type="text" class="form-control" placeholder="Ciudad" aria-label="Ciudad" aria-describedby="basic-addon1" value="<?php echo $filas['ciudadPro']; ?>" id="ciuprovee" name="ciuprovee">
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
  </form>