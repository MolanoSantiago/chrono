<?php
session_start();

require_once('../controladores/controlaUsuarios.php');

$idUsuario = $_REQUEST['idUsuario'];

$idUsuario = base64_decode($_REQUEST['idUsuario']);

$idUsuario = base64_decode($idUsuario);

$usuario =  $controlaUsuario->buscarUsuario($idUsuario);

$listarRoles = $controlaUsuario->listarRoles();
$listarEstadosUsuarios = $controlaUsuario->listarEstadosUsuarios();
?>

<?php
require_once('../layouts/navHome.php');
?>
<main class="main">
  <div class="edit-form">
    <form action="../controladores/controlaUsuarios.php" method="POST">
      <br>
      <h2 id="left-form">Editar usuario</h2>
      <br>
      <?php if ($_SESSION['idRol'] == 1) { ?>
        <h4 id="left-form">Id Usuario:</h4>
        <input type="number" name="idUsuario" id="idUsuario" value="<?php echo $usuario->getidUsuario() ?>" readonly>
        <br><br>
        <h4 id="left-form">Nombre:</h4>
        <input type="text" name="nombre" value="<?php echo $usuario->getnombre() ?>" required>
        <br><br>
        <h4 id="left-form">Correo electrónico:</h4>
        <input type="email" name="correo" value="<?php echo $usuario->getcorreo() ?>" required>
        <br><br>
        <h4 id="left-form">Nombre de usuario:</h4>
        <input type="text" name="username" value="<?php echo $usuario->getusername() ?>" required>
        <br><br>
        <h4 id="left-form">Contraseña:</h4>
        <input type="password" name="password" value="<?php echo $usuario->getpassword() ?>" required>
        <br><br>
        <h4 id="left-form">Descripción:</h4>
        <textarea name="descripcion" placeholder="Descripcion"><?php echo $usuario->getdescripcion() ?></textarea>
        <br><br>
        <h4 id="left-form">Rol:</h4>
        <?php

        echo "<select name='idRol' id='idRol'>";

        echo "<option selected></option>";

        foreach ($listarRoles as $usuario) {
          echo "<option value=" . $usuario['idRol'] . ">" . $usuario['rol'] . "</option>";
        }
        echo "</select>";
        ?>
        <br><br>
        <h4 id="left-form">Estado del usuario:</h4>
        <?php

        echo "<select name='idEstadoUsuario' id='idEstadoUsuario'>";

        echo "<option selected></option>";
        foreach ($listarEstadosUsuarios as $usuario) {
          echo "<option value=" . $usuario['idEstadoUsuario'] . ">" . $usuario['estado'] . "</option>";
        }
        echo "</select>";
        ?>
      <?php } else { ?>

        <input type='hidden' name='idUsuario' id='idUsuario' value=" <?php echo $_SESSION['idUsuario'] ?> ">
        <h4 id="left-form">Nombre: </h4>
        <input type="text" name="nombre" value="<?php echo $usuario->getnombre() ?>" required>
        <br><br>
        <h4 id="left-form">Correo electrónico:</h4>
        <input type="email" name="correo" value="<?php echo $usuario->getcorreo() ?>" required>
        <br><br>
        <h4 id="left-form">Nombre de usuario:</h4>
        <input type="text" name="username" value="<?php echo $usuario->getusername() ?>" required>
        <br><br>
        <h4 id="left-form">Contraseña:</h4>
        <input type="password" name="password" value="<?php echo $usuario->getpassword() ?>" required>
        <br><br>
        <input type='hidden' name='descripcion' id='descripcion' value=" <?php echo $usuario->getdescripcion() ?> ">
        <input type='hidden' name='idRol' id='idRol' value="<?php echo $usuario->getidRol()  ?> ">
        <h4 id="left-form">¿Deshabilitar cuenta?</h4>
        <br>
        <h4>
          Si deshabilitas tu cuenta, no podrás recuperarla.
        </h4>
        <br>
        <?php
        echo "<select name='idEstadoUsuario' id='idEstadoUsuario'>";
        foreach ($listarEstadosUsuarios as $usuario) {
          echo "<option value=" . $usuario['idEstadoUsuario'] . ">" . $usuario['estado'] . "</option>";
        }
        echo "</select>";
        ?>

      <?php } ?>
      <br><br>
      <h6 id="right-form"><button type="submit" name="actualizar"> Actualizar </button></h6>
    </form>
  </div>
</main>
<?php
require_once('../layouts/footerHome.php');
?>