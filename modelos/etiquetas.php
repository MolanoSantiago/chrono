<?php
require_once('conexion.php');

class etiqueta extends Conexion{
    //Definir los atributos
    private $idEtiqueta;
    private $etiqueta;

    //Definir el constructor
    
    public function __construct(){

    }
    


    public function setidEtiqueta($idEtiqueta){
        $this->idEtiqueta = $idEtiqueta;
    }
    public function getidEtiqueta(){
        return $this->idEtiqueta;
    }


    public function setetiqueta($etiqueta){
        $this->etiqueta = $etiqueta;
    }
    public function getetiqueta(){
        return $this->etiqueta;
    }
   



    public function listaretiqueta(){
        
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Definir el la sentencia sql
        //sql: Struct Query Language: Lenguaje Estructurado de Consulta
        $sql = $baseDatos->query('SELECT * FROM etiquetas ORDER BY idEtiqueta ASC');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function registraretiqueta($etiquetaNueva){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('INSERT INTO etiquetas(idEtiqueta, etiqueta) VALUES(:idEtiqueta, :etiqueta)');
        $sql->bindValue('idEtiqueta', '');
        $sql->bindValue('etiqueta', $etiquetaNueva -> getetiqueta());

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
    
    public function buscaretiqueta($etiquetaNueva){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Definir el la sentencia sql
        //sql: Struct Query Language: Lenguaje Estructurado de Consulta
        $sql = $baseDatos->query("SELECT * FROM etiquetas WHERE idEtiqueta= ".$etiquetaNueva ->getidEtiqueta());
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return $sql->fetch();
        //return($sql->fetch()); //retornar todos los registros de la consulta.
    }

    public function actualizaretiqueta($etiquetaNueva){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('UPDATE etiquetas
        SET etiqueta =:etiqueta
        WHERE idEtiqueta=:idEtiqueta');
        $sql->bindValue('idEtiqueta', $etiquetaNueva->getidEtiqueta());
        $sql->bindValue('etiqueta', $etiquetaNueva->getetiqueta());
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

    public function eliminaretiqueta($etiquetaNueva){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('DELETE FROM etiquetas
        WHERE idEtiqueta=:idEtiqueta');
        $sql->bindValue('idEtiqueta', $etiquetaNueva->getidEtiqueta());
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
 
}
?>