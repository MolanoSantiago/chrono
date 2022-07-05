<?php
session_start();
require_once('../controladores/controlaUsuarios.php');

$controlaUsuario = new controlaUsuarios();
$mostrarUsuario = $controlaUsuario->mostrarUsuario();
?>
<?php
require_once('../layouts/navHome.php');
?>

<main class="main">
        <?php if ($_SESSION['idRol'] == 1) { ?>
            <div class="container">
            <h1>Usuarios</h1>
            <br>
            <a href="../controladores/controlaUsuarios.php?vistas=vistas/signin.php"><button> Registrar nuevo usuario</button></a>
            <br><br>
            <table id="example" class="display">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Nombre de usuario</th>
                        <th>Contraseña</th>
                        <th>Creación</th>
                        <th>Descripción</th>
                        <th>Rol</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($mostrarUsuario as $usuario) {
                        echo "<tr>";
                        echo "<td>" . $usuario['idUsuario'] . "</td>";
                        echo "<td>" . $usuario['nombre'] . "</td>";
                        echo "<td>" . $usuario['correoElectronico'] . "</td>";
                        echo "<td>" . $usuario['nombreDeUsuario'] . "</td>";
                        echo "<td>" . $usuario['contrasena'] . "</td>";
                        echo "<td>" . $usuario['creacion'] . "</td>";
                        echo "<td>" . $usuario['descripcion'] . "</td>";
                        echo "<td>" . $usuario['rol'] . "</td>";
                        echo "<td>" . $usuario['estado'] . "</td>";
                        echo "<td><form method='POST' action='../controladores/controlaUsuarios.php'>
                  <input type='hidden' name='idUsuario' value=" . $usuario['idUsuario'] . " />
                  <button type='submit' name='editar'> Editar </button>
                  </form><br>";
                        echo "<a href='' onclick='validarEliminacion($usuario[idUsuario])'><button> Eliminar </button></a></td></tr>";
                    }
                    ?>
                <?php } else { ?>
                    <h1>Información personal</h1>
                    <br><br>
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Nombre de usuario</th>
                                <th>Contraseña</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($mostrarUsuario as $usuario) {
                                echo "<tr>";
                                echo "<td>" . $usuario['nombre'] . "</td>";
                                echo "<td>" . $usuario['correoElectronico'] . "</td>";
                                echo "<td>" . $usuario['nombreDeUsuario'] . "</td>";
                                echo "<td>" . $usuario['contrasena'] . "</td>";
                                echo "<td>" . $usuario['estado'] . "</td>";
                                echo "<td><form method='POST' action='../controladores/controlaUsuarios.php'>
                  <input type='hidden' name='idUsuario' value=" . $_SESSION['idUsuario'] . " />
                  <button type='submit' name='editar'> Editar </button>
                  </form>";
                            }
                            ?>
                        </tbody>
                    </table>
                    <br><br><br>
                    <h1>Seguridad</h1>
                    <br><br>
                    <p>
                        Configura el restablecimiento de tu contraseña en caso de olvidarla. <strong>Formula una pregunta lo suficientemente personal para que solo la puedas responder tú,</strong> así mismo, <strong>guardas la respuesta;</strong> en caso de olvidar la contraseña, la podrás recuperar respondiendo la pregunta.
                    </p>
                    <br>
                    <form method='POST' action='../controladores/controlaUsuarios.php'>
                        <input type='hidden' name='idUsuario' value="<?php $_SESSION['idUsuario'] ?>" />
                        <a href="ajustesPassword.php"><button type="submit" name="crear">Configurar</button></a>
                    </form>
                    
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
    function validarEliminacion(idUsuario) {
        let eliminar = "";
        if (confirm('Está seguro de eliminar el usuario?')) {
            document.location.href = "../controladores/controlaUsuarios.php?idUsuario=" + idUsuario + "&eliminar";
        }
    }
</script>
<?php
require_once('../layouts/footerHome.php');
?>