<?php

session_start();
require_once('../controladores/controlaUE.php'); 

$mostrarUsuario = $controlaUE -> mostrarUsuario();
$mostrarEtiqueta = $controlaUE -> mostrarEtiqueta();
?>

<?php
    require_once('../layouts/navHome.php');
?>
<main class="main">
    <form action="../controladores/controlaUE.php" method="POST" class="edit-form">

    <?php   if ($_SESSION['idRol'] == 1) {
            echo "
            <br><br>
            <h3> ¿A qué usuario? </h3>
            <select type='text' name='idUsuario' id='idUsuario' >
            <option selected></option>
            ";
    
            foreach($mostrarUsuario as $usuario){
    
                echo "<option value= ".$usuario['idUsuario']. "> ".$usuario['nombreDeUsuario']." </option>";
    
            }
            echo "</select>";

        } else {
            echo "<input type='hidden' name='idUsuario' value=".$_SESSION['idUsuario'].">";
        } ?>
        <br><br>
        
        <h3> ¿Qué etiqueta? </h3>
        <?php
        echo "<select type='text' name='idEtiqueta' id='idEtiqueta' >
        <option selected></option>
        ";

        foreach($mostrarEtiqueta as $etiqueta){

            echo "<option value= ".$etiqueta['idEtiqueta']. "> ".$etiqueta['etiqueta']." </option>";

        }
        echo "</select>";
        
        ?>
        <br>
        <br>
        <h6 id="right-form"><button type="submit" name="registrar">Registrar</button></h6>
        <br>
        <br>
        <br>
        <h3>También puedes crear tu propia etiqueta:</h3>
        <br>    
        <h6 id="right-form"><button name="crear">Crear</button></h6>
        <br>
        <button type="submit" name="volver">Volver</button>
    </form>
</main>
<?php
    require_once('../layouts/footerHome.php');
?>