<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    <link rel="shortcut icon" href="Vista/ico/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="Vista/bootstrap-5.3.3-dist/css/bootstrap.css">
    <script type="text/javascript" src="Vista/bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" type="text/css" href="Vista/css/estilos.css">
    <link rel="stylesheet" href="Vista/bootstrap-icons/bootstrap-icons.min.css">
</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="index.php?accion=inicio" class="logo d-flex align-items-center">
                <img src="Vista/img/logo.png" alt="">
                <span class="d-none d-lg-block">Sistema Gestion de Inventario</span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Titulo Icon -->


        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <li class="nav-item dropdown">

                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                        <i class="bi bi-bell"></i>
                        <span class="badge bg-primary badge-number">4</span>
                    </a><!-- End Notification Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header">
                            Tienes 4 nuevas notificaciones
                            <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">ver todo</span></a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-exclamation-circle text-warning"></i>
                            <div>
                                <h4>Lorem Ipsum</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>30 min. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-x-circle text-danger"></i>
                            <div>
                                <h4>Atque rerum nesciunt</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>1 hr. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-check-circle text-success"></i>
                            <div>
                                <h4>Sit rerum fuga</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>2 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li class="notification-item">
                            <i class="bi bi-info-circle text-primary"></i>
                            <div>
                                <h4>Dicta reprehenderit</h4>
                                <p>Quae dolorem earum veritatis oditseno</p>
                                <p>4 hrs. ago</p>
                            </div>
                        </li>

                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="#">Mostrar todas las notificaciones</a>
                        </li>

                    </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->

                <!-- End Messages Nav -->

                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="Vista/img/fotom.png" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION["usuario"]; ?></span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo $_SESSION["usuario"]; ?></h6>
                            <span>Administrador</span><br>
                            <span><?php date_default_timezone_set('America/Bogota');
                                    $dia = date("d/m/y");
                                    echo "Ibague, ", $dia;
                                    ?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-person"></i>
                                <span>Mi Perfil</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-gear"></i>
                                <span>Configuraciones</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
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
                    <span>Usuarios</span>
                </a>
            </li><!-- End Usuario -->

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


        <div class="mai2 w-100">
            <div class="mai21 ">
                <h3 class="card-title">Bienvenidos a su Sistema de Gestion Online de Inventario</h3>
                <p class="w-100">
                    ¡Bienvenidos al Sistema de Gestion Online de Inventario! Este sistema te permitirá controlar de manera eficiente tus existencias, optimizar el flujo de productos y mejorar la gestión de tus activos. ¡Comencemos a maximizar la eficiencia y la rentabilidad de tu inventario juntos!
                </p>
            </div>
        </div><!--fin bienvenida -->

        <section class="mai">
            <h5 class="card-titlem w-100">Sobre el Sistema de Gestion Online de Inventario</h5>
            <p class="w-100">Aca te mostraremos todo lo que puede traer Nuestro sistema online de Inventario </p>
            <div class="card" style="width: 18rem;">
                <img src="Vista/img/usua.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-titlem">Usuarios</h5>
                    <p class="card-text">En la seccion de Usuarios podras ver todos los Usuarios Inscritos por el Administrador</p>
                    <a href="index.php?accion=usuario" class="btn btn-primary">Seccion Usuarios</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="Vista/img/provee.png" class="card-img-top" alt="..." height="171.65px" width="448px">
                <div class="card-body">
                    <h5 class="card-titlem">Proveedores</h5>
                    <p class="card-text">En la seccion de Proveedores podras ver todos los proveedores que te suministran la tienda</p>
                    <a href="index.php?accion=provee" class="btn btn-primary">Seccion Proveedores</a>
                </div>
            </div>
            <div class="card" style="width: 18rem;">
                <img src="Vista/img/produ.png" class="card-img-top" alt="..." height="171.65px">
                <div class="card-body">
                    <h5 class="card-titlem">Productos</h5>
                    <p class="card-text">En la seccion de Productos podras ver todos los productos en adquisicion en tu tienda</p>
                    <a href="index.php?accion=produ" class="btn btn-primary">Seccion Productos</a>
                </div>
            </div>
        </section><!--fin sobre el sistema -->

        <section class="somos w-100">
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
                    <h5 class="card-titlem">Nuestra Mision</h5>
                    <p class="card-text">Nuestra misión es simplificar y optimizar la gestión de inventario para empresas de todos los tamaños, brindando un sistema online accesible, intuitivo y completo. Nos comprometemos a ofrecer herramientas que permitan a nuestros clientes tener un control preciso y en tiempo real de sus existencias, reduciendo costos, minimizando pérdidas y mejorando la eficiencia operativa. Nos esforzamos por proporcionar un servicio de alta calidad, respaldado por un equipo comprometido y orientado al cliente, con el objetivo de impulsar el éxito y el crecimiento de nuestros usuarios.</p>
                </div>
            </div>
        </section><!--fin vision mision -->


        <div class="carr w-100">
            <div id="carouselExampleCaptions" class="carousel slide">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="Vista/img/fotom.png" class=" w-100" alt="">
                        <div class="carousel-caption d-none d-md-block ">
                            <h5>Fundador/Creador de SLD</h5>
                            <p>Mi nombre es Santiago Mape y soy Creador del Sistema de Gestion Online de Inventario SLD</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="Vista/img/laug.png" class="d-block w-100" alt="...">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Fundadora/Creadora de SLD</h5>
                            <p>Mi nombre es Laura Medina y soy Creadora del Sistema de Gestion Online de Inventario SLD</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bg-black" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon bg-black" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </main>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short">
        </i>
    </a>

    <script src="Vista/js/java.js"></script>
</body>

</html>