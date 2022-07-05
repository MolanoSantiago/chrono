<?php
//Incluir el controlador a emplear
require_once('../controladores/controlaUE.php');
//Recibir valor del id a busca
$idUsuarioEtiqueta = base64_decode($_REQUEST['idUsuarioEtiqueta']);
$idUsuarioEtiqueta = base64_decode($idUsuarioEtiqueta);
//base64_decode: Desencripta
//Buscar la Tarea en la bd y guardarlo en un objeto
$UsuarioEtiqueta = $controlaUE->buscarUE($idUsuarioEtiqueta);
$mostrarUsuario = $controlaUE-> mostrarUsuario();
$mostrarEtiqueta = $controlaUE -> mostrarEtiqueta();
//var_dump($Tarea);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
</head>

<body>
    <h1 align='center'>Editar Etiqueta</h1>
    <form action="../controladores/controlaUE.php" method="POST">
    <?php   if ($_SESSION['idRol'] == 1) {
                    echo "
            <h4>IdUsuarioEtiqueta:</h4>
            <input type='text' name='idUsuarioEtiqueta' id='idUsuarioEtiqueta' value=".$UsuarioEtiqueta->getidUsuarioEtiqueta()." readonly/>";
        } else {
            echo "<input type='hidden' name='idUsuarioEtiqueta' id='idUsuarioEtiqueta' value=".$UsuarioEtiqueta->getidUsuarioEtiqueta() ." readonly/>";
        } ?>
       
       
       
        <label>Etiqueta:</label>
        
        <?php
        echo "<select type='text' name='idEtiqueta' id='idEtiqueta' required/>";

        foreach($mostrarEtiqueta as $etiqueta){

            echo "<option value= ".$etiqueta['idEtiqueta']. "> ".$etiqueta['etiqueta']." </option>";

        }
        echo "</select>";
        
        ?>

        <br>
        
        
        <input type="hidden" name="idUsuario" value="1">

        

        <button type="submit" name="actualizar">Actualizar</button>
    </form>
</body>
</html>