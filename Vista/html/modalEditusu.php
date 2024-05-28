<?php $filas = $result->fetch(); ?>
<form action="index.php?accion=actualizarUsuario" method="POST" id="agregarusuario" novalidate>
  <div class="input-group mb-3">
    <span class="input-group-text" id="docUsuario2">Documento</span>
    <input type="text" class="form-control" placeholder="Numero de Documento" aria-label="Numero Documento" aria-describedby="basic-addon1" value="<?php echo $filas['docUsu']; ?>" readonly id="docUsuario2" name="docUsuario2">
  </div>
  <div class="input-group mb-3">
    <span class="input-group-text" id="nombreUsuario2">Nombre</span>
    <input type="text" class="form-control" placeholder="Nombre" aria-label="Nombre" aria-describedby="basic-addon1" value="<?php echo $filas['nombreUsu']; ?>" id="nombreUsuario2" name="nombreUsuario2">
  </div>
  <div class="input-group mb-3">
    <span class="input-group-text" id="passUsuario2">Contraseña</span>
    <input class="form-control" placeholder="Contraseña" aria-label="Contraseña" aria-describedby="basic-addon1" value="<?php echo $filas['contraseñaUsu']; ?>" id="passUsuario2" name="passUsuario2">
  </div>
  <div class="input-group mb-3">
    <span class="input-group-text" id="telUsuario2">Telefono</span>
    <input type="text" class="form-control" placeholder="Numero de Telefono" aria-label="Telefono" aria-describedby="basic-addon1" value="<?php echo $filas['telefonoUsu']; ?>" id="telUsuario2" name="telUsuario2">
  </div>
  <div class="input-group mb-3">
    <span class="input-group-text" id="ciudadUsuario2">Ciudad</span>
    <input type="text" class="form-control" placeholder="Ciudad" aria-label="Ciudad" aria-describedby="basic-addon1" value="<?php echo $filas['ciudadUsu']; ?>" id="ciudadUsuario2" name="ciudadUsuario2">
  </div>
  <div class="input-group mb-3">
    <span class="input-group-text" id="direcUsuario2">Dirección</span>
    <input type="text" class="form-control" placeholder="Direccion" aria-label="Direccion" aria-describedby="basic-addon1" value="<?php echo $filas['direccionUsu']; ?>" id="direcUsuario2" name="direcUsuario2">
  </div>
  <div class="input-group mb-3">
    <span class="input-group-text" for="inputGroupSelect01">Tipo de Cargo</span>
    <select class="form-select" id="rol2" name="rol2">
      <option value="<?php echo $filas['cargoUsu']; ?>"><?php echo $filas['nombrerol']; ?></option>
    </select>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
  </div>
</form>

<script src="Vista/js/java_.js"></script>
<script src="Vista/js/java.js"></script>