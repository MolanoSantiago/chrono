<?php

require('../modelos/usuarios.php');
$pregunta = $_POST['pregunta'];
$respuesta = $_POST['respuesta'];
$correo = $_POST['correo'];

switch($_REQUEST['accion']){
    case 'Acceder':
        //echo $_POST['accion'];
        if(isset($_POST['pregunta']) && isset($_POST['respuesta']) && isset($_POST['correo'])){
            if(strlen($_POST['pregunta'] ) >0 && strlen($_POST['respuesta']) > 0 && strlen($_POST['correo']) > 0){
                $pregunta = $_POST['pregunta'];
                $respuesta = $_POST['respuesta'];
                $Usuario = new Usuarios();
                $Usuario->setpregunta($pregunta);
                $Usuario->setrespuesta($respuesta);
                $Usuario->validarAccesoRecupera();
                if($Usuario->getlogueado() == 1){
                    //echo "Bienvenido";
                    session_start();//Emplear variables de sesión
                    //Definición de variable de sesión
                    $_SESSION['idUsuario'] = $Usuario->getidUsuario();
                    $_SESSION['nombreDeUsuario'] = $Usuario->getusername();
                    $_SESSION['idRol'] = $Usuario->getidRol();
                    $_SESSION['nombre'] = $Usuario->getnombre();
                    //Redireccionar al menú
                    header("Location: ../vistas/home.php");
                }
                else{
                    echo "
                    <script>
                    alert('Pregunta y/o respuesta incorrectas.');
                    document.location.href = '../vistas/recuperaPassword2.php?correo=".$correo."';
                    </script>
                    ";
                }
            }
            else{
                echo "
                    <script>
                    alert('Por favor rellene todos los campos.');
                    document.location.href = '../vistas/recuperaPassword2.php?correo=".$correo."';
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
