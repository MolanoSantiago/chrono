<?php

include('../layouts/navLogin.php');

include('../layouts/msjs.php');

?>

<div class="login-form">
  <form action="../controladores/controlaLogin.php" method="POST">
    <br>
    <h2 id="left-form">Iniciar sesión</h2>
    <div class="user-box">
      <input type="text" name="username" required>
      <label>Nombre de usuario</label>
    </div>
    <div class="user-box">
      <input type="password" name="password" required>
      <label>Contraseña</label>
    </div>
    <input type="hidden" id="accion" name="accion" value="Acceder" />
    <button type="submit" name="Acceder">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      Iniciar
    </button>
    <p>
      ¿Aún no tienes una cuenta?
    </p>
    <a href="signin.php">Regístrate</a>
    <p>
      ¿Olvidaste tu contraseña?
    </p>
    <a href="recuperaPassword.php">Recuperar contraseña</a>
  </form>
</div>
<script src="../assets/js/scripts.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
  </body>
</html>