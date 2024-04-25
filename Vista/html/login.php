<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="shortcut icon" href="Vista/ico/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="Vista/bootstrap-5.3.3-dist/css/bootstrap.css">
    <script type="text/javascript" src="Vista/bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" type="text/css" href="Vista/css/estilos.css">
    <link rel="stylesheet" href="Vista/bootstrap-icons/bootstrap-icons.min.css">


</head>

<body id="ini">
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a href="index.php?accion=logout" class="logo d-flex align-items-center w-auto">
                                    <img src="Vista/img/logo.png" alt="">
                                    <span class="d-none d-lg-block ">Sistema Gestion de Inventario</span>
                                </a>
                            </div><!-- fin Logo -->

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">
                                            Ingrese a su Cuenta Personal
                                        </h5>
                                        <p class="text-center small">
                                            Ingrese su Usuario y Contraseña para Ingresar
                                        </p>
                                    </div>
                                    <?php
                                    if (isset($_GET["error"])) {
                                        $mensaje = "Error";
                                        if ($_GET["error"] == 1) {
                                            $mensaje = "¡La contraseña ingresada es incorrecta!";
                                        }
                                        if ($_GET["error"] == 2) {
                                            $mensaje = "¡El usuario ingresado no corresponde a ninguna cuenta!";
                                        }
                                    ?>
                                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                                            <div>
                                                <i class="bi bi-exclamation-triangle-fill"></i> <?php echo $mensaje; ?>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                    <form action="index.php?accion=login" method="post" class="row g-3 needs-validation" novalidate>
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Usuario
                                            </label>
                                            <div class="input-group has-validation">
                                                <!--  <span class="input-group-text" id="inputGroupPrepend">@</span>  -->
                                                <input type="text" name="user" class="form-control" id="yourUsername" required>
                                                <div class="invalid-feedback">
                                                    Por favor Ingrese Su Usuario
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">
                                                Contraseña
                                            </label>
                                            <input type="password" name="pass" class="form-control" id="yourPassword" required>
                                            <div class="invalid-feedback">
                                                Por favor Ingrese su Contraseña
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">
                                                Ingresar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>

</html>