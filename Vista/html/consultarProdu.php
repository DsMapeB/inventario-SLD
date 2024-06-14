<?php
if ($result->rowCount() > 0) {
?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Existencia</th>
                    <th scope="col">Proveedor</th>
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
                        <td><?php echo $fila->codprodu; ?></td>
                        <td><?php echo $fila->nombreprodu; ?></td>
                        <?php $fila->precioprodu; 
                        $fila2 = $fila->precioprodu;
                        $formateado = number_format((float)$fila2, 3, '.', '');?>
                        <td><?php echo $formateado; ?></td>
                        <td><?php echo $fila->existenciaprodu; ?></td>
                        <td><?php echo $fila->nombrePro; ?></td>
                        <td>
                            <button class="icon-button btn btn-warning" data-bs-toggle="modal" data-bs-target="#editProdu" onclick="editarprodu(<?php echo $fila->codprodu; ?>)"><i class="bi bi-pencil-square"></i> Editar</button>
                            |
                            <button class="icon-button btn btn-danger" onclick="eliminarprodu('<?php echo $fila->codprodu; ?>' , '<?php echo $fila->nombreprodu; ?>')"><i class="bi bi-trash"></i> Eliminar</button>
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
        <p>No hay Productos Registrados</p>
    <?php
}
    ?>
    </div>