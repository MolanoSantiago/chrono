<?php

    require_once ('conexion.php');

    class Usuarios extends Conexion{

        private $idUsuario;
        private $nombre;
        private $correo;
        private $password;
        private $username;
        private $descripcion;
        private $idRol;
        private $idEstadoUsuario;
        private $logueado;
        private $rol;
        private $pregunta;
        private $respuesta;


        public function __contruct(){

        }

        public function setidUsuario($idUsuario){
            $this -> idUsuario = $idUsuario;
        }

        public function getidUsuario(){
            return $this->idUsuario;
        }


        public function setnombre($nombre){
            $this -> nombre = $nombre;
        }

        public function getnombre(){
            return $this->nombre;
        }



        public function setcorreo($correo){
            $this -> correo = $correo;
        }

        public function getcorreo(){
            return $this->correo;
        }



        public function setpassword($password){
            $this -> password = $password;
        }

        public function getpassword(){
            return $this->password;
        }




        public function setusername($username){
            $this -> username = $username;
        }

        public function getusername(){
            return $this->username;
        }





        public function setdescripcion($descripcion){
            $this -> descripcion = $descripcion;
        }

        public function getdescripcion(){
            return $this->descripcion;
        }





        public function setidRol($idRol){
            $this -> idRol = $idRol;
        }

        public function getidRol(){
            return $this->idRol;
        }




        public function setidEstadoUsuario($idEstadoUsuario){
            $this -> idEstadoUsuario = $idEstadoUsuario;
        }

        public function getidEstadoUsuario(){
            return $this->idEstadoUsuario;
        }



        public function setpregunta($pregunta){
            $this -> pregunta = $pregunta;
        }

        public function getpregunta(){
            return $this->pregunta;
        }



        public function setrespuesta($respuesta){
            $this -> respuesta = $respuesta;
        }

        public function getrespuesta(){
            return $this->respuesta;
        }



        public function setlogueado($logueado){
            $this -> logueado = $logueado;
        }

        public function getlogueado(){
            return $this->logueado;
        }




        public function mostrarPregunta(){

            
            
            $db = Conexion::conectar();

           

                $sql = $db -> query('SELECT * FROM usuarios ORDER BY idUsuario ASC');

         
            $sql -> execute();

            Conexion::desconectar($db);

            return ($sql->fetchAll());

        }


        public function usuarioExiste($username, $pass){
            $md5pass = md5($pass);

            $db = Conexion::conectar();

            $sql = $db -> prepare('SELECT * FROM usuarios WHERE nombreDeUsuario=:username AND contrasena=:pass');

            $sql -> execute(['username' => $username, 'pass' => $md5pass]);

            Conexion::desconectar($db);

            if ($sql -> rowCount()){
                return true;
            } else {
                return false;
            }

        }



        public function correoExiste($correo){

            $mensaje= "";

            $db = Conexion::conectar();
            
            $correo       = trim($_REQUEST['correo']);
            $sql = $db -> query("SELECT * FROM usuarios WHERE correoElectronico = '$correo' ");

            Conexion::desconectar($db);
            $sql->fetchAll();

            $count =$sql->rowCount();

            if($correo == null){
            echo "<script>
                alert('Por favor rellene el campo');
                document.location.href='../vistas/recuperaPassword.php?correo=".$correo."';
                </script>";

            } else if($count > 0){
            echo "<script>
                alert('A continuación responda la pregunta dinámica');
                document.location.href='../vistas/recuperaPassword2.php?correo=".$correo."';
                </script>";

            } else{
                echo "<script>
                alert('No existe el correo');
                document.location.href='../vistas/recuperaPassword.php';
                </script>";
            }
    }



        public function setUsuario($username){
            $db = Conexion::conectar();

            $sql = $db -> prepare('SELECT * FROM usuarios WHERE nombreDeUsuario = :username');

            $sql -> execute(['username' => $username]);

            foreach ($sql as $currentUser){
                $this-> nombre = $currentUser['nombre'];
                $this-> username = $currentUser['nombreDeUsuario'];
            }
        }


        
        public function validarAcceso(){
            $username = Usuarios::getusername();
            Usuarios::setlogueado(0);
            $password = Usuarios::getpassword();
            $db = Conexion::conectar();
            $sql = $db->query("SELECT * FROM usuarios
                    WHERE nombreDeUsuario='$username' 
                    AND contrasena = '$password' ");
            try{
                $sql->execute();
                if($sql->rowCount() > 0){//Se devolvieron registros
                    $datosUsuario = $sql->fetch();
                    Usuarios::setidUsuario($datosUsuario['idUsuario']);
                    Usuarios::setidRol($datosUsuario['idRol']);
                    Usuarios::setidEstadoUsuario($datosUsuario['idEstadoUsuario']);
                    Usuarios::setnombre($datosUsuario['nombre']);
                    Usuarios::setlogueado(1);
                }
            }
            catch(Exception $e){
                echo "Problemas en el login";
            } 
            Conexion::desconectar($db);
        }




        public function validarAccesoRecupera(){
            $pregunta = Usuarios::getpregunta();
            Usuarios::setlogueado(0);
            $respuesta = Usuarios::getrespuesta();
            $db = Conexion::conectar();
            $sql = $db->query("SELECT * FROM usuarios
                    WHERE pregunta='$pregunta' 
                    AND respuesta = '$respuesta' ");
            try{
                $sql->execute();
                if($sql->rowCount() > 0){//Se devolvieron registros
                    $datosUsuario = $sql->fetch();
                    Usuarios::setidUsuario($datosUsuario['idUsuario']);
                    Usuarios::setidRol($datosUsuario['idRol']);
                    Usuarios::setidEstadoUsuario($datosUsuario['idEstadoUsuario']);
                    Usuarios::setnombre($datosUsuario['nombre']);
                    Usuarios::setlogueado(1);
                }
            }
            catch(Exception $e){
                echo "Problemas con el acceso";
            } 
            Conexion::desconectar($db);
        }




        public function mostrarUsuario(){

            
            
            $db = Conexion::conectar();

            if($_SESSION['idRol']==1){

                $sql = $db -> query('SELECT usuarios.*, roles.rol, estados_usuarios.estado FROM usuarios INNER JOIN roles ON (usuarios.idRol = roles.idRol)  INNER JOIN estados_usuarios ON (usuarios.idEstadoUsuario = estados_usuarios.idEstadoUsuario) ORDER BY idUsuario ASC');

            }else{

                $idUsuario = $_SESSION['idUsuario'];

                $sql = $db -> query('SELECT usuarios.nombre, usuarios.correoElectronico, usuarios.nombreDeUsuario, usuarios.contrasena, estados_usuarios.estado FROM usuarios INNER JOIN roles ON (usuarios.idRol = roles.idRol)  INNER JOIN estados_usuarios ON (usuarios.idEstadoUsuario = estados_usuarios.idEstadoUsuario) WHERE idUsuario='.$idUsuario);
            }

            $sql -> execute();

            Conexion::desconectar($db);

            return ($sql->fetchAll());

        }

        public function listarRoles(){
            $db = Conexion::conectar();

            $sql = $db -> query('SELECT * FROM roles');

            $sql -> execute();

            Conexion::desconectar($db);

            return ($sql->fetchAll());
        }

        public function listarEstadosUsuarios(){
            $db = Conexion::conectar();

            $sql = $db -> query('SELECT * FROM estados_usuarios');

            $sql -> execute();

            Conexion::desconectar($db);

            return ($sql->fetchAll());
        }

        public function buscarRecupera($usuario){

            $db= Conexion::conectar();

            $sql= $db->query("SELECT * FROM usuarios WHERE idUsuario=".$_SESSION['idUsuario']);

            $sql->execute();
            Conexion::desconectar($db);

            return $sql->fetch();
        }

        public function buscarUsuario($usuario){

            $db= Conexion::conectar();

            if($_SESSION['idRol']==1){

                $sql= $db->query("SELECT * FROM usuarios WHERE idUsuario=".$usuario->getidUsuario());
            

            } else {

                $sql= $db->query("SELECT * FROM usuarios WHERE idUsuario=".$_SESSION['idUsuario']);

            }

            $sql->execute();
            Conexion::desconectar($db);

            // var_dump($sql->fetch());
            return $sql->fetch();
            //fetch trae un solo registro y fetchAll varios registros
            // return ($sql->fetchAll());//retornar todos (fetch)
        }

        public function recupera($usuario){

            $mensaje = "";

            $db= Conexion::conectar();

            $sql= $db->prepare("UPDATE usuarios SET pregunta = :pregunta, respuesta = :respuesta WHERE idUsuario = :idUsuario");

            $sql->bindValue('idUsuario', $usuario->getidUsuario());
            $sql->bindValue('pregunta', $usuario->getpregunta());
            $sql->bindValue('respuesta', $usuario->getrespuesta());

            try{
                $sql->execute(); 
               $mensaje= "Se ha guardado la validación.";
            }

            catch(Exception $e){
                $mensaje="No ha sido posible guardar la validación.";
            }

            catch (Exception $e){
                $mensaje= $e->getMessage();
            }

            Conexion::desconectar($db);
            return $mensaje;
        }

        public function registrarUsuario($usuario){
            $mensaje= "";

            $db= Conexion::conectar();

           $sql= $db->prepare('INSERT INTO
             usuarios(idUsuario, nombre, correoElectronico, nombreDeUsuario, contrasena)

             VALUES (:idUsuario, :nombre, :correoElectronico, :nombreDeUsuario, (:contrasena))');

           $sql->bindValue('idUsuario', '');
           $sql->bindValue('nombre', $usuario->getnombre());
           $sql->bindValue('correoElectronico', $usuario->getcorreo());
           $sql->bindValue('nombreDeUsuario', $usuario->getusername());
           $sql->bindValue('contrasena', $usuario->getpassword());


           //verificacion
           try{
               $sql->execute(); //ejecutar sql
               $mensaje= "¡Registro exitoso!";
           }
           //mostrar errores del try
           //capturar exepciones de la transaccion sql (Exepcion)
           catch (Exception $e){
              $mensaje= "¡Ups! Hubo un error, inténtalo de nuevo ;)";
           }

           catch (Exception $e){
            $mensaje= $e->getMessage();

           }

           Conexion::desconectar($db);
           return $mensaje;
        }


        


        public function editarUsuario($usuario){
            $mensaje= "";

            //establecer conexion a db
            $db= Conexion::conectar();

            //preparar sentencia sql
           $sql= $db->prepare('UPDATE
           --  : = parametros para asignar valores a values
             usuarios SET nombre=:nombre, correoElectronico =:correoElectronico, nombreDeUsuario =:nombreDeUsuario, contrasena =(:contrasena), descripcion=:descripcion, idRol =:idRol, idEstadoUsuario=:idEstadoUsuario  WHERE idUsuario= :idUsuario');

            //asignar valores a parametros para : (de un value)
           $sql->bindValue('idUsuario', $usuario->getidUsuario());
           $sql->bindValue('nombre', $usuario->getnombre());
           $sql->bindValue('correoElectronico', $usuario->getcorreo());
           $sql->bindValue('nombreDeUsuario', $usuario->getusername());
           $sql->bindValue('contrasena', $usuario->getpassword());
           $sql->bindValue('descripcion', $usuario->getdescripcion());
           $sql->bindValue('idRol', $usuario->getidRol());
           $sql->bindValue('idEstadoUsuario', $usuario->getidEstadoUsuario());

           //verificacion
           try{
               $sql->execute(); //ejecutar sql
               $mensaje= "¡Actualización exitosa!";

           }
           //mostrar errores del try
           //capturar exepciones de la transaccion sql (Exepcion)
           catch (Exception $e){
                $mensaje = "El nombre de usuario y/o correo electronico ya existen.";
           }

           catch (Exception $e){
            $mensaje= $e->getMessage(); //obtener mensaje error
       }

           Conexion::desconectar($db);
           return $mensaje;
        }



        public function eliminarUsuario($usuario){
            $mensaje= "";

            //establecer conexion a db
            $db= Conexion::conectar();

            //preparar sentencia sql
           $sql= $db->prepare('DELETE FROM
           --  : = parametros para asignar valores a values
             usuarios WHERE idUsuario= :idUsuario');

            //asignar valores a parametros para : (de un value)
           $sql->bindValue('idUsuario', $usuario->getidUsuario());

           //verificacion
           try{
               $sql->execute(); //ejecutar sql
               $mensaje= "¡Eliminación exitosa!";
           }
           //mostrar errores del try
           //capturar exepciones de la transaccion sql (Exepcion)
           catch (Exception $e){
              $mensaje= $e->getMessage(); //obtener mensaje error
           }

           Conexion::desconectar($db);
           return $mensaje;
        }

    }


    /*class userSession{

        public function __construct(){
            session_start();
        }
    
        public function setCurrentUser($idUsuario){
            $_SESSION['idUsuario'] = $idUsuario;
        }
    
        public function getCurrentUser(){
            return $_SESSION['idUsuario'];
        }
    
        public function closeSession(){
            session_unset();
            session_destroy();
        }
    }*/


    

?>