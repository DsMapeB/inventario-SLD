<?php
class Controlador
{
  public function verpagina($url)
  {
    require($url);
  }

  /**
   * Valida y guarda una imagen subida con un nombre único y una extensión segura.
   * Devuelve la ruta relativa (uploads/archivo.ext) o null si no es válida.
   */
  private function guardarImagenSubida($archivo, $rutaDestino = 'uploads/')
  {
    if (!is_array($archivo) || !isset($archivo['error']) || $archivo['error'] === UPLOAD_ERR_NO_FILE) {
      return null;
    }

    if ($archivo['error'] !== UPLOAD_ERR_OK) {
      return null;
    }

    if (empty($archivo['tmp_name']) || !is_uploaded_file($archivo['tmp_name'])) {
      return null;
    }

    // Se usa el tamaño real del archivo temporal, no el dato enviado por el navegador.
    $tamanoMaximo = 5 * 1024 * 1024; // 5 MB
    $tamanoReal = @filesize($archivo['tmp_name']);
    if ($tamanoReal === false || $tamanoReal <= 0 || $tamanoReal > $tamanoMaximo) {
      return null;
    }

    // Tipo MIME real del contenido, no el enviado por el navegador.
    $mime = null;
    if (class_exists('finfo')) {
      $finfo = new finfo(FILEINFO_MIME_TYPE);
      $mime = $finfo->file($archivo['tmp_name']);
    } elseif (function_exists('mime_content_type')) {
      $mime = mime_content_type($archivo['tmp_name']);
    }

    $permitidos = [
      'image/jpeg' => 'jpg',
      'image/png'  => 'png',
      'image/webp' => 'webp',
    ];

    if (!isset($permitidos[$mime])) {
      return null;
    }

    // Verificación adicional de que el contenido es realmente una imagen.
    $info = @getimagesize($archivo['tmp_name']);
    $tiposValidos = [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_WEBP];
    if ($info === false || !isset($info[2]) || !in_array($info[2], $tiposValidos, true)) {
      return null;
    }

    $directorio = rtrim($rutaDestino, '/\\') . DIRECTORY_SEPARATOR;
    if (!is_dir($directorio)) {
      if (!@mkdir($directorio, 0755, true) && !is_dir($directorio)) {
        return null;
      }
    }

    if (!is_writable($directorio)) {
      return null;
    }

    // Nombre aleatorio: no se usa el nombre original del usuario.
    try {
      $nombreArchivo = bin2hex(random_bytes(16)) . '.' . $permitidos[$mime];
    } catch (Exception $e) {
      return null;
    }

    $destino = $directorio . $nombreArchivo;

    if (!@move_uploaded_file($archivo['tmp_name'], $destino)) {
      return null;
    }

    @chmod($destino, 0644);

    return 'uploads/' . $nombreArchivo;
  }

  /**
   * Normaliza una ruta de imagen ya existente para evitar rutas externas
   * o contenido malicioso inyectado desde el formulario.
   */
  private function normalizarRutaFoto($ruta)
  {
    if (!is_string($ruta)) {
      return '';
    }

    $ruta = trim($ruta);

    if ($ruta === '' || strpos($ruta, '..') !== false) {
      return '';
    }

    // Permite nombres antiguos (espacios, acentos) pero sin barras ni rutas externas.
    if (!preg_match('#^uploads/[^/\\\\]+$#u', $ruta)) {
      return '';
    }

    if (preg_match('#[<>"\'\x00-\x1F]#', $ruta)) {
      return '';
    }

    return $ruta;
  }

  //------------------------------Login Y Registro---------------------------------
  public function login($user, $pass)
  {
    $gestor = new Gestor();
    $result = $gestor->login($user, $pass);
    if ($result != 1 && $result != 2 && $result != 3 && $result != 4 && $result != 5 && $result != 6) {
      // Evita fijación de sesión después de autenticar correctamente.
      session_regenerate_id(true);

      $_SESSION["telefono"] = $result[0];
      $_SESSION["usuario"] = $result[1];
      $_SESSION["rol"] = $result[2];
      $_SESSION["nombrerol"] = $result[3];
      $_SESSION["Usudoc"] = $result[4];
      $_SESSION["foto"] = $result[5] ?? '';
      header("Location:index.php?accion=inicio&error=1");
    }
    if ($result == 1) {
      header("Location:index.php?accion=log&error=1");
    }
    if ($result == 2) {
      header("Location:index.php?accion=log&error=2");
    }
  }

