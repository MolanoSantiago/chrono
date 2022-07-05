<?php
session_start();
//Incluir el controlador a emplear
require_once('../controladores/controlaEtiquetas.php');
//Recibir valor del id a buscar
$idEtiqueta = base64_decode($_REQUEST['idEtiqueta']);
$idEtiqueta = base64_decode($idEtiqueta);
//base64_decode: Desencripta
//Buscar la Etiqueta en la bd y guardarlo en un objeto
$etiquetaNueva = $controlaEtiquetas->buscaretiqueta($idEtiqueta);

//var_dump($Etiqueta);
?>
<?php
require_once('../layouts/navHome.php');
?>
<main class="main">
    <div class="edit-form">
        <br>
        <h2 id="left-form">Editar etiqueta</h2>
        <br>
        <form action="../controladores/controlaEtiquetas.php" method="POST">
            <h4 id="left-form">Id Etiqueta:</h4>
            <input type="text" name="idEtiqueta" id="idEtiqueta" value="<?php echo $etiquetaNueva->getidEtiqueta() ?>" readonly />
            <br><br>
            <h4 id="left-form">Nombre:</h4>
            <input type="text" name="etiqueta" id="etiqueta" value="<?php echo $etiquetaNueva->getetiqueta() ?>" required />
            <br><br>
            <h6 id="right-form"><button type="submit" name="actualizar"> Actualizar </button></h6>
        </form>
    </div>
</main>
<?php
require_once('../layouts/footerHome.php');
?>