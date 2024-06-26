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
                        <td><?php echo $fila->docclie; ?></td>
                        <td><?php echo $fila->nombreclie; ?></td>
                        <td><?php echo $fila->telefonoclie; ?></td>
                        <td>
                            <div class="d-flex flex-column gap-2">
                                <button class="icon-button btn btn-warning" data-bs-toggle="modal" data-bs-target="#editcli" onclick="editarcli(<?php echo $fila->docclie; ?>)">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </button>
                                <button class="icon-button btn btn-danger" onclick="eliminarcli('<?php echo $fila->docclie; ?>' , '<?php echo $fila->nombreclie; ?>')">
                                    <i class="bi bi-trash3"></i> Eliminar
                                </button>
                            </div>
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