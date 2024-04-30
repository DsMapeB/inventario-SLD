<?php
if ($result->rowCount() > 0) {
?>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nit</th>
          <th scope="col">Nombre</th>
          <th scope="col">Contacto</th>
          <th scope="col">Telefono</th>
          <th scope="col">Dirección</th>
          <th scope="col">Ciudad</th>
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
            <td> <?php echo $fila->nitpro; ?></td>
            <td><?php echo $fila->nombrePro; ?></td>
            <td><?php echo $fila->contactoPro; ?></td>
            <td><?php echo $fila->telefonoPro; ?></td>
            <td><?php echo $fila->direccionPro; ?></td>
            <td><?php echo $fila->ciudadPro; ?></td>
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
    <p>No hay Proveedores registrados</p>
  <?php
}
  ?>
  </div>