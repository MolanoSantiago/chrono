<?php

require_once('../modelos/etiquetas.php');


    class controlaEtiquetas{

        public function __construct(){
        }

        public function listaretiqueta(){
            $crudEtiquetas=new  etiqueta();
            return  $crudEtiquetas -> listaretiqueta();
        }

        public function registraretiqueta($etiqueta){

            session_start();

            $idUsuario = $_SESSION['idUsuario'];

            $crudEtiquetas = new etiqueta();
            $etiquetaNueva = new etiqueta();
            $etiquetaNueva->setidEtiqueta('');
            $etiquetaNueva->setetiqueta($etiqueta);
            
            $mensaje = $crudEtiquetas->registraretiqueta($etiquetaNueva);
            echo "<script>
            alert('$mensaje');";
            if ($idUsuario == 1) {
                echo "document.location.href='../vistas/mostrarEtiquetas.php';";
            } else {
                echo "document.location.href='../vistas/mostrarUE.php';";
            }
            echo "</script>";
        }

        public function buscaretiqueta($idEtiqueta){
            $crudEtiquetas = new etiqueta();
            $etiquetaNueva = new etiqueta();
            
            $etiquetaNueva -> setidEtiqueta($idEtiqueta);
            $datosetiqueta= $crudEtiquetas-> buscaretiqueta($etiquetaNueva);
            $etiquetaNueva -> setetiqueta($datosetiqueta['etiqueta']);
            return $etiquetaNueva;
        }
        
        public function actualizaretiqueta($idEtiqueta, $etiqueta){
            $crudEtiquetas = new etiqueta();
            $etiquetaNueva = new etiqueta();
          
            $etiquetaNueva -> setidEtiqueta($idEtiqueta);
            $etiquetaNueva -> setetiqueta($etiqueta);

            $mensaje = $crudEtiquetas->actualizaretiqueta($etiquetaNueva);
            echo "<script>
            alert('$mensaje');
            document.location.href='../vistas/mostrarEtiquetas.php';
        </script>";
        }

        public function eliminaretiqueta($idEtiqueta){
            $crudEtiquetas = new etiqueta();
            $etiquetaNueva = new etiqueta();
            $etiquetaNueva -> setidEtiqueta($idEtiqueta);
            $etiquetaNueva -> setetiqueta('');

            $mensaje = $crudEtiquetas->eliminaretiqueta($etiquetaNueva);
            echo "<script>
            alert('$mensaje');
            document.location.href='../vistas/mostrarEtiquetas.php';
        </script>";
    }

    public function desplegarVista($pagina){
        header("Location:../".$pagina);
    }
}

$controlaEtiquetas = new controlaEtiquetas();
if (isset($_POST['registrar'])){ //Si la variable existe 
    //Recibir variables del formulario
    $etiqueta = $_POST['etiqueta'];
    $controlaEtiquetas->registraretiqueta($etiqueta);

    
}
else if(isset($_REQUEST['editar'])){
    //Recibir variables desde el formulario
    $idEtiqueta = base64_encode($_REQUEST['idEtiqueta']);
    $idEtiqueta = base64_encode($idEtiqueta);
    //base_decode: función que encripta una variable
    //var_dump($categoria);
    $controlaEtiquetas->desplegarVista('vistas/editaretiqueta.php?idEtiqueta='.$idEtiqueta);
}
else if (isset($_POST['actualizar'])){ //Si la variable existe 
    //Recibir variables del formulario
    $idEtiqueta = $_POST['idEtiqueta'];
    $etiqueta = $_POST['etiqueta'];
    
    $controlaEtiquetas->actualizaretiqueta($idEtiqueta, $etiqueta);
}
else if(isset($_GET['eliminar'])){
    $idEtiqueta = $_REQUEST['idEtiqueta'];
    $controlaEtiquetas->eliminaretiqueta($idEtiqueta);

}
else if(isset($_REQUEST['vistas'])){
    $controlaEtiquetas->desplegarVista($_REQUEST['vistas']);
}

?>   

        
      