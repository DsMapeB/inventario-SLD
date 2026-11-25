
<?php

class Conexion {

    private static $db_host = null;
    private static $db_user = null;
    private static $db_password = null;
    private static $db_port = null;
    private static $db_ssl_ca = null;

    protected $db_name = "sld";

    private $conn;

    public $resultado;
    public $filas;

    public function __construct() {
        // Si no existen variables de entorno, utiliza Laragon.
        self::$db_host = getenv('DB_HOST') ?: 'localhost';
        self::$db_user = getenv('DB_USER') ?: 'root';
        self::$db_password = getenv('DB_PASSWORD') ?: '';
        self::$db_port = getenv('DB_PORT') ?: '3306';
        self::$db_ssl_ca = getenv('DB_SSL_CA') ?: '';
    }

    private function abrir_conexion() {
        try {

            $dsn = "mysql:host=" . self::$db_host .
                   ";port=" . self::$db_port .
                   ";dbname=" . $this->db_name .
                   ";charset=utf8mb4";

            $opciones = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ];

            // Activar SSL cuando se proporciona el certificado CA.
            if (!empty(self::$db_ssl_ca)) {
                $opciones[PDO::MYSQL_ATTR_SSL_CA] = self::$db_ssl_ca;

                if (defined('PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT')) {
                    $opciones[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = true;
                }
            }

            $this->conn = new PDO(
                $dsn,
                self::$db_user,
                self::$db_password,
                $opciones
            );

        } catch (PDOException $e) {

            error_log("Error de conexión a la base de datos: " . $e->getMessage());

            die("No fue posible conectar con la base de datos.");
        }
    }

    private function cerrar_conexion() {
        $this->conn = null;
    }


    /**
     * Ejecuta una consulta SQL que no recibe datos variables del usuario.
     * Se conserva por compatibilidad con el resto de la aplicación.
     */
    public function buscar_query($sql) {

        $this->abrir_conexion();

        try {
            $this->resultado = $this->conn->query($sql);
            $this->filas = $this->resultado ? $this->resultado->rowCount() : 0;

            return $this->resultado;

        } catch (PDOException $e) {
            $this->cerrar_conexion();

            error_log("Error en consulta: " . $e->getMessage());

            die("Error al consultar la base de datos.");
        }
    }

public function buscar_query_preparado($sql, $params) {

    $this->abrir_conexion();

    try {
        $this->resultado = $this->conn->prepare($sql);
        $this->resultado->execute($params);
        $this->filas = $this->resultado->rowCount();

        return $this->resultado;

    } catch (PDOException $e) {
        $this->cerrar_conexion();

        error_log("Error en consulta preparada: " . $e->getMessage());

        die("Error al consultar la base de datos.");
    }
}

    public function obtener_resultado() {
        return $this->resultado;
    }

    public function obtener_filas() {
        return $this->filas;
    }

    public function ejecutar_query($sql) {

        $this->abrir_conexion();

        try {
            $result = $this->conn->exec($sql);
            return $result;

        } catch (PDOException $e) {
            error_log("Error al ejecutar consulta: " . $e->getMessage());
            die("Error al ejecutar la operación.");

        } finally {
            $this->cerrar_conexion();
        }
    }

    public function ejecutar_query_preparado($sql, $params) {

        $this->abrir_conexion();

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);

            return $stmt->rowCount();

        } catch (PDOException $e) {
            error_log("Error en consulta preparada: " . $e->getMessage());
            die("Error al ejecutar la operación.");

        } finally {
            $this->cerrar_conexion();
        }
    }

    public function __destruct() {
        $this->cerrar_conexion();
    }
}

?>
