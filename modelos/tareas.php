<?php

date_default_timezone_set('America/Mexico_City');

require_once('conexion.php');

class Tareas extends Conexion{
     
    private $idTarea;
    private $nombreTarea;
    private $fecha;
    private $hora;
    private $idEstadoTarea;
    private $idUsuario;
    
    

    public function __construct(){

    }


    public function setidTarea($idTarea){
        $this->idTarea = $idTarea;
    }
    public function getidTarea(){
        return $this->idTarea;
    }



    public function setnombreTarea($nombreTarea){
        $this->nombreTarea = $nombreTarea;
    }
    public function getnombreTarea(){
        return $this->nombreTarea;
    }



    public function setfecha($fecha){
        $this->fecha = $fecha;
    }
    public function getfecha(){
        return $this->fecha;
    }



    public function sethora($hora){
        $this->hora = $hora;
    }
    public function gethora(){
        return $this->hora;
    }



    public function setidEstadoTarea($idEstadoTarea){
        $this->idEstadoTarea = $idEstadoTarea;
    }
    public function getidEstadoTarea(){
        return $this->idEstadoTarea;
    }



    public function setidUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }
    public function getidUsuario(){
        return $this->idUsuario;
    }







    public function mostrarTareas(){
        $idUsuario = $_SESSION['idUsuario'];
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Definir el la sentencia sql
        //sql: Struct Query Language: Lenguaje Estructurado de Consulta
        if($_SESSION['idRol']==1){

            $sql = $baseDatos->query('SELECT tareas.*, estados_tareas.estado, usuarios.nombreDeUsuario FROM tareas INNER JOIN estados_Tareas ON (tareas.idEstadoTarea = estados_tareas.idEstadoTarea) INNER JOIN usuarios ON (tareas.idUsuario = usuarios.idUsuario) ORDER BY idTarea ASC');
        //Ejecutar la consulta
        }else{

            $sql = $baseDatos->query("SELECT tareas.*, estados_tareas.estado  FROM tareas INNER JOIN estados_Tareas ON (tareas.idEstadoTarea = estados_tareas.idEstadoTarea) WHERE idUsuario=$idUsuario ORDER BY idTarea DESC");
        }
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }


    public function mostrarTareasHoy(){
       
        $idUsuario = $_SESSION['idUsuario'];
        $fecha= (date('Y-m-d'));
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Definir el la sentencia sql
        //sql: Struct Query Language: Lenguaje Estructurado de Consulta
      
        $sql = $baseDatos->query("SELECT tareas.*, estados_tareas.estado, usuarios.nombreDeUsuario  FROM tareas INNER JOIN estados_Tareas ON (tareas.idEstadoTarea = estados_tareas.idEstadoTarea) INNER JOIN usuarios ON (tareas.idUsuario = usuarios.idUsuario) WHERE tareas.idUsuario=$idUsuario AND tareas.fecha= '$fecha' AND (tareas.idEstadoTarea = 1 OR tareas.idEstadoTarea = 2)  ORDER BY idTarea DESC");
       
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    

    public function listarEstado(){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Definir el la sentencia sql
        //sql: Struct Query Language: Lenguaje Estructurado de Consulta
        $sql = $baseDatos->query('SELECT * FROM estados_tareas');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function listarUsuario(){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Definir el la sentencia sql
        //sql: Struct Query Language: Lenguaje Estructurado de Consulta
        $sql = $baseDatos->query('SELECT * FROM usuarios');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function mostrarfecha(){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Definir el la sentencia sql
        //sql: Struct Query Language: Lenguaje Estructurado de Consulta
        $sql = $baseDatos->query('SELECT idTarea, fecha, hora, idUsuario FROM tareas WHERE idEstadoTarea = 2 OR idEstadoTarea = 1');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }  

    public function registrarTareas($tarea){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        
        //if($_SESSION['idRol']==1){
            $sql = $baseDatos->prepare('INSERT INTO tareas(idTarea,nombreTarea, fecha, hora, idUsuario) VALUES (:idTarea, :nombreTarea, :fecha, :hora, :idUsuario)');
            $sql->bindValue('idTarea', '');
            $sql->bindValue('nombreTarea', $tarea->getnombreTarea());
            $sql->bindValue('fecha', $tarea->getfecha());
            $sql->bindValue('hora', $tarea->gethora());
            $sql->bindValue('idUsuario', $tarea->getidUsuario());
            /*}else{
                $sql = $baseDatos->prepare('INSERT INTO tareas(idTarea,nombreTarea, fecha, hora, idUsuario) VALUES (:idTarea, :nombreTarea, :fecha, :hora, '.$_SESSION['idUsuario']);
            $sql->bindValue('idTarea', '');
            $sql->bindValue('nombreTarea', $tarea->getnombreTarea());
            $sql->bindValue('fecha', $tarea->getfecha());
            $sql->bindValue('hora', $tarea->gethora());
            }*/
        
    

        
        try{
            $sql->execute(); //Ejecutar el sql
            $mensaje =  "¡Registro exitoso!";
        }
        catch(Exception $e){
            $mensaje = $e->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::desconectar($baseDatos); //Cierra la conexión.
        return $mensaje;
    }


    public function buscarUsuarios($tarea){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Definir el la sentencia sql
        //sql: Struct Query Language: Lenguaje Estructurado de Consulta
        $sql = $baseDatos->query("SELECT * FROM usuarios 
               WHERE idUsuario=".$_SESSION['idUsuario']);
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return $sql->fetch();
        //return($sql->fetch()); //retornar todos los registros de la consulta.
    }
    

    public function buscarTareas($tarea){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Definir el la sentencia sql
        //sql: Struct Query Language: Lenguaje Estructurado de Consulta
        $sql = $baseDatos->query("SELECT * FROM tareas 
               WHERE idTarea=".$tarea->getidTarea());
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return $sql->fetch();
        //return($sql->fetch()); //retornar todos los registros de la consulta.
    }


    public function actualizarTareas($tarea){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        
        $sql = $baseDatos->prepare('UPDATE tareas 
        SET nombreTarea =:nombreTarea,  fecha =:fecha, hora =:hora, idEstadoTarea =:idEstadoTarea
        WHERE idTarea=:idTarea');
        $sql->bindValue('idTarea', $tarea->getidTarea());
        $sql->bindValue('nombreTarea', $tarea->getnombreTarea());
        $sql->bindValue('fecha', $tarea->getfecha());
        $sql->bindValue('hora', $tarea->gethora());
        $sql->bindValue('idEstadoTarea', $tarea->getidEstadoTarea());
       
        try{
            $sql->execute(); //Ejecutar el sql
            $mensaje =  "¡Actualización exitosa!";
        }
        catch(Exception $e){
            $mensaje = $e->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::desconectar($baseDatos); //Cierra la conexión.
        return $mensaje;
    }

       
    
    

    public function eliminarTarea($tarea){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('DELETE FROM tareas 
        WHERE idTarea=:idTarea');
        $sql->bindValue('idTarea', $tarea->getidTarea());
        try{
            $sql->execute(); //Ejecutar el sql
            $mensaje =  "¡Eliminación exitosa!";
        }
        catch(Exception $e){
            $mensaje = $e->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::desconectar($baseDatos); //Cierra la conexión.
        return $mensaje;
    }

    public function finalizarTarea($tarea){
        $idUsuario = $_SESSION['idUsuario'];
        //Establecer la conexión a la base dato s
        $baseDatos = Conexion::conectar();

            $sql = $baseDatos->prepare("UPDATE `tareas` SET `idEstadoTarea`= 4 WHERE  (idEstadoTarea = 1 OR  idEstadoTarea = 2) AND idTarea =:idTarea AND $idUsuario " );
            $sql->bindValue('idTarea', $tarea->getidTarea());
            try{
                $sql->execute(); //Ejecutar el sql
                echo "<script> window.location.href = window.location.href; </script>";
            }
            catch(Exception $e){
                $mensaje = $e->getMessage(); //Obtener el mensaje de error.
            }
    
        Conexion::desconectar($baseDatos); //Cierra la conexión.
        //return $mensaje; 

    }
 
}


?>