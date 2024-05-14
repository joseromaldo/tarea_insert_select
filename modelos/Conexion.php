<?php

abstract class Conexion{
    protected static $conexion = null;

    protected static function connectar() : PDO{
        try {
            self::$conexion = new PDO("informix:host=host.docker.internal; service=9088;database=clientes server=informix; protocol=onsoctcp;EnableScrollableCursors=1", "informix", "in4mix");
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "No hay conexion a la BD";
            echo "<br>";
            echo $e->getMessage();
            self::$conexion = null;
            return null;
            exit;
        }

        return self::$conexion;
    }

    // METODO PARA EJECUTAR SENTENCIAS SQL

    public function ejecutar($sql){
        $conexion = self::connectar();
        $sentencia = $conexion->prepare($sql);
        $resultado = $sentencia->execute();
        $idInsertado = $conexion->lastInsertId();
        self::$conexion = null;

        return [
            "resultado" => $resultado,
            "id" => $idInsertado
        ];
        
    }

    // METODO PARA CONSULTAR INFORMACION
    public function servir($sql){
        $conexion = self::connectar();
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute();
        $data = $sentencia->fetchAll(PDO::FETCH_ASSOC);
        $datos = [];
        foreach ($data as $k => $v) {
            $datos[] = array_change_key_case($v, CASE_LOWER);
        }
        self::$conexion = null;

        return $datos;
        
    }
}