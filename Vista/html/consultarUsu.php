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
                    <th scope="col">Telefono</th>
                    <th scope="col">Contraseña</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Rol</th>
                    <?php if (isset($_SESSION["nombrerol"]) && $_SESSION["nombrerol"] === "Administrador") : ?>
                        <th scope="col">Acciones</th>
                    <?php endif; ?>
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
                        <td><?php echo $fila->Usudoc ; ?></td>
                        <td><?php echo $fila->usuario ; ?></td>
                        <td><?php echo $fila->telefono ; ?></td>
                        <td><?php
                            if (isset($_SESSION["nombrerol"]) && $_SESSION["nombrerol"] === "Administrador") {
                                echo !empty($fila->password) ? $fila->password : 'Sin contraseña';
                            } else {
                                echo !empty($fila->password) ? str_repeat("*", strlen($fila->password)) : 'Sin contraseña';
                            }
                            ?>
                        </td>
                        <td>
                            <?php if (!empty($fila->foto)) { ?>
                                <img src="<?php echo $fila->foto; ?>" alt="Foto de perfil" style="max-width: 100px; max-height: 100px;">
                            <?php } else { ?>
                                Sin foto de perfil
                            <?php } ?>
                        </td>
                        <td><?php echo $fila->nombrerol ?></td>
                        <td>
                            <?php if (isset($_SESSION["nombrerol"]) && $_SESSION["nombrerol"] === "Administrador") : ?>
                                <button class="icon-button btn btn-warning" data-bs-toggle="modal" data-bs-target="#editUsu" onclick="editarUsuario(<?php echo $fila->Usudoc; ?>)"><i class="bi bi-pencil-square"></i> Editar</button>
                                |
                                <button class="icon-button btn btn-danger" onclick="eliminarUsu('<?php echo $fila->Usudoc; ?>' , '<?php echo $fila->usuario; ?>')"><i class="bi bi-trash3"></i> Eliminar</button>
                            <?php endif; ?>
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