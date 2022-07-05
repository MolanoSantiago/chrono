    <?php
    //Incluir el controlador a emplear
    require_once('../controladores/controlaTarea.php');
    //Recibir valor del id a busca

    $idTarea = base64_decode($_REQUEST['idTarea']);
    $idTarea = base64_decode($idTarea);
    //var_dump($idTarea);
    //base64_decode: Desencripta
    //Buscar la Tarea en la bd y guardarlo en un objeto
    $Tarea = $controlaTarea->buscarTareas($idTarea);
    $listarEstado = $controlaTarea->listarEstado();
    //var_dump($Tarea);
    ?>
    <?php
    require_once('../layouts/navHome.php');
    ?>
    <main class="main">
        <div class="edit-form">
            <br>
            <h2>Editar tarea</h2>
            <br>
            <form action="../controladores/controlaTarea.php" method="POST">
                <?php if ($_SESSION['idRol'] == 1) {
                    echo "
            <h4>Id Tarea:</h4>
            <input type='text' name='idTarea' id='idTarea' value=" . $Tarea->getidTarea() . " readonly/>";
                } else {
                    echo "<input type='hidden' name='idTarea' id='idTarea' value=" . $Tarea->getidTarea() . " readonly/>";
                }
                ?>
                <br><br>
                <h4>Nombre:</h4>
                <input type="text" name="nombreTarea" id="nombreTarea" value="<?php echo $Tarea->getnombreTarea() ?>" required />
                <br><br>
                <h4>Fecha:</h4>
                <input type="date" name="fecha" id="fecha" value="<?php echo $Tarea->getfecha() ?>" required />
                <br><br>
                <h4>Hora:</h4>
                <input type="time" name="hora" id="hora" value="<?php echo $Tarea->gethora() ?>" required />
                <br><br>
                <h4>Estado:</h4>

                <?php
                echo "<select type='text' name='idEstadoTarea' id='idEstadoTarea' required/>";

                echo "<option selected></option>";

                foreach ($listarEstado as $Tareaz) {
                    
                    if($Tareaz['idEstadoTarea'] != 4){
                
                        echo "<option value= ".$Tareaz['idEstadoTarea']. "> ".$Tareaz['estado']." </option>";
                    }
                }
                echo "</select>";

                ?>
                <br><br>
                <h6 id="right-form">
                    <button type="submit" name="actualizar" class="check">
                        Actualizar
                    </button>
                </h6>
            </form>
        </div>
    </main>
    <?php
    require_once('../layouts/footerHome.php');
    ?>