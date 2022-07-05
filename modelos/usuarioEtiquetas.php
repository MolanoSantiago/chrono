<?php
require_once('conexion.php');

class usuarioEtiqueta{
    private $idUsuarioEtiqueta;
    private $idUsuario;//pedido
    private $idEtiqueta;//producto
    private $etiqueta;
   

    public function __construct(){

    }

    public function setidUsuarioEtiqueta($idUsuarioEtiqueta){
        $this->idUsuarioEtiqueta = $idUsuarioEtiqueta;
    }
    public function getidUsuarioEtiqueta(){
        return $this->idUsuarioEtiqueta;
    }




    public function setidUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }
    public function getidUsuario(){
        return $this->idUsuario;
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









    public static function mostrarUE(){
        $idUsuario = $_SESSION['idUsuario'];
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Definir el la sentencia sql
        //sql: Struct Query Language: Lenguaje Estructurado de Consulta
        if($_SESSION['idRol']==1){
            $sql = $baseDatos->query("SELECT UE.*, eti.etiqueta, us.nombreDeUsuario  FROM usuarios_etiquetas UE, etiquetas eti, usuarios us  WHERE UE.idEtiqueta=eti.idEtiqueta AND  UE.idUsuario=us.idUsuario ORDER BY idUsuarioEtiqueta DESC" );
        }else{
            $sql = $baseDatos->query("SELECT UE.*, eti.etiqueta  FROM usuarios_etiquetas UE, etiquetas eti  WHERE UE.idUsuario =$idUsuario AND UE.idEtiqueta=eti.idEtiqueta ORDER BY idUsuarioEtiqueta DESC" );
        }
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function mostrarUsuario(){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Definir el la sentencia sql
        //sql: Struct Query Language: Lenguaje Estructurado de Consulta
        $sql = $baseDatos->query('SELECT * FROM usuarios ORDER BY idUsuario DESC');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }

    public function mostrarEtiqueta(){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Definir el la sentencia sql
        //sql: Struct Query Language: Lenguaje Estructurado de Consulta
        $sql = $baseDatos->query('SELECT * FROM etiquetas ORDER BY idEtiqueta DESC');
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return($sql->fetchAll()); //retornar todos los registros de la consulta.
    }
    
    public function registrarUE($UsuarioEtiqueta){
        
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare("INSERT INTO 
        usuarios_etiquetas(idUsuarioEtiqueta, idEtiqueta, idUsuario)
        VALUES(:idUsuarioEtiqueta,:idEtiqueta,:idUsuario) ");
        $sql->bindValue('idUsuarioEtiqueta', '');
        $sql->bindValue('idEtiqueta', $UsuarioEtiqueta->getidEtiqueta());
        $sql->bindValue('idUsuario', $UsuarioEtiqueta->getidUsuario());
        
        //INSERT INTO usuarios_etiquetas(idUsuarioEtiqueta,idUsuario,idEtiqueta) VALUES(:idUsuarioEtiqueta,:idUsuario,now());');
        try{
            $sql->execute(); //Ejecutar el sql
            $mensaje = "Registro exitoso";
        }
        catch(Exception $e){
            $mensaje = "Hubo un error"; //Obtener el mensaje de error.
        }
        Conexion::desconectar($baseDatos); //Cierra la conexión.
        return $mensaje;
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
            $mensaje =  "Registro Exitoso";

        }
        catch(Exception $e){
            $mensaje = $e->getMessage(); //Obtener el mensaje de error.
        }
       
        Conexion::desconectar($baseDatos); //Cierra la conexión.
        return $mensaje;
    }



    public function buscarUE($UsuarioEtiqueta){
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Definir el la sentencia sql
        //sql: Struct Query Language: Lenguaje Estructurado de Consulta
        $sql = $baseDatos->query("SELECT * FROM usuarios_etiquetas WHERE idUsuarioEtiqueta= ".$UsuarioEtiqueta ->getidusuarioEtiqueta());
        //Ejecutar la consulta
        $sql->execute();
        Conexion::desconectar($baseDatos);
        return $sql->fetch();
        //return($sql->fetch()); //retornar todos los registros de la consulta.
    }




    public function actualizarUE($UsuarioEtiqueta){

        $mensaje = "";

        $baseDatos = Conexion::conectar();

        $sql = $baseDatos -> prepare('UPDATE usuarios_etiquetas SET  idEtiqueta=:idEtiqueta, idUsuario=:idUsuario WHERE idUsuarioEtiqueta = :idUsuarioEtiqueta');

        $sql->bindValue('idUsuarioEtiqueta',$UsuarioEtiqueta->getidUsuarioEtiqueta());
        
        $sql->bindValue('idEtiqueta',$UsuarioEtiqueta->getidEtiqueta());
        $sql->bindValue('idUsuario',$UsuarioEtiqueta->getidUsuario());

        try{
            $sql-> execute();
            $mensaje = "Actualización exitosa :)";
        
        }
        catch(Exception $e){
            $mensaje= $e ->getMessage();
        }

        Conexion::desconectar($baseDatos);
        return $mensaje;

    }

    public function eliminarUE($UsuarioEtiqueta){
        $mensaje = "";
        //Establecer la conexión a la base datos
        $baseDatos = Conexion::conectar();
        //Preparar la sentencia sql
        $sql = $baseDatos->prepare('DELETE FROM usuarios_etiquetas WHERE idUsuarioEtiqueta =:idUsuarioEtiqueta');

        $sql->bindValue('idUsuarioEtiqueta', $UsuarioEtiqueta->getidUsuarioEtiqueta());
        try{
            $sql->execute(); //Ejecutar el sql
            $mensaje =  "Eliminación exitosa :)";
        }
        catch(Exception $e){
            $mensaje = $e->getMessage(); //Obtener el mensaje de error.
        }
        Conexion::desconectar($baseDatos); //Cierra la conexión.
        return $mensaje;
    }
}

?>