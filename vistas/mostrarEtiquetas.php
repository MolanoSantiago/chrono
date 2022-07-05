<?php
require_once('../controladores/controlaTarea.php');
require_once('../controladores/controlaEtiquetas.php');

$controlaEtiquetas = new controlaEtiquetas();
$listaretiqueta = $controlaEtiquetas->listaretiqueta();
//var_dump($listaretiqueta);
?>
<?php
require_once('../layouts/navHome.php');
?>
<main class="main">
    <div class="container">
    <h1>Etiquetas</h1>
    <br>
        <a href="../controladores/controlaEtiquetas.php?vistas=vistas/registraretiqueta.php"><button> Registrar etiqueta </button></a>
        <a href='mostrarUE.php'><button> Etiquetas de usuarios </button></a>
        <br><br>
        <table id="example" class="display">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Etiqueta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($listaretiqueta as $etiquetaNueva) {
                    echo "<tr>";
                    echo "<td>" . $etiquetaNueva['idEtiqueta'] . "</td>";
                    echo "<td>" . $etiquetaNueva['etiqueta'] . "</td>";
                    echo "<td>
                    <form method='POST' action='../controladores/controlaEtiquetas.php'>
                    <input type='hidden' name='idEtiqueta' value=" . $etiquetaNueva['idEtiqueta'] . " />
                    <button type='submit' name='editar'>Editar</button>
                    </form><br>";
                    echo "<a href='' onclick='validarEliminacion($etiquetaNueva[idEtiqueta])'><button> Eliminar </button></a></td></tr>";
                }
                ?>
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
    function validarEliminacion(idEtiqueta) {
        let eliminar = "";
        if (confirm('¿Estás seguro de eliminar la etiqueta?')) {
            document.location.href = "../controladores/controlaEtiquetas.php?idEtiqueta=" + idEtiqueta + "&eliminar";
        }
    }
</script>
<?php
require_once('../layouts/footerHome.php');
?>