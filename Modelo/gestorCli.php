<?php
class GestorCliente
{
    public function agregarcliente(Cliente $cliente)
    {
        $conexion = new Conexion();
        $doc_cli = $cliente->obtenerdocumento();
        $nombre_cli = $cliente->obtenernombre();
        $telefono_cli = $cliente->obtenertelefono();

        $sql2 = "SELECT docclie FROM cliente WHERE docclie = ? LIMIT 1";
        $stmt = $conexion->buscar_query_preparado($sql2, [$doc_cli]);
        $validar = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($validar) {
            return 2;
        }

        $sql = "INSERT INTO cliente (docclie, nombreclie, telefonoclie) VALUES (?, ?, ?)";
        $result2 = $conexion->ejecutar_query_preparado($sql, [$doc_cli, $nombre_cli, $telefono_cli]);
        if ($result2 > 0) {
            return 1;
        } else {
            return 3;
        }
    }

    public function consultarCli()
    {
        $conexion = new Conexion();
        $sql = "SELECT * FROM cliente";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function editarCli($docclie)
    {
        $conexion = new Conexion();
        $sql = "SELECT docclie, nombreclie, telefonoclie FROM cliente WHERE docclie = ? LIMIT 1";
        $stmt = $conexion->buscar_query_preparado($sql, [$docclie]);
        return $stmt;
    }

    public function actualizarCli($cli)
    {
        $conexion = new Conexion();
        $cliente = $cli;

        $doc_cli = $cliente->obtenerdocumento();
        $nombre_cli = $cliente->obtenernombre();
        $telefono_cli = $cliente->obtenertelefono();

        $sql = "UPDATE cliente SET nombreclie = ?, telefonoclie = ? WHERE docclie = ?";
        $result = $conexion->ejecutar_query_preparado($sql, [$nombre_cli, $telefono_cli, $doc_cli]);
        if ($result > 0) {
            return 1;
        } else {
            return 2;
        }
    }

    public function eliminarCli($cliente)
    {
        $conexion = new Conexion();
        $sql = "DELETE FROM cliente WHERE docclie = ?";
        $params = array($cliente);
        $filasAfectadas = $conexion->ejecutar_query_preparado($sql, $params);
        return $filasAfectadas;
    }
}
