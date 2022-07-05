<?php

require_once('../controladores/controladescripcion.php');

$idUsuario = base64_decode($_REQUEST['idUsuario']);
$idUsuario = base64_decode($idUsuario);

$descrip = $controladescripcion->buscardescripcion($idUsuario);
//var_dump($categoria);
?>
<?php
    require_once('../layouts/navHome.php');
?>
<main class="main">
    <form action="../controladores/controladescripcion.php" method="POST"  enctype="multipart/form-data">
        <br>
        <h2>Descripción</h2>
        <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION['idUsuario'] ?>" readonly/>
        <br>
        <textarea rows="9" cols="50" name="descripcion"  id="descripcion" required><?php echo $descrip->getdescripcion()?></textarea>
        <br>
        <br>
        <button type="submit" name="actualizar">Actualizar</button>
    </form>
</main>
<?php
    require_once('../layouts/footerHome.php');
?>