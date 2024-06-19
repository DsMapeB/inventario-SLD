<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="shortcut icon" href="Vista/ico/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="Vista/bootstrap-5.3.3-dist/css/bootstrap.css">
    <script type="text/javascript" src="Vista/bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" type="text/css" href="Vista/css/estilos.css">
    <link rel="stylesheet" href="Vista/bootstrap-icons/bootstrap-icons.min.css">
    <link rel="stylesheet" href="Vista/jquery/jquery-ui-1.13.2.custom/jquery-ui-1.13.2.custom/jquery-ui.css">
    <script src="Vista/jquery/jquery-ui-1.13.2.custom/jquery-ui-1.13.2.custom/jquery-ui.js"></script>
    <script src="Vista/jquery/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php?accion=inicio" class="logo d-flex align-items-center">
                <img src="Vista/img/logo.webp" alt="">
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
                            <a class="dropdown-item d-flex align-items-center" href="Vista/manuales/MANUAL DE USU-ADMIN.pdf" download="MANUAL DE USU-ADMIN.pdf">
                                <i class="bi bi-question-circle"></i>
                                <span>¿Necesitas ayuda?</span>
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
                    <span>Trabajadores</span>
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
                    <li class="breadcrumb-item">Panel Principal</li>
                    <li class="breadcrumb-item">Info</li>
                </ol>
            </nav>
        </div><!--fin titulo de pagina -->

        <?php
        if (isset($_GET["error"])) {
            if ($_GET["error"] == 1) {
        ?>
                <script>
                    Swal.fire({
                        position: "top",
                        title: " Bienvenid@ <?php echo $_SESSION["usuario"]; ?>",
                        showConfirmButton: false,
                        timer: 1500
                    });
                </script>
        <?php
            }
        }
        ?>

        <div class="bienvenida">
            <h3 class="card-title w-100">Bienvenidos a su Sistema de Gestion Online de Inventario</h3>
            <p>
                ¡Bienvenidos al Sistema de Gestion Online de Inventario! Este sistema te permitirá controlar de manera eficiente tus existencias, optimizar el flujo de productos y mejorar la gestión de tus activos. ¡Comencemos a maximizar la eficiencia y la rentabilidad de tu inventario juntos!
            </p>
        </div><!--fin bienvenida -->

        <section id="cant" class="mai">
        </section><!--fin sobre el sistema -->

        <section class="somos ">
            <h2 class="card-titlem w-100">¿Quienes Somos?</h2>
            <p>En SLD estamos dedicados a revolucionar la gestión online de inventario a través de soluciones tecnológicas avanzadas y un enfoque centrado en el cliente. Nuestro equipo está comprometido con la excelencia en cada aspecto de nuestro trabajo, desde el desarrollo de software hasta el servicio al cliente, con el objetivo de ofrecer la mejor experiencia posible a nuestros usuarios.</p>
        </section><!--fin quienes somos -->

        <section class="mai">
            <h5 class="card-titlem w-100">Nuestra Vision y Mision con Nuestros clientes</h5>
            <p class="w-100">Controla, gestiona, triunfa: Tu inventario bajo control, en línea y sin complicaciones.</p>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-titlem">Nuestra Vision</h5>
                    <p class="card-text">Nos visualizamos como líderes en el campo de la gestión de inventario online, proporcionando a nuestros clientes las herramientas más avanzadas y eficientes para administrar sus existencias de manera óptima. Buscamos ser reconocidos por nuestra innovación, fiabilidad y capacidad para adaptarnos a las necesidades cambiantes del mercado. Nos esforzamos por ofrecer soluciones integrales que impulsen el crecimiento y la eficiencia de las empresas en todo el mundo.</p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-titlem">Nuestros Valores</h5>
                    <p class="card-text">Nos vemos como la vanguardia en el ámbito de los Sistemas de Gestión Online de Inventario, comprometidos en proporcionar a nuestros usuarios las herramientas más avanzadas y eficaces para manejar sus existencias de manera óptima. Nos esforzamos por ser reconocidos por nuestros valores fundamentales de innovación, confiabilidad y capacidad para adaptarnos a las cambiantes necesidades del mercado. Nuestra misión es ofrecer soluciones integrales que impulsen el crecimiento y la eficiencia de las empresas en todo el mundo, asegurando un camino hacia el éxito empresarial.</p>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-titlem">Nuestra Mision</h5>
                    <p class="card-text">Nuestra misión es simplificar y optimizar la gestión de inventario para empresas de todos los tamaños, brindando un sistema online accesible, intuitivo y completo. Nos comprometemos a ofrecer herramientas que permitan a nuestros clientes tener un control preciso y en tiempo real de sus existencias, reduciendo costos, minimizando pérdidas y mejorando la eficiencia operativa. Nos esforzamos por proporcionar un servicio de alta calidad, respaldado por un equipo comprometido y orientado al cliente, con el objetivo de impulsar el éxito y el crecimiento de nuestros usuarios.</p>
                </div>
            </div>
        </section><!--fin vision mision -->


        <div class="carr">
            <button type="button" class="btn btn-success" id="btn" onclick="fundadores()">
                <i class="bi bi-person-raised-hand"></i> Conocenos
            </button>
        </div>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short">
        </i>
    </a>

    <script src="Vista/js/java.js"></script>
    <script src="Vista/js/java_.js"></script>

    <script>
        consultaTotal();
    </script>
</body>

</html>