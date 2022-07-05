<?php

include('../layouts/navSignin.php');

?>

<div class="signin-form">
  <form action="../controladores/controlaUsuarios.php" method="POST">
    <br>
    <h2 id="left-form-signin">Registro</h2>
    <div class="user-box">
      <input type="text" name="nombre" required>
      <label>Nombre</label>
    </div>
    <div class="user-box">
      <input type="email" name="correo" required>
      <label>Correo electrónico</label>
    </div>
    <div class="user-box">
      <input type="text" name="username" required>
      <label>Nombre de usuario</label>
    </div>
    <div class="user-box">
      <input type="password" name="password" required>
      <label>Contraseña</label>
    </div>
    <button type="submit" name="registrar">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      Registrar
    </button>
    <p>
      ¿Ya tienes una cuenta?
    </p>
    <a href="login.php">Inicia sesión</a>
  </form>
</div>
<script src="../assets/js/scripts.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
  </body>
</html>