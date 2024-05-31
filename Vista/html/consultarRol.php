<?php
if ($result->rowCount() > 0) {
?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre Rol</th>
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
                        <td><?php echo $fila->cargoUsu; ?></td>
                        <td><?php echo $fila->nombrerol; ?></td>
                        <td>
                            <button class="icon-button btn btn-warning" data-bs-toggle="modal" data-bs-target="#editUsu" onclick="editarUsuario(<?php echo $fila->docUsu; ?>)"><i class="bi bi-pencil-square"></i> Editar</button>
                            |
                            <button class="icon-button btn btn-danger" onclick="eliminarRole(<?php echo $fila->cargoUsu; ?>)"><i class="bi bi-trash3"></i> Eliminar</button>
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
        <p>No hay Roles Registrados</p>
    <?php
}
    ?>
    </div>