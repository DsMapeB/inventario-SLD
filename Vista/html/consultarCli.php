<?php
if ($result->rowCount() > 0) {
?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cont = 0;
                while ($fila = $result->fetch(PDO::FETCH_OBJ)) {
                    $cont++;
                ?>
                    <tr>
                        <th scope="row"><?php echo $cont ?></th>
                        <td> <?php echo $fila->docclie; ?></td>
                        <td><?php echo $fila->nombreclie; ?></td>
                        <td><?php echo $fila->telefonoclie; ?></td>
                        <td>
                            <button class="icon-button" data-bs-toggle="modal" data-bs-target="#editcli" href="index.php?accion=editarCli"><i class=" bi bi-pencil-square"></i></button>
                            <button class="icon-button" onclick="eliminarcli(<?php echo $fila->docclie; ?>)"><i class="bi bi-trash3"></i></button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
} else {
    ?>
        <br>
        <p>No hay Clientes registrados</p>
    <?php
}
    ?>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editcli" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Cliente</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <?php $filas = $result2->fetch(PDO::FETCH_OBJ); ?>
                    <form action="index.php?accion=actualizarCliente" method="POST" id="agregarcliente">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Actualizar Nuevo Cliente</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <input type="text" id="registrardocumento" value="<?php echo $filas['docclie']; ?>" name="documento">
                                <label class="label" for="registrardocumento">Documento</label>
                            </div>
                            <div class="input-group mb-3">
                            <input type="text" id="registrarnombre" value="<?php echo $filas['nombreclie']; ?>" name="nombre">
                                <label class="label" for="registrarnombre">Nombre</label>
                            </div>
                            <div class="input-group mb-3">
                            <input type="text" id="registrartelefono" value="<?php echo $filas['telefonoclie']; ?>" name="telefono">
                                <label class="label" for="registrartelefono">Telefono</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>