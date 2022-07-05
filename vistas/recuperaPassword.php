<?php

include('../layouts/navLogin.php');

?>

<div class="recupera-form">
  <form action="../controladores/controlaUsuarios.php" method="POST">
    <br>
    <h2 id="left-form">Restablecer contraseña</h2>
    <h4 id="left-form">Correo electrónico:</h4>
    <input type="email" name="correo">
    <h6 id="right-form"><input type="submit" value="Recuperar clave" name="recuperar"/></h6>
  </form>
</div>
<script src="../assets/js/scripts.js"></script>
    <script src="assets/js/scripts.js"></script>
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
  </body>
</html>