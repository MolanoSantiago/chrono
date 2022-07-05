<?php
require_once('../controladores/controlaTarea.php');
require_once('../controladores/controlatabla.php');

$controlatabla = new controlatabla();
$mostrartabla = $controlatabla->mostrartabla();
$mostrarPerfil = $controlatabla->mostrarPerfil();
//var_dump($listarCategoria);
$i= 1;

require_once('../layouts/navHome.php');
?>
<main class="main">
    <div class="container">
    <br>
    <h1>
        Usuarios con mayor número de tareas completadas
    </h1>
    <br><br>
    <table id='example' class='display'>
        <thead>
            <tr>
                <th>Top global</th>
                <th>Tareas completadas</th>
                <th>Usuario</th>
            </tr>
    </thead>
        <tbody>
            <?php
                 
                foreach($mostrarPerfil as $tablaz){
                    echo "<tr>";
                    echo "<td>".$i."</td>";
                    echo "<td>".$tablaz['Cantidad de Tareas']."</td>";
                   
                    echo "<td>
                    <form method='POST' action='../controladores/controladescripcion.php'>
                    <input type='hidden' name='idUsuario' value=" . $tablaz['idUsuario'] . " />
                    <input type='hidden' name='nombreDeUsuario' value=" . $tablaz['nombreDeUsuario'] . " />";
                    if($tablaz['descripcion']==null || $tablaz['descripcion']==' '){
                        echo "<input type='hidden' name='descripcion' value='' />";
                    }else{
                        echo"
                        <textarea name='descripcion' value=".$tablaz['descripcion']." style='display:none'>".$tablaz['descripcion']."
                        </textarea>";
                    }

                    echo " <input type='hidden' name='cantidad' value=".$tablaz['Cantidad de Tareas']." />";
                           
                            
                   echo"<button type='submit' name='mostrar'>".$tablaz['nombreDeUsuario']."</button>
                    </form>
                    </td>
                    </tr>";
                    $i++;
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

<?php
require_once('../layouts/footerHome.php');
?>
