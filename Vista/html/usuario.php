<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="shortcut icon" href="Vista/ico/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="Vista/bootstrap-5.3.3-dist/css/bootstrap.css">
    <script type="text/javascript" src="Vista/bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" type="text/css" href="Vista/css/estilos.css">
    <link rel="stylesheet" href="Vista/bootstrap-icons/bootstrap-icons.min.css">
    <link rel="stylesheet" href="Vista/jquery/jquery-ui-1.13.2.custom/jquery-ui-1.13.2.custom/jquery-ui.css">
    <script src="Vista/jquery/jquery-ui-1.13.2.custom/jquery-ui-1.13.2.custom/jquery-ui.js"></script>
    <script src="Vista/jquery/jquery.js"></script>

</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php?accion=inicio" class="logo d-flex align-items-center">
                <img src="Vista/img/logo.png" alt="">
                <span class="d-none d-lg-block">Sistema Gestion Online de Inventario</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Titulo Icon -->


        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?php echo $_SESSION["foto"]; ?>" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION["usuario"]; ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo $_SESSION["usuario"]; ?></h6>
                            <span><?php echo $_SESSION["nombrerol"]; ?></span><br>
                            <span><?php date_default_timezone_set('America/Bogota');
                                    $dia = date("d/m/y");
                                    echo "Ibague, ", $dia;
                                    ?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="index.php?accion=perfil">
                                <i class="bi bi-person"></i>
                                <span>Mi Perfil</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="index.php?accion=logout">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Salir</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header>
    <!-- fin header -->
    <aside id="sidebar" class="sidebar">
        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="index.php?accion=inicio">
                    <i class="bi bi-grid"></i>
                    <span>Inicio</span>
                </a>
            </li><!-- End Inicio -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="index.php?accion=usuario">
                    <i class="bi bi-person "></i>
                    <span>Usuarios</span>
                </a>
            </li><!-- End Usuario -->

            <?php if (isset($_SESSION["nombrerol"]) && $_SESSION["nombrerol"] === "Administrador") : ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="index.php?accion=rol">
                        <i class="bi bi-person-rolodex"></i>
                        <span>Roles</span>
                    </a>
                </li><!-- End rol -->
            <?php endif; ?>

            <li class="nav-item">
                <a class="nav-link collapsed" href="index.php?accion=cliente">
                    <i class="bi bi-people"></i>
                    <span>Clientes</span>
                </a>
            </li>
            <!-- End Cliente -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="index.php?accion=provee">
                    <i class="bi bi-building"></i>
                    <span>Proveedores</span>
                </a>
            </li>

            </li><!-- End Proveedor -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="index.php?accion=produ">
                    <i class="bi bi-boxes"></i>
                    <span>Productos</span>
                </a>
            </li>
            </li><!-- End Productos -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="index.php?accion=venta">
                    <i class="bi bi-cart3"></i>
                    <span>Ventas</span>
                </a>
            </li>
        </ul>
    </aside><!-- End Sidebar-->

    <main class="main" id="main">

        <div class="pagetitle">
            <h1>Información General</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php?accion=inicio">Inicio</a></li>
                    <li class="breadcrumb-item">Usuarios</li>
                    <li class="breadcrumb-item">Info</li>
                </ol>
            </nav>
        </div><!--fin titulo de pagina -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Tabla Usuarios</h5>
                            <p>Aca podras encontrar toda la informacion sobre tus usuarios</p>

                            <?php
                            if (isset($_GET["error"])) {
                                $mensaje = "Error";
                                if ($_GET["error"] == 1) {
                                    $mensaje = "¡Registro Exitoso!";
                            ?>
                                    <div class="alert alert-success d-flex align-items-center" role="alert">
                                        <div>
                                            <i class="bi bi-check-lg"></i>
                                            <?php echo $mensaje; ?>
                                        </div>
                                    </div>
                                <?php
                                }
                                if ($_GET["error"] == 2) {
                                    $mensaje = "¡El usuario ingresado se encuentra Registrado!";
                                ?>
                                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                                        <div>
                                            <i class="bi bi-exclamation-triangle-fill"></i>
                                            <?php echo $mensaje; ?>
                                        </div>
                                    </div>
                                <?php
                                }
                                if ($_GET["error"] == 3) {
                                    $mensaje = "¡Error al Agregar!";
                                ?>
                                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                                        <div>
                                            <i class="bi bi-exclamation-triangle-fill"></i>
                                            <?php echo $mensaje; ?>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>

                            <?php
                            }
                            ?>
                            <?php
                            if (isset($_GET["error2"])) {
                                $mensaje = "Error2";
                                if ($_GET["error2"] == 1) {
                                    $mensaje = "¡Actualizacion de Usuario Exitosa!";
                            ?>
                                    <div class="alert alert-success d-flex align-items-center" role="alert">
                                        <div>
                                            <i class="bi bi-check-lg"></i>
                                            <?php echo $mensaje; ?>
                                        </div>
                                    </div>
                                <?php
                                }
                                if ($_GET["error2"] == 2) {
                                    $mensaje = "¡Error al Actualizar, Vuelva a Intentar!";
                                ?>
                                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                                        <div>
                                            <i class="bi bi-exclamation-triangle-fill"></i>
                                            <?php echo $mensaje; ?>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalusuario">
                                <i class="bi bi-person-fill-add"></i> Agregar Nuevo Usuario
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modalusuario" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Agregar Usuario</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="index.php?accion=ingresarusuario" method="post" class="row g-3">
                                                <div class="col-12">
                                                    <label for="validationDefault01" class="form-label">Documento</label>
                                                    <input type="text" class="form-control" id="validationDefault01" name="Usudoc" required>
                                                </div>
                                                <div class="col-12">
                                                    <label for="validationDefault02" class="form-label">Usuario</label>
                                                    <input type="text" class="form-control" id="validationDefault02" name="usuario" required>
                                                </div>
                                                <div class="col-12">
                                                    <label for="validationDefault03" class="form-label">Contraseña</label>
                                                    <input type="password" class="form-control" name="password" id="validationDefault03" required>
                                                </div>
                                                <div class="col-12">
                                                    <label for="validationDefault04" class="form-label">Foto</label>
                                                    <input type="file" class="form-control" name="foto" id="validationDefault04">
                                                </div>
                                                <div class="col-12">
                                                    <label for="validationDefault05" class="form-label">Rol</label>
                                                    <select class="form-select" id="cargo" name="cargo" required>
                                                    </select>
                                                </div>
                                                <div class="col-12">
                                                    <button class="btn btn-primary" type="submit">Registrar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="Usuario"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="modal fade" id="editUsu" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Editar Usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="modaleditusu"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="Vista/js/java.js"></script>
    <script src="Vista/js/java_.js"></script>

    <script>
        consultarUsu();
    </script>
</body>

</html>