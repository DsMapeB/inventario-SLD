<?php
class gestorcliente
{
    public function agregarcliente(cliente $cliente)
    {
        $conexion = new conexion();
        $doc_cli = $cliente->obtenerdocumento();
        $nombre_cli = $cliente->obtenernombre();
        $telefono_cli = $cliente->obtenertelefono();

        $sql2 = "SELECT * FROM cliente WHERE docclie=$doc_cli";
        $conexion->buscar_query($sql2);
        $validar = $conexion->obtener_filas();
        if ($validar > 0) {
            return 2;
        } else {
            $sql = "INSERT INTO cliente VALUES ('$doc_cli', '$nombre_cli', '$telefono_cli')";
            $result2 = $conexion->ejecutar_query($sql);
            if ($result2 > 0) {
                return 1;
            } else {
                return 3;
            }
        }
    }

    public function consultarCli()
    {
        $conexion = new conexion();
        $sql = "SELECT * FROM cliente";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function editarCli($docclie)
    {
        $conexion = new conexion();
        $sql = "SELECT * FROM cliente WHERE docclie = $docclie";
        $conexion->buscar_query($sql);
        $result = $conexion->obtener_resultado();
        return $result;
    }

    public function actualizarCli($cli)
    {
        $conexion = new conexion();
        $cliente = $cli;

        $doc_cli = $cliente->obtenerdocumento();
        $nombre_cli = $cliente->obtenernombre();
        $telefono_cli = $cliente->obtenertelefono();

        $sql = "UPDATE cliente SET nombreclie = '$nombre_cli' , telefonoclie = '$telefono_cli' WHERE docclie = '$doc_cli' ";
        $result = $conexion->ejecutar_query($sql);
        if ($result > 0) {
            return 1;
        } else {
            return 2;
        }
    }

    public function eliminarCli($cliente)
    {
        $conexion = new conexion();
        $sql = "DELETE FROM cliente WHERE docclie = ?";
        $params = array($cliente);
        $filasAfectadas = $conexion->ejecutar_query_preparado($sql, $params);
        return $filasAfectadas;
    }
}
