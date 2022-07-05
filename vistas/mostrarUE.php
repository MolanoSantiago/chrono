<?php
require_once('../controladores/controlaTarea.php');
require_once('../controladores/controlaUE.php');
$controlaUE = new controlaUE();
$mostrarUE = $controlaUE->mostrarUE(); //Llamado a función

?>
<?php
require_once('../layouts/navHome.php');
?>
<main class="main">
    <div class="container">
        <a href="../controladores/controlaUE.php?vistas=vistas/registrarUE.php"><button>Registrar</button></a>
        <br><br>
        <table id="example" class="display" style="width:100%">
            <thead>
                <?php if($_SESSION['idRol']==1){ ?>
                
                <tr>
                    <th>Usuario</th>       
                    <th>Etiqueta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                
                 <?php foreach ($mostrarUE as $mosUE) {
                    echo "<tr>";
                    echo "<td>" . $mosUE['nombreDeUsuario'] . "</td>";
                    echo "<td>" . $mosUE['etiqueta'] . "</td>";
                    echo "<td>
                    <a href='#' onclick='validarEliminacion($mosUE[idUsuarioEtiqueta])' ><button>Eliminar</button></a>
                    </td>";
                    echo "</tr>";
                    }?>

    <?php 
}else{ ?>
                
                <tr>

                    <th>Etiqueta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                
                <?php foreach ($mostrarUE as $mosUE) {
                    echo "<tr>";

                    echo "<td>" . $mosUE['etiqueta'] . "</td>";
                    echo "<td>
                    <a href='#' onclick='validarEliminacion($mosUE[idUsuarioEtiqueta])' ><button>Eliminar</button></a>
                    </td>";
                    echo "</tr>";
                }?>
        <?php
    } ?>
            
            </tbody>
        </table>
    </div>
</main>
<script>
    function validarEliminacion(idUsuarioEtiqueta) {
        let eliminar = "";
        if (confirm('¿Está seguro de eliminar la etiqueta?')) {
            document.location.href = "../controladores/controlaUE.php?idUsuarioEtiqueta=" + idUsuarioEtiqueta + "&eliminar";
        }
    }
</script>
<script src="../assets/js/jquery-3.5.1.js"></script>
<script src="../assets/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
            },
        });
    });
</script>
<?php
require_once('../layouts/footerHome.php');
?>