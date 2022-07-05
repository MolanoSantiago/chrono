<?php
session_start();

require_once('../controladores/controlaEtiquetas.php');

$listarEtiqueta = $controlaEtiquetas->listaretiqueta();
?>
<?php
require_once('../layouts/navHome.php');
?>
<main class="main">
    <div class="edit-form">
        <form action="../controladores/controlaEtiquetas.php" method="POST">
            <br>
            <h2 id="left-form">Registrar etiqueta</h2>
            <br>
            <h4 id="left-form">Etiqueta:</h4>
            <input type="text" name="etiqueta" id="etiqueta" required />
            <br><br>
            <h6 id="right-form"><button type="submit" name="registrar">Registrar</button></h6>
        </form>
    </div>
</main>
<?php

include('../layouts/footerHome.php');

?>