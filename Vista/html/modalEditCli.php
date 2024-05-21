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
        <input type="text" class="form-control" placeholder="Nombre del Producto" aria-label="Nombre" aria-describedby="basic-addon1" value="<?php echo $filas['nombreclie']; ?>" name="nombre" id="nombrecliente" >
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" for="registrartelefono">Telefono</span>
        <input type="text" class="form-control" placeholder="Telefono del Cliente" aria-label="Telefono" aria-describedby="basic-addon1" value="<?php echo $filas['telefonoclie']; ?>" name="telefono" id="telcliente" >
      </div>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
  </form>