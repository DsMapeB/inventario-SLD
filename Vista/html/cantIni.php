<h5 class="card-titlem w-100">Sobre el Sistema de Gestion Online de Inventario</h5>
<p class="w-100">Aca te mostraremos todo lo que puede traer Nuestro sistema online de Inventario </p>
<div class="card" style="width: 18rem;">
    <img src="Vista/img/traba.webp" class="card-img-top" alt="..." height="200px" width="448px">
    <div class="card-body">
        <h5 class="card-titlem">Trabajadores</h5>
        <?php if (isset($result) && $result->rowCount() > 0) : ?>
            <div class="divh6">
                <h6 id="h6Cant">
                    <?php while ($filas = $result->fetch()) : ?>
                        <?php echo $filas["cantUsu"]; ?>
                    <?php endwhile; ?>
                </h6>
            </div>
        <?php else : ?>
            <h6>No se encontraron resultados.</h6>
        <?php endif; ?>

        <p class="card-text">En la seccion de Trabajadores podras ver todos los que estan Inscritos por el Administrador y/o se registraron.</p>
        <a href="index.php?accion=usuario" class="btn btn-primary">Seccion Usuarios</a>
    </div>
</div>
<div class="card" style="width: 18rem;">
    <img src="Vista/img/prove.webp" class="card-img-top" alt="..." height="200px" width="448px">
    <div class="card-body">
        <h5 class="card-titlem">Proveedores</h5>
        <?php if (isset($result2) && $result2->rowCount() > 0) : ?>
            <div class="divh6">
                <h6 id="h6Cant">
                    <?php while ($filas2 = $result2->fetch()) : ?>
                        <?php echo $filas2["cantProve"]; ?>
                    <?php endwhile; ?>
                </h6>
            </div>
        <?php else : ?>
            <h6>No se encontraron resultados.</h6>
        <?php endif; ?>
        <p class="card-text">En la seccion de Proveedores podras ver todos los que proveedores te suministran la tienda.</p>
        <a href="index.php?accion=provee" class="btn btn-primary">Seccion Proveedores</a>
    </div>
</div>
<div class="card" style="width: 18rem;">
    <img src="Vista/img/produ.webp" class="card-img-top" alt="..." height="200px">
    <div class="card-body">
        <h5 class="card-titlem">Productos</h5>
        <?php if (isset($result3) && $result3->rowCount() > 0) : ?>
            <div class="divh6">
                <h6 id="h6Cant">
                    <?php while ($filas3 = $result3->fetch()) : ?>
                        <?php echo $filas3["cantProdu"]; ?>
                    <?php endwhile; ?>
                </h6>
            </div>
        <?php else : ?>
            <h6>No se encontraron resultados.</h6>
        <?php endif; ?>
        <p class="card-text">En esta sección podras ver todos los Productos en adquisicion en tu tienda para añadirlos las Ventas de tus Clientes.</p>
        <a href="index.php?accion=produ" class="btn btn-primary">Seccion Productos</a>
    </div>
</div>