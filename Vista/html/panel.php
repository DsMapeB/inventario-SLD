<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Sistema de Gestion Online de Inventario - Panel</title>
    <link rel="shortcut icon" href="Vista/ico/favicon.ico" type="image/x-icon">
    <link href="Vista/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="Vista/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="Vista/css/main.css" rel="stylesheet">

</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.php" class="logo d-flex align-items-center me-auto">
                <img src="Vista/img/logo.png" alt="">
                <h1 class="sitename">SLD</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="index.php?accion=registro" class="">Registro</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="index.php?accion=log">Inicia Sesion</a>

        </div>
    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">
            <div class="hero-bg">
                <img src="Vista/img/hero-bg-light.webp" alt="">
            </div>
            <div class="container text-center">
                <div class="d-flex flex-column justify-content-center align-items-center">
                    <h1 data-aos="fade-up" class="">Bienvenidos a <span>SLD</span></h1>
                    <p data-aos="fade-up" data-aos-delay="100" class="">¡Bienvenidos al Sistema de Gestion Online de Inventario!<br>Este sistema te permitirá controlar de manera eficiente tus existencias, optimizar el flujo de productos y mejorar la gestión de tus activos.<br>¡Comencemos a maximizar la eficiencia y la rentabilidad de tu inventario juntos!<br></p>
                    <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
                        <a href="index.php?accion=registro" class="btn-get-started">¡Comencemos!</a>
                    </div>
                    <img src="Vista/img/logo2.png" class="img-fluid hero-img" alt="" data-aos="zoom-out" data-aos-delay="300">
                </div>
            </div>
        </section><!-- /Hero Section -->
    </main>

    <footer>
        <div class="container copyright text-center mt-2">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Sistema Gestion Online de
                    Inventario</strong><span>. Todos los Derechos Reservados</span></p>
            <div class="credits">
                Diseñado Por <a href="https://zajuna.sena.edu.co/">Estudiantes del SENA</a>
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="Vista/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="Vista/js/main.js"></script>

</body>

</html>