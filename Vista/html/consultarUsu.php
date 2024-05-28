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
                    <th scope="col">Contraseña</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Ciudad</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Tipo de cargo</th>
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
                        <td><?php echo $fila->docUsu; ?></td>
                        <td><?php echo $fila->nombreUsu; ?></td>
                        <td><?php echo $fila->contraseñaUsu; ?></td>
                        <td><?php echo $fila->telefonoUsu; ?></td>
                        <td><?php echo $fila->ciudadUsu ?></td>
                        <td><?php echo $fila->direccionUsu ?></td>
                        <td><?php echo $fila->nombrerol; ?></td>
                        <td>
                            <button class="icon-button btn btn-warning" data-bs-toggle="modal" data-bs-target="#editUsu" onclick="editarUsuario(<?php echo $fila->docUsu; ?>)"><i class="bi bi-pencil-square"></i> Editar</button><br>
                            <br><button class="icon-button btn btn-danger" onclick="eliminarusu(<?php echo $fila->docUsu; ?>)"><i class="bi bi-trash3"></i> Eliminar</button>
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
        <p>No hay Usuarios Registrados</p>
    <?php
}
    ?>
    </div>