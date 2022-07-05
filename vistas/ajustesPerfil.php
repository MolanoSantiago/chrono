<?php

require_once('../controladores/controladescripcion.php');
require_once('../controladores/controlaUE.php');

$controladescripcion = new controladescripcion();
$controlaUE = new controlaUE();

$listardescripcion = $controladescripcion->listardescripcion();
$mostrarUE = $controlaUE->mostrarUE();

$numEtiquetas = null;
?>

<?php
require_once('../layouts/navHome.php');
?>

<link rel="stylesheet" href="../assets/css/perfil.css">

<main class="main">
    <h1><?php echo $_SESSION['nombre']; ?></h1>
    <br><br>
    <div class="container">
        <div class="box">
            <?php if (file_exists("../assets/imgs/" . $_SESSION['idUsuario'] . ".jpg")) {

                echo '<div class="circular--landscape">
            <img src="' . $rutaImagenes . '" alt="Foto de perfil">
        </div>';
            } else { ?>
                <div class="circular--landscape">
                    <img src="../assets/imgs/index.jpg" alt="Foto de perfil">
                </div>
                <script>
                    alert("Nota: La foto de perfil debe ser cuadrada, JPEG, PNG o JPG y no debe exceder 2MB.");
                </script>
            <?php } ?>
        </div>
        <div class="box">
            <form method='POST' action='../controladores/controladescripcion.php'>
                <input type='hidden' name='idUsuario' value="<?php $_SESSION['idUsuario'] ?>" />
                <?php if (file_exists($rutaImagenes)) {

                    echo "<button  type='submit' name='editarF'>Cambiar foto de perfil</button>";
                } else {

                    echo " <button type='submit' name='editarF'>Agregar foto de perfil</button>";
                } ?>
            </form>
            <br>
            <form method='POST' action='../controladores/controladescripcion.php'>
                <input type='hidden' name='idUsuario' value="<?php $_SESSION['idUsuario'] ?>" />
                <button type='submit' name='eliminarF'>Eliminar foto de perfil</button>
            </form>
        </div>
    </div>
    <br><br>
    <div class="container">
        <div class="box">
            <div class="texto">
                <h4>
                    <?php
                    foreach ($mostrarUE as $etiqueta) {
                        echo " •" . $etiqueta['etiqueta'] . " ";
                        $numEtiquetas = $etiqueta['etiqueta'];
                    } ?>
                </h4>
            </div>
        </div>
        <?php if (strlen($numEtiquetas) > 0) { ?>
            <div class="box">
                <button><a href='mostrarUE.php'>Editar etiquetas</a></button>
            <?php } else { ?>
                <div class="box">
                    <button><a href='mostrarUE.php'>Agregar etiquetas</a></button>

                <?php }
                ?>
                </div>
            </div>
            <br><br>
            <div class="container">
                <div class="box">
                    <div class="texto">
                        <div class="blur-non-static">
                            <h4>
                                <?php foreach ($listardescripcion as $desc) {
                                    echo $desc['descripcion'];
                                    $numDescripcion = $desc['descripcion'];
                                } ?>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <form method='POST' action='../controladores/controladescripcion.php'>
                        <input type='hidden' name='idUsuario' value="<?php $_SESSION['idUsuario'] ?>" /><?php
                                                                                                        if (strlen($numDescripcion) > 0) { ?>
                            <br>
                            <button type='submit' name='editarD'>Cambiar descripción</button>
                        <?php } else { ?>
                            <br>
                            <button type='submit' name='editarD'>Agregar descripción</button>
                        <?php }
                        ?>
                    </form>
                    <br>
                    <form method='POST' action='../controladores/controladescripcion.php'>
                        <input type='hidden' name='idUsuario' value="<?php $_SESSION['idUsuario'] ?>" />
                        <button type='submit' name='eliminarD'>Eliminar descripción</button>
                    </form>
                </div>
            </div>
            <br><br>
            <a href="perfil.php"><button>Volver</button></a>
</main>





<?php
require_once('../layouts/footerHome.php');
?>