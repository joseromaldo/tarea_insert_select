<?php
require 'Conexion.php';

class Clientes extends Conexion{
    public $cliente_id;
    public $cliente_nombre;
    public $cliente_telefono;
    public $cliente_situacion;


    public function __construct($args = [])
    {
        $this->cliente_id = $args['cliente_id'] ?? null;
        $this->cliente_nombre = $args['cliente_nombre'] ?? '';
        $this->cliente_telefono = $args['cliente_telefono'] ?? 0.00;
        $this->cliente_situacion = $args['cliente_situacion'] ?? 1;
    }

    // METODO PARA INSERTAR
    public function guardar(){
        $sql = "INSERT into clientes (cliente_nombre, cliente_telefono) values ('$this->cliente_nombre','$this->cliente_telefono')";
        $resultado = $this->ejecutar($sql);
        return $resultado; 
    }
    
    // METODO PARA CONSULTAR

    public static function buscarTodos(...$columnas){
        // $cols = '';
        // if(count($columnas) > 0){
        //     $cols = implode(',', $columnas) ;
        // }else{
        //     $cols = '*';
        // }
        $cols = count($columnas) > 0 ? implode(',', $columnas) : '*';
        $sql = "SELECT $cols FROM productos where cliente_situacion = 1 ";
        $resultado = self::servir($sql);
        return $resultado;
    }

    public function buscar(...$columnas){
        $cols = count($columnas) > 0 ? implode(',', $columnas) : '*';
        $sql = "SELECT $cols FROM clientes where cliente_situacion = 1 ";

        if($this->cliente_nombre != ''){
            $sql .= " AND cliente_nombre like '%$this->cliente_nombre%' ";
        }
        if($this->cliente_telefono != ''){
            $sql .= " AND cliente_telefono = $this->cliente_telefono  ";
        }
        $resultado = self::servir($sql);
        return $resultado;
    }
}