
<?php
include('../controladores/controlaUsuarios.php');

include('../layouts/navLogin.php');

include('../layouts/msjs.php');

$mostrarUsuarios = $controlaUsuario -> mostrarPregunta();

$correo = $_REQUEST['correo'];

foreach($mostrarUsuarios as $usuario){
  if($usuario['correoElectronico'] == $correo){
    if($usuario['pregunta'] == null){
      echo "
      <script>
      alert('No tienes registrada ninguna pregunta.');
      document.location.href = '../vistas/recuperaPassword.php';
      </script>
      ";
    }
  }
}

?>

<div class="login-form">
  <form action="../controladores/controlaRecupera.php" method="POST">
    <br>
    <h2 id="left-form">Recuperar acceso</h2>
    <h4 id="left-form">Pregunta:</h4>
    <?php
        foreach($mostrarUsuarios as $usuario){
          if($usuario['correoElectronico'] == $correo){
            
            echo "<textarea rows='9' cols='33' name='pregunta'  id='pregunta' required>".$usuario['pregunta']."</textarea>";
          }

        }
    ?>
    <h4 id="left-form">Respuesta:</h4>
    <input type="text" name="respuesta">
    <input type="hidden" name="correo" value="<?php echo $correo ?>" />

    <input type="hidden" id="accion" name="accion" value="Acceder" />
    <h6 id="right-form"><button type="submit" name="Acceder">Iniciar</button></h6>
  </form>
</div>
<script src="../assets/js/scripts.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
  </body>
</html>