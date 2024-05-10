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
                        <td><?php echo $fila->telefonoUsu; ?></td>
                        <td><?php echo $fila->ciudadUsu ?></td>
                        <td><?php echo $fila->direccionUsu ?></td>
                        <td><?php echo $fila->cargoUsu; ?></td>

                        <td>
                            <button>edit</button>
                            <button class="icon-button" onclick="eliminarusu(<?php echo $fila->docUsu; ?>)"><i class="bi bi-trash3"></i></button>
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
        <br><p>No hay usuarios Registrados</p>
    <?php
}
    ?>
    </div>