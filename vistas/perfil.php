<?php
require_once('../controladores/controladescripcion.php');
require_once('../controladores/controlaUE.php');

$controladescripcion = new controladescripcion();
$controlaUE = new controlaUE();

$listardescripcion = $controladescripcion->listardescripcion();
$mostrarUE = $controlaUE->mostrarUE();

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

  ?>

<link rel="stylesheet" href="../assets/css/perfil.css">

<main class="main">
    <h1><?php echo $_SESSION['nombre']; ?></h1>
    <br><br>
    
    
    <?php if (file_exists("../assets/imgs/" . $_SESSION['idUsuario'] . ".jpg")) { 

        echo '<div class="circular--landscape">
            <img src="'.$rutaImagenes.'" alt="Foto de perfil">
        </div>';

     } else { ?>
        <div class="circular--landscape">
            <img src="../assets/imgs/index.jpg" alt="Foto de perfil">
        </div>
    <?php } ?>
    <br><br> 
        <h4>
        <?php
            foreach($mostrarUE as $etiqueta){
                echo " •".$etiqueta['etiqueta']." ";
                $numEtiquetas = $etiqueta['etiqueta'];
            }?>
        </h4>
    <br><br>
        <div class="blur">
            <h4>
                <?php foreach($listardescripcion as $desc){ 
                    echo $desc['descripcion']; $numDescripcion = $desc['descripcion'];
                }?>
            </h4>
        </div>
    <br><br>
    <a href="ajustesPerfil.php"><button>Configuar perfil</button></a>
</main>





<?php
require_once('../layouts/footerHome.php');
?>