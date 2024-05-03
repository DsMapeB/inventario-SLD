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
                        <td><button class="icon-button"><i class="bi bi-trash3"></button></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    <?php
} else {
    ?>
        <p>No hay Clientes registrados</p>
    <?php
}
    ?>
    </div>