  public function logout()
  {
    // Destrucción completa de la sesión y de su cookie.
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
      $params = session_get_cookie_params();
      setcookie(session_name(), '', [
        'expires' => time() - 42000,
        'path' => $params["path"],
        'domain' => $params["domain"],
        'secure' => $params["secure"],
        'httponly' => $params["httponly"],
        'samesite' => $params["samesite"] ?? 'Lax',
      ]);
    }

    session_destroy();
    header("Location:index.php");
    exit;
  }

  public function registrar($doc, $usu, $tel, $pass, $foto, $rol)
  {
    $rutaFoto = $this->guardarImagenSubida($foto);
    $foto = $rutaFoto !== null ? $rutaFoto : '';

    $usu = new Usu($doc, $usu, $tel, $pass, $foto, $rol);
    $gestor = new Gestor();
    $result = $gestor->registrar($usu);

    if ($result == 1) {
      /***   Registro satisfactorio    ***/
      header("Location:index.php?accion=registro&error=1");
    }
    if ($result == 2) {
      /***   Usuario Repetido    ***/
      header("Location:index.php?accion=registro&error=2");
    }
    if ($result == 3) {
      /***   Error en registro    ***/
      header("Location:index.php?accion=registro&error=3");
    }
  }

  //----------------------------------Panel--------------------------------------\\
  public function Descarga_BD(){
    $gestor = new Gestor();
    $result = $gestor->DescargaBD();
  }

  public function Descarga_BDUC(){
    $gestor = new Gestor();
    $result = $gestor->DescargaBDUC();
  }

  public function consultarUsu()
  {
    $gestor = new Gestor();
    $result = $gestor->consultarUsu();
    require_once 'Vista/html/consultarUsu.php';
  }

  public function consultaTotal(){
    $gestor = new Gestor();
    $result = $gestor->consultaTotal();
    $result2 = $gestor->consultaTotalProvee();
    $result3 = $gestor->consultaTotalProduc();
    require_once 'Vista/html/cantIni.php';
  }

  public function agregarUsuario($doc, $usu, $tel, $pass, $foto, $rol)
  {
    $rutaFoto = $this->guardarImagenSubida($foto);
    $foto = $rutaFoto !== null ? $rutaFoto : '';

    $usuarios = new Usu($doc, $usu, $tel, $pass, $foto, $rol);
    $gestor = new Gestor();
    $result = $gestor->agregarUsuario($usuarios);
    if ($result == 1) {
      /***   Registro satisfactorio    ***/
      header("Location:index.php?accion=usuario&error=1");
    }
    if ($result == 2) {
      /***   Usuario Repetido    ***/
      header("Location:index.php?accion=usuario&error=2");
    }
    if ($result == 3) {
      /***   Error en registro    ***/
      header("Location:index.php?accion=usuario&error=3");
    }
  }

  public function editarUsu($doc)
  {
    $gestor = new Gestor();
    $result = $gestor->editarUsu($doc);
    $result2 = $gestor->consultarRol();
    require_once 'Vista/html/modalEditusu.php';
  }

  public function actualizarUsu($doc, $usu, $tel, $pass, $foto, $rol) {
    // Ruta de la imagen existente, validada antes de reutilizarla.
    $foto_existente = $this->normalizarRutaFoto($_POST["foto_existente"] ?? '');

    // Si se cargó una nueva imagen válida se usa; si no, se conserva la anterior.
    $foto_actualizada = $this->guardarImagenSubida($foto);
    if ($foto_actualizada === null) {
        $foto_actualizada = $foto_existente;
    }

    $usu = new Usu($doc, $usu, $tel, $pass, $foto_actualizada, $rol);
    $gestor = new Gestor();
    $result = $gestor->actualizarUsu($usu);
    
    if ($result == 1) {
        header("Location:index.php?accion=usuario&error2=1");
    } else {
        header("Location:index.php?accion=usuario&error2=2");
    }
}


  public function eliminarUsu($doc)
  {
    $gestor = new Gestor();
    $registro = $gestor->eliminarUsu($doc);
    if ($registro > 0) {
      echo "El Usuario se ha eliminado con exito";
    } else {
      echo "El Usuario no se ha podido eliminar";
    }
  }


  //------------------------------------- Perfil --------------------------------
  public function editarP()
  {
    $gestor = new Gestor();
    $result = $gestor->editarP();
    require_once 'Vista/html/modaleditPerfil.php';
  }

  public function actualizarPerfil($doc, $usuario, $tel, $pass, $foto, $rol)
  {
    // El documento de la sesión es la fuente de verdad, no el campo del formulario.
    $doc = $_SESSION['Usudoc'] ?? $doc;

    // Ruta de la imagen existente, validada antes de reutilizarla.
    $foto_existente = $this->normalizarRutaFoto($_POST["foto_existente"] ?? '');

    // Si se cargó una nueva imagen válida se usa; si no, se conserva la anterior.
    $foto_actualizada = $this->guardarImagenSubida($foto);
    if ($foto_actualizada === null) {
      $foto_actualizada = $foto_existente;
    }

    $usu = new Usu($doc, $usuario, $tel, $pass, $foto_actualizada, $rol);
    $gestor = new Gestor();
    $result = $gestor->actualizarPerfil($usu);
    if ($result == 1) {
      $_SESSION['Usudoc'] = $doc;
      $_SESSION['usuario'] = $usuario;
      $_SESSION['telefono'] = $tel;
      $_SESSION['foto'] = $foto_actualizada;
      // El rol no se modifica desde el perfil y nunca se guarda la contraseña en sesión.
      header("Location:index.php?accion=perfil&error=1");
    }
    if ($result == 2) {
      header("Location:index.php?accion=perfil&error=2");
    }
  }


  //----------------------------------------------------roles-----------------------------------------------------------------
  public function agregarRol($rol)
  {
    $rol1 = new Roles($rol);
    $gestor = new Gestor();
    $result = $gestor->agregarRol($rol1);
    if ($result == 1) {
      /***   Registro satisfactorio    ***/
      header("Location:index.php?accion=rol&error=1");
      exit;
    }
    if ($result == 2) {
      /***   Usuario Repetido    ***/
      header("Location:index.php?accion=rol&error=2");
      exit;
    }
    if ($result == 3) {
      /***   Error en registro    ***/
      header("Location:index.php?accion=rol&error=3");
      exit;
    }
  }

  public function consultarRol()
  {
    $gestor = new Gestor();
    $result = $gestor->consultarRol();
    require_once 'Vista/html/consultarRol.php';
  }

  public function editarRol($rol)
  {
    $gestor = new Gestor();
    $result = $gestor->editarRol($rol);
    require_once 'Vista/html/modaleditRol.php';
  }

  public function actualizarRol($rol, $num)
  {
    $nomrol = new Roles($rol);
    $gestor = new Gestor();
    $result = $gestor->actualizarRol($nomrol, $num);
    if ($result == 1) {
      header("Location:index.php?accion=rol&error2=1");
    }
    if ($result == 2) {
      header("Location:index.php?accion=rol&error2=2");
    }
  }

  public function eliminarRol($rol)
  {
    $gestor = new Gestor();
    $result = $gestor->eliminarRol($rol);
    if ($result > 0) {
      echo "El Rol se ha eliminado con éxito";
      exit; // Detiene la ejecución aquí si el rol se eliminó con éxito
    } else {
      echo "El Rol no se ha podido eliminar";
      exit; // Detiene la ejecución aquí si el rol no se pudo eliminar
    }
  }
}
