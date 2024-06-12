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
    <link rel="stylesheet" href="Vista/jquery/jquery-ui-1.13.2.custom/jquery-ui-1.13.2.custom/jquery-ui.css">
    <script src="Vista/jquery/jquery-ui-1.13.2.custom/jquery-ui-1.13.2.custom/jquery-ui.js"></script>
    <script src="Vista/jquery/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


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
                                    <div class="pt-2 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">
                                            Cree una Cuenta
                                        </h5>
                                        <p class="text-center small">
                                            Ingrese sus datos para crear la Cuenta
                                        </p>
                                    </div>
                                    <?php
                                    if (isset($_GET["error"])) {
                                        $mensaje = "Error";
                                        if ($_GET["error"] == 1) {
                                    ?>
                                            <script>
                                                Swal.fire({
                                                    icon: "success",
                                                    title: "¡Registro Exitoso!",
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                });
                                            </script>
                                        <?php
                                        }
                                        if ($_GET["error"] == 2) {
                                        ?>
                                            <script>
                                                Swal.fire({
                                                    icon: "warning",
                                                    title: "¡El usuario ingresado se encuentra Registrado!",
                                                    showConfirmButton: false,
                                                    timer: 2000
                                                });
                                            </script>
                                        <?php
                                        }
                                        if ($_GET["error"] == 3) {
                                        ?>
                                            <script>
                                                Swal.fire({
                                                    icon: "error",
                                                    title: "Oops... ¡Error al registrar!",
                                                });
                                            </script>
                                        <?php
                                        }
                                        ?>

                                    <?php
                                    }
                                    ?>
                                    <form action="index.php?accion=registrar" method="post" class="row g-3" enctype="multipart/form-data">
                                        <div class="col-12">
                                            <label for="validationDefault01" class="form-label">Documento</label>
                                            <input type="text" class="form-control" id="doc" id="validationDefault01" name="Usudoc" minlength="6" maxlength="10" placeholder="Ingrese Documento" required>
                                        </div>
                                        <script>
                                            document.getElementById('doc').addEventListener('input', function(e) {
                                                var input = e.target;
                                                var value = input.value;
                                                // Eliminar cualquier carácter no numérico
                                                input.value = value.replace(/\D/g, '');
                                            });
                                        </script>
                                        <div class="col-12">
                                            <label for="validationDefault02" class="form-label">Usuario</label>
                                            <input type="text" class="form-control" id="validationDefault02" name="usuario" placeholder="Ingrese Usuario" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="validationDefault03" class="form-label">Teléfono</label>
                                            <input type="tel" class="form-control" name="tel" id="tel" id="validationDefault03" placeholder="Ingrese Teléfono" maxlength="10" required>
                                        </div>
                                        <script>
                                            document.getElementById('tel').addEventListener('input', function(e) {
                                                var input = e.target;
                                                var value = input.value;
                                                // Eliminar cualquier carácter no numérico
                                                input.value = value.replace(/\D/g, '');
                                            });
                                        </script>
                                        <div class="col-12">
                                            <label for="validationDefault04" class="form-label">Contraseña</label>
                                            <input type="password" class="form-control" name="password" id="validationDefault04" placeholder="Ingrese Contraseña" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="validationDefault05" class="form-label">Foto</label>
                                            <input type="file" class="form-control" name="foto" id="validationDefault05">
                                        </div>
                                        <div class="col-12">
                                            <label for="validationDefault06" class="form-label">Rol</label>
                                            <select class="form-select" id="cargo" name="cargo" id="validationDefault06" required>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary" type="submit">Registrar</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Ya Tienes Una Cuenta? <a href="index.php?accion=log">Accede a Ella</a></p>
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

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short">
        </i>
    </a>

    <script src="Vista/js/java_.js"></script>
    <script src="Vista/js/java.js"></script>
</body>

</html>