<?php
require_once('../modelos/conexion.php');
require_once('../modelos/usuarioEtiquetas.php');


    class controlaUE{

        public function __construct(){
        }


        public function mostrarUE(){
            $UsuarioEtiqueta =new  usuarioEtiqueta();
            return  $UsuarioEtiqueta -> mostrarUE();
        }

        public function mostrarUsuario(){
            $UsuarioEtiqueta =new  usuarioEtiqueta();
            return  $UsuarioEtiqueta -> mostrarUsuario();
        }

        public function mostrarEtiqueta(){
            $UsuarioEtiqueta =new  usuarioEtiqueta();
            return  $UsuarioEtiqueta -> mostrarEtiqueta();
        }


        public function registrarUE($idUsuario, $idEtiqueta){
            $UsuarioEtiquetas = new usuarioEtiqueta();
            $UsuarioEtiqueta = new usuarioEtiqueta();
            //echo "$Usuario $Etiqueta";
            $UsuarioEtiqueta->setidUsuarioEtiqueta('');
            $UsuarioEtiqueta->setidUsuario($idUsuario);
            $UsuarioEtiqueta->setidEtiqueta($idEtiqueta);
            $mensaje = $UsuarioEtiquetas-> registrarUE($UsuarioEtiqueta);
            echo "<script>
            alert('$mensaje');
            document.location.href='../vistas/mostrarUE.php';
            </script>";
        }

        public function registraretiqueta($etiqueta, $idUsuario){
            $UsuarioEtiquetas = new usuarioEtiqueta();
            $etiquetaNueva = new usuarioEtiqueta();
            $etiquetaNueva->setidEtiqueta('');
            $etiquetaNueva->setetiqueta($etiqueta);
            $etiquetaNueva->setidUsuario($idUsuario);

            $mensaje = $UsuarioEtiquetas->registraretiqueta($etiquetaNueva);
            echo "<script>
            alert('$mensaje');
            document.location.href='../vistas/mostrarUE.php';
            </script>";
        }

        public function buscarUE($idUsuarioEtiqueta){
            $UsuarioEtiquetas = new usuarioEtiqueta();
            $UsuarioEtiqueta = new usuarioEtiqueta();
            
            $UsuarioEtiqueta -> setidUsuarioEtiqueta($idUsuarioEtiqueta);

            $datosUE= $UsuarioEtiquetas-> buscarUE($UsuarioEtiqueta);

            $UsuarioEtiqueta -> setidUsuario($datosUE['idUsuario']);
            $UsuarioEtiqueta -> setidEtiqueta($datosUE['idEtiqueta']);
            return $UsuarioEtiqueta;
        }
        

        public function actualizarUE( $idUsuarioEtiqueta, $idEtiqueta, $idUsuario){
            $UsuarioEtiquetas = new usuarioEtiqueta();
            $UsuarioEtiqueta = new usuarioEtiqueta();
          
            $UsuarioEtiqueta -> setidUsuarioEtiqueta($idUsuarioEtiqueta);
            $UsuarioEtiqueta -> setidEtiqueta($idEtiqueta);
            $UsuarioEtiqueta -> setidUsuario($idUsuario);
            
            var_dump($UsuarioEtiqueta);

            $mensaje = $UsuarioEtiquetas->actualizarUE($UsuarioEtiqueta);
            echo "<script>
            alert('$mensaje');
            document.location.href='../vistas/mostrarUE.php';
            </script>";
        }


        public function eliminarUE($idUsuarioEtiqueta){
            $UsuarioEtiquetas = new usuarioEtiqueta();
            $UsuarioEtiqueta = new usuarioEtiqueta();

            $UsuarioEtiqueta -> setidUsuarioEtiqueta($idUsuarioEtiqueta);
            $UsuarioEtiqueta -> setidEtiqueta('');
            $UsuarioEtiqueta -> setidUsuario('');
            

            $mensaje = $UsuarioEtiquetas->eliminarUE($UsuarioEtiqueta);
            echo "<script>
            alert('$mensaje');
            document.location.href='../vistas/mostrarUE.php';
        </script>";
    }

    public function desplegarVista($pagina){
        header("Location:../".$pagina);
    }
}

$controlaUE = new controlaUE();


if (isset($_POST['registrar'])){

    session_start(); 

    $mostrarUE = $controlaUE->mostrarUE();
    $idUsuario = $_POST['idUsuario'];
    $idEtiqueta= $_POST['idEtiqueta'];

    $baseDatos = Conexion::conectar();

    $sql = $baseDatos->query("SELECT * FROM usuarios_etiquetas WHERE idEtiqueta = '$idEtiqueta' AND idUsuario = '$idUsuario'");
    $sql->execute();
    Conexion::desconectar($baseDatos);
    $sql->fetchAll();
    $count =$sql->rowCount();
    if($idEtiqueta == null){
        echo "<script>
            alert('No puedes registrar una etiqueta vacia');
            document.location.href='../vistas/registrarUE.php';
        </script>";

    } else if($count > 0){
        echo "<script>
               alert('Ya tienes registrada esta etiqueta');
               document.location.href='../vistas/registrarUE.php';
           </script>";

    } else{
        $controlaUE-> registrarUE($idUsuario,$idEtiqueta);
    }
}
else if (isset($_POST['crear'])){ //Si la variable existe 
    //Recibir variables del formulario
  
    $controlaUE->desplegarVista('vistas/registraretiqueta.php');
}


else if (isset($_POST['registrarE'])){ //Si la variable existe 
    //Recibir variables del formulario
    $etiqueta = $_POST['etiqueta'];
    $idUsuario = $_POST['idUsuario'];

    if($etiqueta == null){
        echo "<script>
            alert('No puedes registrar una etiqueta vacia');
            document.location.href='../vistas/registraretiqueta.php';
        </script>";
    }else{
        $controlaUE->registraretiqueta($etiqueta, $idUsuario); 
    }
 
}

else if(isset($_REQUEST['editar'])){
    //Recibir variables desde el formulario
    $idUsuarioEtiqueta = base64_encode($_REQUEST['idUsuarioEtiqueta']);
    $idUsuarioEtiqueta = base64_encode($idUsuarioEtiqueta);
    //base_decode: función que encripta una variable
    //var_dump($categoria);
    $controlaUE->desplegarVista('vistas/editarUE.php?idUsuarioEtiqueta='.$idUsuarioEtiqueta);
}
else if (isset($_POST['actualizar'])){ //Si la variable existe 
    //Recibir variables del formulario
    
    $idUsuarioEtiqueta = $_POST ['idUsuarioEtiqueta'];
    $idEtiqueta = $_POST['idEtiqueta'];
    $idUsuario = $_POST ['idUsuario'];
    
    
    
    $controlaUE->actualizarUE($idUsuarioEtiqueta,  $idEtiqueta, $idUsuario);
}
else if(isset($_GET['eliminar'])){
    //Recibir variables desde el formulario
    $idUsuarioEtiqueta = $_REQUEST['idUsuarioEtiqueta'];
    //var_dump($categoria);
    $controlaUE->eliminarUE($idUsuarioEtiqueta);
    //$controlaEtiquetas->desplegarVista('mostrarCategorias.php');

}elseif(isset($_POST['volver'])){
    $controlaUE->desplegarVista('vistas/mostrarUE.php');
}
elseif(isset($_REQUEST['vistas'])){
    $controlaUE->desplegarVista($_REQUEST['vistas']);
}



?>   

        
      