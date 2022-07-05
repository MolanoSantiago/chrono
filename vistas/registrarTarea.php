<?php

require_once('../controladores/controlaTarea.php');

$listarUsuario = $controlaTarea->listarUsuario();

?>
<?php
require_once('../layouts/navHome.php');
?>
<main class="main">
    <div class="edit-form">
        <form action="../controladores/controlaTarea.php" method="POST">
            <br>
            <h2 id="left-form">Registrar tarea</h2>
            <br>
            <h4 id="left-form">Nombre:</h4>
            <input type="text" name="nombreTarea" id="nombre" required />
            <br><br>
            <h4 id="left-form">Fecha:</h4>
            <input type="date" name="fecha" id="nombre" placeholder="AAAA-MM-DD" required />
            <br><br>
            <h4 id="left-form">Hora:</h4>
            <input type="time" name="hora" id="nombre" placeholder="00:00" required />


            <?php if ($_SESSION['idRol'] == 1) { ?>
                <br><br>
                <h4 id="left-form"> Usuario:</h4>
                <select type='text' name='idUsuario' id='idUsuario' required>

                    <option selected></option>

                    <?php foreach ($listarUsuario as $Tareaz) {

                        echo "<option value= " . $Tareaz['idUsuario'] . "> " . $Tareaz['nombreDeUsuario'] . " </option>";
                    } ?>
                </select>
            <?php } else {

                echo "<input type='hidden' name='idUsuario' id='idUsuario' value=" .$_SESSION['idUsuario']. " />";

             } ?>
            <br><br>
            <h6 id="right-form"><button type="submit" name="registrar">Registrar</button></h6>
        </form>
    </div>
</main>
<?php
require_once('../layouts/footerHome.php');
?>