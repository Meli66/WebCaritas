<?php
require_once('../sistemas/headerAdmin.php');
require_once('../config/conexion.php');

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['idmensajes'])) {
        $idMensaje = $_POST['idmensajes'];

        $eliminarQuery = "DELETE FROM mensajes WHERE id = $idMensaje";
        $resultado = mysqli_query($conexion, $eliminarQuery);

        if ($resultado) {
            $mensaje = "Mensaje eliminado con éxito";
        } else {
            $mensaje = "Error al eliminar el mensaje";
        }
    }
}

$query = mysqli_query($conexion, "SELECT * FROM mensajes");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lista de Mensajes</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
    <link rel="shortcut icon" href="img/caritas_icono.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <br>
    <h1>Nuestros Mensajes</h1>
    <br>
    <div class="d-flex align-content-start m-3">
        <a class="btn p-2 " href="indexAdmin.php"
            style="color:black; font-weight:bold; text-decoration:none; border-radius : 12px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);border: solid;">Volver</a>
    </div>
    <section id="container">
        <table class="container table-bordered"
            style="border-radius:10px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Email</th>
                <th>Motivo</th>
                <th>ComoNosConociste</th>
                <th>Comentario</th>
                <th></th>
            </tr>

            <?php 
            if ($query && mysqli_num_rows($query) > 0) {
                while ($data = mysqli_fetch_assoc($query)) {
                    echo '<tr>';
                    echo '<td>' . $data["id"] . '</td>';
                    echo '<td>' . $data["nombre"] . '</td>';
                    echo '<td>' . $data["telefono"] . '</td>';
                    echo '<td>' . $data["email"] . '</td>';
                    echo '<td>' . $data["motivo"] . '</td>';
                    echo '<td>' . $data["comoNosConociste"] . '</td>';
                    echo '<td>' . $data["comentario"] . '</td>';
                    echo '<td>';
                    echo '<button class="btn btn-danger btn-eliminar" data-id="' . $data['id'] . '">Eliminar</button>';
                    echo '</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="8">No se encontraron mensajes.</td></tr>';
            }
            ?>

        </table>
    </section>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>

    <?php if (!empty($mensaje)) : ?>
    <div class="alert <?php echo ($resultado === true) ? 'alert-success' : 'alert-danger'; ?>" role="alert">
        <?php echo $mensaje; ?>
    </div>
    <?php endif; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $.ajaxSetup({
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
            console.log(status);
            console.log(error);
        }
    });

    jQuery.noConflict();
    (function($) {
        $(document).ready(function() {
            $('.btn-eliminar').on('click', function() {
                var idmensajes = $(this).data('id');
                var botonEliminar = $(this);

                $.ajax({
                    url: 'eliminar_mensaje.php',
                    type: 'POST',
                    data: {
                        idmensajes: idmensajes
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            botonEliminar.closest('tr').remove();
                            alert('Mensaje borrado con éxito');
                        } else {
                            alert('Error al eliminar el mensaje');
                        }
                    },
                    error: function() {
                        alert('Error en la solicitud AJAX');
                    }
                });
            });
        });
    })(jQuery);
    </script>

    <?php require_once('../sistemas/footerAdmin.php'); ?>
</body>

</html>