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
                        <td><?php echo $fila->precioprodu; ?></td>
                        <td><?php echo $fila->existenciaprodu; ?></td>
                        <td><?php echo $fila->nitprodu; ?></td>

                        <td><button>edit</button>
                            <button class="icon-button" onclick="eliminarprodu(<?php echo $fila->codprodu; ?>)"><i class="bi bi-trash3"></i></button>
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