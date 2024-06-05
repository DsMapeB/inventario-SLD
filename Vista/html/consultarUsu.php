<?php
if ($result->rowCount() > 0) {
?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Contraseña</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Rol</th>
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
                        <td><?php echo !empty($fila->Usudoc) ? $fila->Usudoc : 'Sin documento'; ?></td>
                        <td><?php echo !empty($fila->usuario) ? $fila->usuario : 'Sin usuario'; ?></td>
                        <td><?php echo !empty($fila->password) ? $fila->password : 'Sin contraseña'; ?></td>
                        <td>
                            <?php if (!empty($fila->foto)) { ?>
                                <img src="<?php echo $fila->foto; ?>" alt="Foto de perfil" style="max-width: 100px; max-height: 100px;">
                            <?php } else { ?>
                                Sin foto de perfil
                            <?php } ?>
                        </td>
                        <td><?php echo !empty($fila->nombrerol) ? $fila->nombrerol : 'Sin rol'; ?></td>
                        <td>
                            <button class="icon-button btn btn-warning" data-bs-toggle="modal" data-bs-target="#editUsu" onclick="editarUsuario(<?php echo $fila->Usudoc; ?>)"><i class="bi bi-pencil-square"></i> Editar</button>
                            |
                            <button class="icon-button btn btn-danger" onclick="eliminarUsu(<?php echo $fila->Usudoc; ?>)"><i class="bi bi-trash3"></i> Eliminar</button>
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
