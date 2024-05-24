<?php
if ($result->rowCount() > 0) {
?>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">C. de Venta</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">C. de Producto</th>
                    <th scope="col">Observaciones</th>
                    <th scope="col">Total</th>
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
                        <td><?php echo $fila->codventa; ?></td>
                        <td><?php echo $fila->fecha; ?></td>
                        <td><?php echo $fila->hora; ?></td>
                        <td><?php echo $fila->docUsu ?></td>
                        <td><?php echo $fila->docclie ?></td>
                        <td><?php echo $fila->codprodu; ?></td>
                        <td><?php echo $fila->observacion; ?></td>
                        <td><?php echo $fila->total; ?></td>
                        <td>
                            <button class="icon-button btn btn-warning" onclick="editarven(<?php echo $fila->codventa; ?>)" data-bs-toggle="modal" data-bs-target="#accventa"><i class="bi bi-pencil-square"></i> Editar</button>
                            <button class="icon-button btn btn-danger" onclick="eliminarventa(<?php echo $fila->codventa; ?>)"><i class="bi bi-trash3"></i> Eliminar</button>
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
        <br><p>No hay Ventas Registrados</p>
    <?php
}
    ?>
    </div>