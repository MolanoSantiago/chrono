<?php

require('../modelos/usuarios.php');

switch($_REQUEST['accion']){
    case 'Acceder':
        //echo $_POST['accion'];
        if(isset($_POST['username']) && isset($_POST['password'])){
            if(strlen($_POST['username'] ) >0 && strlen($_POST['password']) > 0 ){
                $username = $_POST['username'];
                $password = $_POST['password'];
                $Usuario = new Usuarios();
                $Usuario->setusername($username);
                $Usuario->setpassword($password);
                $Usuario->validarAcceso();
                if($Usuario->getlogueado() == 1){
                    //echo "Bienvenido";
                    session_start();//Emplear variables de sesión
                    //Definición de variable de sesión
                    $_SESSION['idUsuario'] = $Usuario->getidUsuario();
                    $_SESSION['nombreDeUsuario'] = $_POST['username'];
                    $_SESSION['idRol'] = $Usuario->getidRol();
                    $_SESSION['nombre'] = $Usuario->getnombre();
                    //Redireccionar al menú
                    header("Location: ../vistas/home.php");
                }
                else{
                    echo "
                    <script>
                    alert('Usuario y/o contraseña incorrectos.');
                    document.location.href = '../vistas/login.php';
                    </script>
                    ";
                }
            }
            else{
                echo "
                    <script>
                    alert('Por favor rellene todos los campos.');
                    document.location.href = '../vistas/login.php';
                    </script>
                    ";
            }
        }
        break;

    case 'Salir':
            session_start();
            session_destroy(); //Destruir las variables de sesión.
            header('Location:../vistas/login.php');
        break;
}

?>