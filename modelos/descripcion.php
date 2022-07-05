<?php
 require_once('Conexion.php');


class descripcion{

    private $idUsuario;
    private $nombre;
    private $correo;
    private $password;
    private $username;
    private $descripcion;
    private $idRol;
    private $idEstadoUsuario;

    
    
    public function __construct(){
     }




    public function setidUsuario($idUsuario){
        $this->idUsuario = $idUsuario;
    }

    public function getidUsuario(){
        return $this-> idUsuario;
    }




    public function setdescripcion($descripcion){
        $this -> descripcion = $descripcion;
    }

    public function getdescripcion(){
        return $this -> descripcion;
    }



    public function setnombre($nombre){
        $this->nombre = $nombre;
    }

    public function getnombre(){
        return $this-> nombre;
    }



    public function setcorreo($correo){
        $this->correo = $correo;
    }

    public function getcorreo(){
        return $this-> correo;
    }




    public function setpassword($password){
        $this->password = $password;
    }

    public function getpassword(){
        return $this-> password;
    }




    public function setusername($username){
        $this->username = $username;
    }

    public function getusername(){
        return $this-> username;
    }



    public function setidRol($idRol){
        $this->idRol = $idRol;
    }

    public function getidRol(){
        return $this-> idRol;
    }



    public function setidEstadoUsuario($idEstadoUsuario){
        $this->idEstadoUsuario = $idEstadoUsuario;
    }

    public function getidEstadoUsuario(){
        return $this-> idEstadoUsuario;
    }



    public function listardescripcion(){
        $idUsuario = $_SESSION['idUsuario'];
        
        $baseDatos = Conexion::conectar();

        $sql = $baseDatos -> query("SELECT idUsuario,descripcion FROM usuarios WHERE idUsuario =$idUsuario");

        $sql -> execute();
        
        $baseDatos = Conexion::desconectar($baseDatos);

        return ($sql->fetchAll());
    }

    

    public function buscardescripcion($descrip){

        $idUsuario = $_SESSION['idUsuario'];
        
        $baseDatos = Conexion::conectar();

        $sql = $baseDatos -> query("SELECT idUsuario,descripcion FROM usuarios WHERE idUsuario =$idUsuario");

        $sql -> execute();
        
        Conexion::desconectar($baseDatos);

        return ($sql->fetch());
    }


    public function actualizardescripcion($descrip){

        $idUsuario = $_SESSION['idUsuario'];

        $mensaje = "";

        $baseDatos = Conexion::conectar();

        $sql = $baseDatos -> prepare("UPDATE usuarios SET descripcion= :descripcion WHERE idUsuario = :idUsuario");

        $sql->bindValue('idUsuario',$descrip->getidUsuario());
        $sql->bindValue('descripcion',$descrip->getdescripcion());

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

    public function eliminardescripcion($descrip){

        $mensaje = "";

        $baseDatos = Conexion::conectar();

        $sql = $baseDatos -> prepare("UPDATE usuarios SET descripcion='' WHERE idUsuario = :idUsuario");

        $sql->bindValue('idUsuario',$descrip->getidUsuario());

        try{
            $sql-> execute();
            $mensaje = "Eliminación exitosa :)";
        
        }
        catch(Exception $e){
            $mensaje= $e ->getMessage();
        }

        Conexion::desconectar($baseDatos);
        return $mensaje;

    }



   
   //C:\xampp\htdocs\chronoMVC
}

?>