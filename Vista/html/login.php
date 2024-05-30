<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="shortcut icon" href="Vista/ico/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="Vista/bootstrap-5.3.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="Vista/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script type="text/javascript" src="Vista/bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" type="text/css" href="Vista/css/estilos.css">
    <link rel="stylesheet" href="Vista/bootstrap-icons/bootstrap-icons.min.css">
    <link rel="stylesheet" href="Vista/jquery/jquery-ui-1.13.2.custom/jquery-ui-1.13.2.custom/jquery-ui.css">
    <script src="Vista/jquery/jquery-ui-1.13.2.custom/jquery-ui-1.13.2.custom/jquery-ui.js"></script>
    <script src="Vista/jquery/jquery.js"></script>


</head>

<body id="ini">
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a href="index.php" class="logo d-flex align-items-center w-auto">
                                    <img src="Vista/img/logo.png" alt="">
                                    <span class="d-none d-lg-block ">Sistema Gestion Online de Inventario</span>
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
                                            <label for="validationDefault01" class="form-label">Usuario</label>
                                            <input type="text" class="form-control" id="validationDefault01" name="user" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="validationDefault01" class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" id="validationDefault01" name="pass" required>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">
                                                Ingresar
                                            </button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">No Tienes Una Cuenta? <a href="index.php?accion=registro">Create Una</a></p>
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

    <script src="Vista/js/java.js"></script>
    <script src="Vista/js/java_.js"></script>
</body>

</html>

<form class="row g-3">
    <div class="col-md-4">
        <label for="validationDefault01" class="form-label">First name</label>
        <input type="text" class="form-control" id="validationDefault01" value="Mark" required>
    </div>
    <div class="col-md-4">
        <label for="validationDefault02" class="form-label">Last name</label>
        <input type="text" class="form-control" id="validationDefault02" value="Otto" required>
    </div>
    <div class="col-md-4">
        <label for="validationDefaultUsername" class="form-label">Username</label>
        <div class="input-group">
            <span class="input-group-text" id="inputGroupPrepend2">@</span>
            <input type="text" class="form-control" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" required>
        </div>
    </div>
    <div class="col-md-6">
        <label for="validationDefault03" class="form-label">City</label>
        <input type="text" class="form-control" id="validationDefault03" required>
    </div>
    <div class="col-md-3">
        <label for="validationDefault04" class="form-label">State</label>
        <select class="form-select" id="validationDefault04" required>
            <option selected disabled value="">Choose...</option>
            <option>...</option>
        </select>
    </div>
    <div class="col-md-3">
        <label for="validationDefault05" class="form-label">Zip</label>
        <input type="text" class="form-control" id="validationDefault05" required>
    </div>
    <div class="col-12">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
            <label class="form-check-label" for="invalidCheck2">
                Agree to terms and conditions
            </label>
        </div>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Submit form</button>
    </div>
</form>