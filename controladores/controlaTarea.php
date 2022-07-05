<?php
require_once('../modelos/tareas.php');
date_default_timezone_set('America/Mexico_City');

$fechaAC = date("Y-m-d");
$horaAC = date("H:i:s");

class controlaTareas{
    
    public function __construct(){

    }

    public function listarTarea(){
        //Crear un objeto de la clase Tarea
        $Tareas = new Tareas();
        return $Tareas->mostrarTareas();
    }

    public function mostrarTareasHoy(){
        //Crear un objeto de la clase Tarea
        $Tareas = new Tareas();
        return $Tareas->mostrarTareasHoy();
    }

  
    public function listarEstado(){
        //Crear un objeto de la clase Tareas
        $Tareas = new Tareas();
        return $Tareas->listarEstado();
    }

    public function listarUsuario(){
        //Crear un objeto de la clase Tareas
        $Tareas = new Tareas();
        return $Tareas->listarUsuario();
    }

    public function mostrarfecha(){
        //Crear un objeto de la clase Tarea
        $Tareas = new Tareas();
        return $Tareas->mostrarfecha();
    }

    
    public function registrarTareas( $nombreTarea, $fecha, $hora, $idUsuario){
        
            $Tareas = new Tareas();
            $Tarea = new Tareas();
            
                $Tarea->setidTarea('');
                $Tarea->setnombreTarea($nombreTarea);
                $Tarea->setfecha($fecha);
                $Tarea->sethora($hora);
                $Tarea->setidUsuario($idUsuario);
               
            
            $mensaje = $Tareas->registrarTareas($Tarea);
            echo "<script>
                alert('$mensaje');
                document.location.href='../vistas/mostrarTareas.php';
            </script>";
    }

    
    public function buscarUsuarios($idUsuario){
        //Crear un objeto de la clase Tarea
        $Tareas = new Tareas();
        $Tarea = new Tareas();
        $Tarea->setidUsuario($idUsuario);

        $Tareas->buscarUsuarios($idUsuario);

        return $Tarea;
    }
    

    public function buscarTareas($idTarea){
        //Crear un objeto de la clase Tarea
        $Tareas = new Tareas();
        $Tarea = new Tareas();
        $Tarea->setidTarea($idTarea);
        //Buscar los datos de la Tarea en la BD
        //var_dump($Tarea);
        $datosTarea = $Tareas->buscarTareas($Tarea);
        $Tarea->setnombreTarea($datosTarea['nombreTarea']);
        $Tarea->setfecha($datosTarea['fecha']);
        $Tarea->sethora($datosTarea['hora']);
        $Tarea->setidEstadoTarea($datosTarea['idEstadoTarea']);
        $Tarea->setidUsuario($datosTarea['idUsuario']);
        //var_dump($Tarea);
        return $Tarea;
    }

    public function actualizarTareas($idTarea,$nombreTarea,$fecha,$hora,$idEstadoTarea){
        //Crear un objeto de la clase Tarea
        $Tareas = new Tareas();
        $Tarea = new Tareas();
        $Tarea->setidTarea($idTarea);
        $Tarea->setnombreTarea($nombreTarea);
        $Tarea->setfecha($fecha);
        $Tarea->sethora($hora);
        $Tarea->setidEstadoTarea($idEstadoTarea);
      
        //var_dump($Tarea);
        $mensaje = $Tareas->actualizarTareas($Tarea);
        echo "<script>
            alert('$mensaje');
            document.location.href='../vistas/mostrarTareas.php';
        </script>";
    }


    public function eliminarTareas($idTarea){
        //Crear un objeto de la clase Tarea
        $Tareas = new Tareas();
        $Tarea = new Tareas();
        $Tarea->setidTarea($idTarea);
        $Tarea->setnombreTarea('');
        $Tarea->setfecha('');
        $Tarea->sethora('');
        $Tarea->setidEstadoTarea('');
        $Tarea->setidUsuario('');
        //var_dump($Tarea);
        $mensaje = $Tareas->eliminarTarea($Tarea);
        //echo $mensaje;
         //El siguiente script muestra eventos con javascript
        echo "<script>
            alert('$mensaje');
            document.location.href='../vistas/mostrarTareas.php';
        </script>";
    }

    public function finalizarTarea($time,$hour,$idTarea, $idUsuario){

        $Tareas = new Tareas();
        $Tarea = new Tareas();
        $Tarea->setidTarea($idTarea);
        if($idUsuario == $_SESSION['idUsuario']){
            

            
            if((strtotime(date('H:i:s'))+3598) >= strtotime($hour)){
            
                ?><script>
                    if (Notification.permission === 'granted') {

                        setTimeout(function(){
                            window.location.reload();
                            console.log("Aquí recarga");
                        }, 600000);

                        console.log("Aquí comienza");
                        
                        const notificacion = new Notification('¡Oye! Tienes una tarea', {
                            icon: '',
                            body: 'Está a punto de finalizar...'
                            });


                    notificacion.onclick = function(){
                    window.open('http://localhost/chrono/vistas/home.php');
                        }
                    }
                </script><?php
            
            }
        }
        
        if(strtotime(date('H:i:s')) >= strtotime($hour)  ||  strtotime(date('Y-m-d,H:i:s')) >= strtotime("$time,$hour")){
            
            $Tareas -> finalizarTarea($Tarea);
            //echo '<script type="text/JavaScript"> location.reload(); </script>';
        }
    }

    public function desplegarVista($pagina){
        header("Location:../".$pagina);
    }
}

    function validateDate($date, $format = 'Y-m-d, H:i:s'){
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

$controlaTarea = new controlaTareas();
$mostrarfecha= $controlaTarea -> mostrarfecha();
session_start();

if(validateDate("$fechaAC, $horaAC")==true){
    foreach($mostrarfecha as $times){

    $time = $times['fecha'];
    $hour = $times['hora'];
    $idTarea = $times['idTarea'];
    $idUsuario = $times['idUsuario'];
    $controlaTarea -> finalizarTarea($time,$hour,$idTarea,$idUsuario);
    }
}


if (isset($_POST['registrar'])){ 

        $nombreTarea = $_POST['nombreTarea'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $idUsuario = $_POST['idUsuario'];

    $controlaTarea->registrarTareas($nombreTarea,$fecha,$hora,$idUsuario);
    
}

else if(isset($_REQUEST['editar'])){
    //Recibir variables desde el formulario
    $idTarea = base64_encode($_REQUEST['idTarea']);
    $idTarea = base64_encode($idTarea);
    //base_decode: función que encripta una variable
    //var_dump($Tarea);
    $controlaTarea->desplegarVista('vistas/editarTareas.php?idTarea='.$idTarea);
}

else if (isset($_POST['actualizar'])){ //Si la variable existe 
    //Recibir variables del formulario
    $idTarea = $_POST['idTarea'];
    $nombreTarea = $_POST['nombreTarea'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $idEstadoTarea = $_POST['idEstadoTarea'];
    $controlaTarea->actualizarTareas($idTarea,$nombreTarea,$fecha,$hora,$idEstadoTarea);
}

else if(isset($_GET['eliminar'])){
    //Recibir variables desde el formulario
    $idTarea = $_REQUEST['idTarea'];
    //var_dump($Tarea);
    $controlaTarea->eliminarTareas($idTarea);
    //$controladorTarea->desplegarVista('listarTareas.php');

}
else if(isset($_REQUEST['vistas'])){
    $controlaTarea->desplegarVista($_REQUEST['vistas']);
}


?>