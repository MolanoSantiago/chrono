<?php
session_start();

require_once('../controladores/controlaUsuarios.php');

$idUsuario = $_REQUEST['idUsuario'];
$idUsuario = base64_decode($_REQUEST['idUsuario']);
$idUsuario = base64_decode($idUsuario);

$usuario =  $controlaUsuario->buscarRecupera($idUsuario);
?>

<?php
require_once('../layouts/navHome.php');
?>

<main class="main">
    <div class="edit-form">
        <form action="../controladores/controlaUsuarios.php" method="POST">
            <br>
            <h2 id="left-form">Restablecimiento dinámico</h2>
            <br><br>
            <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $_SESSION['idUsuario'] ?>" readonly/>
            <h4 id="left-form">Formula la pregunta:</h4>
            <textarea rows="12" cols="20" name="pregunta"  id="pregunta" required><?php echo $usuario->getpregunta()?></textarea>
            <br><br><br>
            <h4 id="left-form">Ahora ingresa la respuesta:</h4>
            <textarea rows="12" cols="20" name="respuesta"  id="respuesta" required><?php echo $usuario->getrespuesta()?></textarea>
            <br><br>
            <h6 id="right-form"><button type="submit" name="crear2"> Guardar </button></h6>
        </form>
    </div>
</main>

<?php
require_once('../layouts/footerHome.php');
?>