<?php
require_once('../controladores/controladescripcion.php');
require_once('../controladores/controlatabla.php');
require_once('../modelos/conexion.php');

$controladescripcion = new controladescripcion();
$controlatabla = new controlatabla();

$listardescripcion = $controladescripcion->listardescripcion();
$mostrartabla = $controlatabla->mostrartabla();

$numEtiquetas = null;
?>

<?php
require_once('../layouts/navHome.php');
?>

<?php if($_SESSION['nombreDeUsuario'] == null){
    echo "<script>
      alert('Por favor actualice su contraseña y vuelva a iniciar sesión.');
      document.location.href='../vistas/mostrarUsuarios.php';
      </script>";
  } 
  if(isset($_REQUEST['idUsuario'])){
    if($_REQUEST['idUsuario'] != null){
        $idUsuario = base64_decode($_REQUEST['idUsuario']);
        $nombre = base64_decode($_REQUEST['username']);
        $descripcion = base64_decode($_REQUEST['descripcion']);
        $cantidad = base64_decode($_REQUEST['cantidad']);
        
    }
  }
  $descrip = $controladescripcion->buscardescripcion($idUsuario);
  ?>

<link rel="stylesheet" href="../assets/css/perfil.css">

<main class="main">
    <h1><?php echo $nombre; ?></h1>
    <br><br>
    
    
    <?php if (file_exists("../assets/imgs/" .$idUsuario. ".jpg")) { 

        echo "<div class='circular--landscape'>
            <img src='../assets/imgs/".$idUsuario.".jpg' alt='Foto de perfil'>
        </div>";

     } else { ?>
        <div class="circular--landscape">
            <img src="../assets/imgs/index.jpg" alt="Foto de perfil">
        </div>
    <?php } ?>
    <br><br> 
        <h4>
        <?php   
            foreach($mostrartabla as $tabla){
                        
                if($tabla['idUsuario'] == $idUsuario){
                            
                            
                    echo " •".$tabla['etiqueta']." ";
                           
                            
                }
            }
                           ?>
        </h4>
    <br><br>
        <div class="blur">
            <h4>
                <?php 
                    echo $descripcion;
                ?>
            </h4>
        </div>
    <br><br>
</main>





<?php
require_once('../layouts/footerHome.php');
?>