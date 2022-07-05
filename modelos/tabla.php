<?php 
require_once('conexion.php');

class tabla{

    
    public function __construct(){

    }

    public function mostrartabla(){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Definir el la sentencia sql
        //sql: Struct Query Language: Lenguaje Estructurado de Consulta
        $sql = $baseDatos->query("SELECT us.nombreDeUsuario, es.etiqueta, UE.*, COUNT(ta.idTarea) AS 'Cantidad' FROM tareas ta, etiquetas es, usuarios_etiquetas UE, usuarios us WHERE ta.idUsuario = us.idUsuario AND us.idUsuario = UE.idUsuario AND UE.idEtiqueta = es.idEtiqueta AND ta.idEstadoTarea = 3 GROUP BY UE.idUsuarioEtiqueta ORDER BY Cantidad DESC");
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function mostrarPerfil(){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Definir el la sentencia sql
        //sql: Struct Query Language: Lenguaje Estructurado de Consulta
        $sql = $baseDatos->query('SELECT us.*, COUNT(ta.idTarea) AS  "Cantidad de Tareas", ta.idEstadoTarea FROM  usuarios us, tareas ta where idEstadoTarea=3 AND ta.idUsuario=us.idUsuario GROUP BY ta.idUsuario ORDER BY COUNT(ta.idTarea) DESC');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    
}
?>