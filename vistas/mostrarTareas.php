<?php
require_once('../controladores/controlaTarea.php');

$controlaTareas = new controlaTareas();
$listarTarea = $controlaTareas->listarTarea();
//var_dump($listarCategoria);
?>
<?php
require_once('../layouts/navHome.php');
?>
<?php if($_SESSION['nombreDeUsuario'] == null){
    echo "<script>
      alert('Por favor actualice su contraseña y vuelva a iniciar sesión.');
      document.location.href='../vistas/mostrarUsuarios.php';
      </script>";
  } ?>
<main class="main">
    <div class="container">
        <?php if ($_SESSION['idRol'] == 1) { ?>
            <h1>Tareas</h1>
            <br>
            <a href="../controladores/controlaTarea.php?vistas=vistas/registrarTarea.php"><button> Registrar tarea </button></a>
            <br><br>
            <table id='example' class='display'>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Finaliza</th>
                        <th>Finaliza</th>
                        <th>Estado</th>
                        <th>Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($listarTarea as $tarea) {
                        echo '<tr>';
                        echo '<td>' . $tarea['idTarea'] . '</td>';
                        echo '<td>' . $tarea['nombreTarea'] . '</td>';
                        echo '<td>' . $tarea['fecha'] . '</td>';
                        echo '<td>' . $tarea['hora'] . '</td>';
                        echo '<td>' . $tarea['estado'] . '</td>';
                        echo '<td>' . $tarea['nombreDeUsuario'] . '</td>';
                        echo "<td>
                        <form method='POST' action='../controladores/controlaTarea.php'>
                        <input type='hidden' name='idTarea' value=" . $tarea['idTarea'] . " />
                        <button type='submit' name='editar'>Editar</button>
                        </form><br>";
                        echo "<a href='' onclick='validarEliminacion($tarea[idTarea])'><button> Eliminar </button></a></td></tr>";
                    } ?>
                <?php
            } else { ?>
                    <h1>Mis Tareas</h1>
                    <br>
                    <a href="../controladores/controlaTarea.php?vistas=vistas/registrarTarea.php"><button> Registrar </button></a>
                    <br><br>
                    <table id='example' class='display' >
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Finaliza</th>
                                <th>Finaliza</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($listarTarea as $tarea) {
                                echo '<tr>';

                                echo '<td>' . $tarea['nombreTarea'] . '</td>';
                                echo '<td>' . $tarea['fecha'] . '</td>';
                                echo '<td>' . $tarea['hora'] . '</td>';
                                echo '<td>' . $tarea['estado'] . '</td>';
                                echo "<td>
                                <form method='POST' action='../controladores/controlaTarea.php'>        
                                <input type='hidden' name='idTarea' value=" . $tarea['idTarea'] . " />";;

                                if ($tarea['idEstadoTarea'] != 3 && $tarea['idEstadoTarea'] != 4 ){ 

                                    echo "<button type='submit' name='editar'>Editar</button>";
                                }
                                echo "
                                </form><br>";
                                echo "<a href='' onclick='validarEliminacion($tarea[idTarea])'><button> Eliminar </button></a></td></tr>";
                            } ?>

                        <?php } ?>

                        </tbody>
                    </table>
    </div>
</main>
<script src="../assets/js/jquery-3.5.1.js"></script>
<script src="../assets/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            }
        });
    });
</script>
<script>
    function validarEliminacion(idTarea) {
        let eliminar = "";
        if (confirm('¿Estás seguro de eliminar la tarea?')) {
            document.location.href = "../controladores/controlaTarea.php?idTarea=" + idTarea + '&eliminar';
        }
    }
</script>
<?php
require_once('../layouts/footerHome.php');
?>