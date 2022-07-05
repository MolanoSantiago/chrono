<?php
require_once('../controladores/controlaTarea.php');
require_once('../controladores/controlaUsuarios.php');
include('../layouts/navHome.php');

$controlaTareas = new controlaTareas();
$listarTareaHoy = $controlaTareas->mostrarTareasHoy();
$mostrarUsuarios = $controlaUsuario -> mostrarPregunta();

foreach($mostrarUsuarios as $usuario){
  if($_SESSION['idRol']==1){
  }else{
    if($usuario['idUsuario'] == $_SESSION['idUsuario']){
      if($usuario['pregunta'] == null){
        echo "
        <script>
        alert('Para comenzar configura la seguridad de tu cuenta.');
        document.location.href = '../vistas/mostrarUsuarios.php';
       </script>
       ";
     }
   }
  }
}

?>
<main class="main">
  <div class="container">
    <?php if ($_SESSION['idRol'] == 1) { ?>
      <h1 class="title" style="--duration: 1s">
        <span style="--delay: .5s">¡Bienvenido Administrador!</span>
        <span style="--delay: .8s">¿Qué quieres hacer hoy?</span>
      </h1>
    <?php } else { ?>
      <h1 class="title" style="--duration: 1s">
        <span style="--delay: .5s">¡Hola <?php echo $_SESSION['nombreDeUsuario'] ?>!</span>
        <span style="--delay: .8s">¿Qué quieres hacer hoy?</span>
      </h1>
    <?php } ?>
    <?php if ($_SESSION['nombreDeUsuario'] == null) {
      echo "<script>
      alert('Por favor actualice su contraseña y vuelva a iniciar sesión.');
      document.location.href='../vistas/mostrarUsuarios.php';
      </script>";
    } ?>
    <?php if ($_SESSION['idRol'] == 1) { ?>

    <?php } else { ?>
      <br>
      <br>
      <button id="notificar">Quiero recibir notificaciones</button>
      <br>
      <br>
      <br>
      <h2>Tareas para hoy</h2>

      <br>
      <table id='example' class='display'>
        <thead>
          <tr>
            <th>Nombre</th>
            <th>Finaliza</th>
            <th>Finaliza</th>
            <th>Estado</th>

          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($listarTareaHoy as $tarea) {
            echo '<tr>';

            echo '<td>' . $tarea['nombreTarea'] . '</td>';
            echo '<td>' . $tarea['fecha'] . '</td>';
            echo '<td>' . $tarea['hora'] . '</td>';
            echo '<td>' . $tarea['estado'] . '</td>';
          } ?>
        </tbody>
      </table>
      
    <?php } ?>
    <br>
    
  </div>
</main>


<?php

include('../layouts/footerHome.php');

?>