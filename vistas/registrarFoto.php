<?php

require_once('../controladores/controladescripcion.php');

$idUsuario = base64_decode($_REQUEST['idUsuario']);
$idUsuario = base64_decode($idUsuario);


?>
<?php
require_once('../layouts/navHome.php');
?>
<main class="main">
    <div class="edit-form">
        <form action="../controladores/controladescripcion.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION['idUsuario'] ?>" readonly />
            <br>
            <h2 id="left-form">Cambiar foto</h2>
            <br>
            <h4>Imagen:</h4>
            <br>
            <input type="file" name="imagen" id="imagen" />
            <br>
            <br>
            <button type="submit" name="actualizarF">Actualizar</button>
</main>
<?php
require_once('../layouts/footerHome.php');
?>