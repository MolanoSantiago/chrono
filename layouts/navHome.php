<?php
//Garantizar que si no se está logueado se envíe al index
if(!isset($_SESSION['idUsuario'])){
    header("Location: home.php");
}

if(isset($_REQUEST['pagina'])) //Si la variable página existe
{
    $pagina = $_REQUEST['pagina']; //Asignar a la variable $pagina la página.
}

?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="keywords" content="listas, organizar, planear, cumplir, productividad, chrono"/>
    <meta name="description" content="Chrono es un aplicativo web que ayuda a las personas a organizar, planear y cumplir sus metas diarias a través de listas, alertas, recordatorios y una comunidad competitiva."/>
    <meta name="author" content="Developers SENA" />
    <title>Chrono</title>
    <link rel="icon" href="https://cdn.glitch.global/91fdf4d6-f751-44f9-aed1-e69800538ba5/chrono.png?v=1647991822649"/>

    <link rel="stylesheet" href="../assets/css/home.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/jquery.dataTables.min.css">

  </head>

  <body id="body">
    
    <header>
        <div class="icon__menu">
            <i class="fas fa-bars" id="btn_open"></i>
        </div>
    </header>

    <div class="menu__side" id="menu_side">

        <div class="name__page">
          <img src="../assets/imgs/logo.svg" alt="">
          <h4>Chrono</h4>
        </div>

        <div class="options__menu">	

            <a href="home.php" class="" id="icono-nav">
                <div class="option">
                    <i class="fas fa-home" title="Inicio"></i>
                    <h4>Inicio</h4>
                </div>
            </a>
          <?php if($_SESSION['idRol']==1){ ?>
            <a href="mostrarUsuarios.php" class="" id="icono-nav">
                <div class="option">
                <i class="fa-solid fa-user" title="Usuarios"></i>
                    <h4>Usuarios</h4>
                </div>
            </a>
            
            <a href="mostrarTareas.php" class="" id="icono-nav">
                <div class="option">
                    <i class="fa-solid fa-list-check" title="Tareas"></i>
                    <h4>Tareas</h4>
                </div>
            </a>
            <a href="mostrarEtiquetas.php" class="" id="icono-nav">
                <div class="option">
                    <i class="fa-solid fa-tags" title="Etiquetas"></i>
                    <h4>Etiquetas</h4>
                </div>
            </a>
            <?php } else { ?>
            <a href="perfil.php" class="" id="icono-nav">
                <div class="option">
                    <i class="fa-solid fa-circle-user" title="Perfil"></i>
                    <h4>Mi Perfil</h4>
                </div>
            </a>

            <a href="mostrarTareas.php" class="" id="icono-nav">
                <div class="option">
                    <i class="fa-solid fa-list-check" title="Tareas"></i>
                    <h4>Mis Tareas</h4>
                </div>
            </a>

            <a href="mostrartabla.php" class="" id="icono-nav">
                <div class="option">
                    <i class="fa-solid fa-ranking-star"></i>
                    <h4>Ranking global</h4>
                </div>
            </a>

            <a href="mostrarUsuarios.php" class="" id="icono-nav">
                <div class="option">
                    <i class="fa-solid fa-user-gear" title="Ajustes"></i>
                    <h4>Ajustes</h4>
                </div>
            </a>
            <?php } ?>
            <a href="../controladores/controlaLogin.php?accion=Salir">
                <div class="option">
                    <i class="fa-solid fa-right-from-bracket" title="Cerrar sesión"></i>
                    <h4>Cerrar sesión</h4>
                </div>
            </a>

        </div>

    </div>