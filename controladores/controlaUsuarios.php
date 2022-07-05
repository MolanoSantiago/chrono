<?php
    
    require('../modelos/usuarios.php');

    class controlaUsuarios{

        public function __contruct(){

        }

        public function mostrarPregunta(){
            $usuarios = new Usuarios();
            return $usuarios -> mostrarPregunta();
        }

        public function mostrarUsuario(){
            $usuarios = new Usuarios();
            return $usuarios -> mostrarUsuario();
        }

        public function listarRoles(){
            $usuarios =new Usuarios();
            return $usuarios -> listarRoles();
        }


        public function listarEstadosUsuarios(){
            $usuarios =new Usuarios();
            return $usuarios -> listarEstadosUsuarios();
        }

        public function buscarRecupera($idUsuario){
            $usuarios= new Usuarios();
            $usuario = new Usuarios();
            $usuario->setidUsuario($idUsuario);

            $datosUsuario= $usuarios->buscarRecupera($usuario);

            $usuario->setpregunta($datosUsuario['pregunta']);
            $usuario->setrespuesta($datosUsuario['respuesta']);

            return $usuario;
        }

        public function buscarUsuario($idUsuario){
            //crear objeto en clase categoria
            $usuarios= new Usuarios();
            $usuario = new Usuarios();
            $usuario->setidUsuario($idUsuario);


            //buscar datos categoria en DB
            $datosUsuario= $usuarios->buscarUsuario($usuario);
            //prueba
            // echo  $categoria['nombre'];
            $usuario->setnombre($datosUsuario['nombre']);
            $usuario->setcorreo($datosUsuario['correoElectronico']);
            $usuario->setusername($datosUsuario['nombreDeUsuario']);
            $usuario->setpassword($datosUsuario['contrasena']);
            $usuario->setdescripcion($datosUsuario['descripcion']);
            $usuario->setidRol($datosUsuario['idRol']);
            $usuario->setidEstadoUsuario($datosUsuario['idEstadoUsuario']);

            //prueba
            // var_dump($categoria);

            //------------------10-----------------
            return  $usuario;
        }


        public function correoExiste($correo){

            $usuarios= new Usuarios();
            $usuario = new Usuarios();

            $usuario->setcorreo($correo);

            $mensaje= $usuarios->correoExiste($usuario);

            echo "<script>
                alert('$mensaje');
                document.location.href='../vistas/recuperaPassword2.php?correo=".$correo." ';
            </script>"; 
            
        }


        public function registrarUsuario($nombre, $correo, $username, $password){
            //crear objeto en clase categoria
            $usuarios= new Usuarios();
            $usuario = new Usuarios();
            $usuario->setidUsuario('');
            $usuario->setnombre($nombre);
            $usuario->setcorreo($correo);
            $usuario->setusername($username);
            $usuario->setpassword($password);
            $mensaje= $usuarios->registrarUsuario($usuario);
            echo "<script>
                alert('$mensaje');
                document.location.href='../vistas/login.php';
            </script>";
        }


        public function editarUsuario($idUsuario, $nombre, $correo, $username, $password, $descripcion, $idRol, $idEstadoUsuario){
            //crear objeto en clase categoria
            $usuarios= new Usuarios();
            $usuario = new Usuarios();
            $usuario->setidUsuario($idUsuario);
            $usuario->setnombre($nombre);
            $usuario->setcorreo($correo);
            $usuario->setusername($username);
            $usuario->setpassword($password);
            $usuario->setdescripcion($descripcion);
            $usuario->setidRol($idRol);
            $usuario->setidEstadoUsuario($idEstadoUsuario);


            //prueba
            // var_dump($categoria);
            $mensaje= $usuarios->editarUsuario($usuario);
            echo "<script>
                alert('$mensaje');
                document.location.href='../vistas/mostrarUsuarios.php';
            </script>";
        }

        public function recupera($idUsuario, $pregunta, $respuesta){
            $usuarios= new Usuarios();
            $usuario = new Usuarios();
            $usuario->setidUsuario($idUsuario);
            $usuario->setpregunta($pregunta);
            $usuario->setrespuesta($respuesta);

            $mensaje= $usuarios->recupera($usuario);
            echo "<script>
                alert('$mensaje');
                document.location.href='../vistas/mostrarUsuarios.php';
            </script>";
        }

        public function eliminarUsuario($idUsuario){
            //crear objeto en clase categoria
            $usuarios= new Usuarios();
            $usuario = new Usuarios();
            $usuario->setidUsuario($idUsuario);
            $usuario->setnombre('');
            $usuario->setcorreo('');
            $usuario->setusername('');
            $usuario->setpassword('');
            $usuario->setdescripcion('');
            $usuario->setidRol('');
            $usuario->setidEstadoUsuario('');

            //prueba
            // var_dump($categoria);
            $mensaje= $usuarios->eliminarUsuario($usuario);
            // echo $mensaje;
            //scrip que muestra eventos js
            echo "<script>
                alert('$mensaje');
                document.location.href='../vistas/mostrarUsuarios.php';
            </script>";
        }


        public function desplegarVista($pagina){
            header("location:../".$pagina);
        }

    }
    
    $controlaUsuario= new controlaUsuarios();
    $patron_texto = "/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+$/";
    

    if (isset($_POST['registrar'])){
       //recibir var de form
       if(strlen($_POST['nombre'] ) >0 && strlen($_POST['correo']) > 0 && strlen($_POST['username']) > 0 && strlen($_POST['password']) > 0){
        if( isset($_POST['nombre'])){
                // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
            if( preg_match($patron_texto, $_POST['nombre'])){
                $nombre= $_POST['nombre'];
            } else if(strlen($_POST['nombre']) > 30){
                echo "<script>
                alert('El nombre es muy largo O.o');
                document.location.href='../vistas/signin.php';
                </script>";
            } else {
                echo "<script>
                alert('El nombre solo puede tener letras y espacios O.o');
                document.location.href='../vistas/signin.php';
                </script>";
            }
        }
        if( isset($_POST['correo'])){

            if (!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) {
                echo "<script>
                alert('Correo electrónico inválido O.o');
                document.location.href='../vistas/signin.php';
                </script>";
            } else {
                $correo = $_POST['correo'];
            }

        }
        $username= $_POST['username'];
        $password= $_POST['password'];
        $controlaUsuario->registrarUsuario($nombre, $correo, $username, $password);
       } else {
        echo "<script>
                alert('Rellene todos los campos');
                document.location.href='../vistas/signin.php';
            </script>";
       }
    }

    else if(isset($_REQUEST['crear'])){
        //Recibir variables desde el formulario
        $idUsuario = base64_encode($_REQUEST['idUsuario']);
        $idUsuario = base64_encode($idUsuario);
        //base_decode: función que encripta una variable
        //var_dump($categoria);
        $controlaUsuario->desplegarVista('vistas/ajustesPassword.php?idUsuario='.$idUsuario);
    
    
    }

    else if (isset($_POST['crear2'])){
        //recibir var de form
        $idUsuario = $_POST['idUsuario'];
        $pregunta= $_POST['pregunta'];
        $respuesta = $_POST['respuesta'];
        $controlaUsuario->recupera($idUsuario, $pregunta, $respuesta);
     }

    else if(isset($_POST['recuperar'])){

        $correo= $_POST['correo'];

        $controlaUsuario->correoExiste($correo);
        //$controlaUsuario -> desplegarVista('vistas/recuperaPassword2.php?correo='.$correo);
    }

    else if (isset($_REQUEST['editar'])) {
        //base64 encode = funcion php para encriptar id var (ej: id= 1,  MQ==) x2 para mas seguridad
        $idUsuario= base64_encode($_REQUEST['idUsuario']);
        $idUsuario= base64_encode($idUsuario);

        // echo $idCategoria;
        // -----------------7---------------------
        $controlaUsuario->desplegarVista('vistas/editarUsuarios.php?idUsuario='.$idUsuario);
    }

    else if (isset($_POST['actualizar'])){
        if(strlen($_POST['idUsuario'] ) >0 && strlen($_POST['nombre'] ) >0 && strlen($_POST['correo']) > 0 && strlen($_POST['username']) > 0 && strlen($_POST['password']) > 0 && strlen($_POST['idRol'] ) >0 && strlen($_POST['idEstadoUsuario'] ) >0){
            $idUsuario= $_POST['idUsuario'];
            if( isset($_POST['nombre'])){
                // Comprobar mediante una expresión regular, que sólo contiene letras y espacios:
            if( preg_match($patron_texto, $_POST['nombre'])){
                $nombre= $_POST['nombre'];
            } else if(strlen($_POST['nombre']) > 30){
                echo "<script>
                alert('El nombre es muy largo O.o');
                document.location.href='../vistas/signin.php';
                </script>";
            } else {
                echo "<script>
                alert('El nombre solo puede tener letras y espacios O.o');
                document.location.href='../vistas/signin.php';
                </script>";
            }
        }
        if( isset($_POST['correo'])){

            if (!filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) {
                echo "<script>
                alert('Correo electrónico inválido O.o');
                document.location.href='../vistas/signin.php';
                </script>";
            } else {
                $correo = $_POST['correo'];
            }

        }
        $username= $_POST['username'];
        $password= $_POST['password'];
        $descripcion= $_POST['descripcion'];
        $idRol = $_POST['idRol'];
        $idEstadoUsuario = $_POST['idEstadoUsuario'];
        $controlaUsuario->editarUsuario($idUsuario, $nombre, $correo, $username, $password, $descripcion, $idRol, $idEstadoUsuario);
        } else {
            echo "<script>
                    alert('Rellene todos los campos');
                    document.location.href='../vistas/mostrarUsuarios.php';
                </script>";
           }
    }

    else if (isset($_GET['eliminar'])) {
        $idUsuario= $_REQUEST['idUsuario'];
        $controlaUsuario->eliminarUsuario($idUsuario);
    }

    elseif (isset($_REQUEST['vistas'])) {
        $controlaUsuario->desplegarVista($_REQUEST['vistas']);   
    }
?>