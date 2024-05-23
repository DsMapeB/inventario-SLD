<form action="index.php?accion=ingresarusuario" method="POST" id="agregarusuario" novalidate>
  <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Documento</span>
    <input type="text" class="form-control" placeholder="Numero de Documento" aria-label="Nombre" aria-describedby="basic-addon1" id="docUsuario" name="docUsuario">
  </div>
  <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Nombre</span>
    <input type="text" class="form-control" placeholder="Nombre" aria-label="Nombre" aria-describedby="basic-addon1" id="nombreUsuario" name="nombreUsuario">
  </div>
  <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Contraseña</span>
    <input type="password" class="form-control" placeholder="Contraseña" aria-label="Contraseña" aria-describedby="basic-addon1" id="passUsuarios" name="passUsuario">
  </div>
  <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Telefono</span>
    <input type="text" class="form-control" placeholder="Numero de Telefono" aria-label="Telefono" aria-describedby="basic-addon1" id="telUsuario" name="telUsuario">
  </div>
  <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Ciudad</span>
    <input type="text" class="form-control" placeholder="Ciudad" aria-label="Ciudad" aria-describedby="basic-addon1" id="ciudadUsuario" name="ciudadUsuario">
  </div>
  <div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">Dirección</span>
    <input type="text" class="form-control" placeholder="Direccion" aria-label="Direccion" aria-describedby="basic-addon1" id="direcUsuario" name="direcUsuario">
  </div>
  <div class="input-group mb-3">
    <label for="formFile" class="form-label"></label>
    <input class="form-control" type="file" id="fotoUsuario" name="fotoUsuario">
  </div>
  <div class="input-group mb-3">
    <label class="input-group-text" for="inputGroupSelect01">Tipo de Cargo</label>
    <select class="form-select" id="rol" name="cargoUsuario">
    </select>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
  </div>
</form>