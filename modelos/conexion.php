<?php
 
class Conexion{
    private static $conexion = NULL;

    public function __construct(){}

    public static function conectar(){

         $host = '127.0.0.1';
         $dbname = 'chrono';
         $usuario = 'root';
         $contrasena = '';
         $port = '3306';

         
        $pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
        self::$conexion = new PDO("mysql:dbname=$dbname;host=$host;port=$port","$usuario","$contrasena",$pdo_options);
        return self::$conexion;
    }

    static function desconectar(&$conexion){
        $conexion = null;
    }
}

$baseDatos = Conexion::conectar();

?>
