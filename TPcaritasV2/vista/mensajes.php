<?php require_once('../sistemas/header.php'); ?>
<?php require_once "../config/conexion.php"; ?>
<html lang="en">


<?php


$mensaje = ""; // Inicializamos la variable del mensaje

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['nombre']) && !empty($_POST['telefono']) && !empty($_POST['email'])) {
        $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
        $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
        $email = mysqli_real_escape_string($conexion, $_POST['email']);
        $motivo = mysqli_real_escape_string($conexion, $_POST['motivo']);
        $comoNosConociste = mysqli_real_escape_string($conexion, $_POST['comoNosConociste']);
        $comentario = mysqli_real_escape_string($conexion, $_POST['comentario']);

        $consulta = "INSERT INTO mensajes(nombre, telefono, email, motivo, comoNosConociste, comentario) 
                     VALUES ('$nombre','$telefono','$email','$motivo', '$comoNosConociste','$comentario')";
        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado) {
            $mensaje = "Consulta enviada con éxito";
        } else {
            $mensaje = "Error al enviar la consulta: " . mysqli_error($conexion); // Mostrar el mensaje de error de la base de datos
        }
    } else {
        $mensaje = "Por favor, completa todos los campos requeridos";
    }
}

?>
<main class="container-fluid m-auto" style="background-color: floralwhite;">
    <?php if (!empty($mensaje)) : ?>
    <div class="alert <?php echo ($resultado) ? 'alert-success' : 'alert-danger'; ?>" role="alert" id="mensajeAlerta"
        style="border-radius:20px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);">
        <?php echo $mensaje; ?>
    </div>
    <script>
    // Ocultar la alerta después de 2 segundos
    setTimeout(function() {
        $('#mensajeAlerta').hide('slow');
    }, 2000); // 2 milisegundos = 5 segundos
    </script>
    <?php endif; ?>
    <div class="container text-center">
        <br>
        <h1 class="fs-1" style="font-weigth: bold;">¿Te interesa ser voluntario o ayudar a la fundacion?</h1>
        <h3 class="fs-1" style="font-style: oblique;">¡Dejanos tus datos y nos comunicamos con vos a la brevedad!
        </h3>
    </div>

    <div class="container-fluid mt-5 mb-5 text-center">
        <iframe width="853" height="480" src="https://www.youtube.com/embed/_7adZhy9L4I"
            style="border-radius:20px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);"
            title="Sumate a la Red de Voluntariado Joven de Cáritas" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
    </div>

    <div class="container text-center pb-5">
        <h2 style=" font-style:oblique; color: firebrick;"> ¿COMO PUEDO AYUDAR?</h2>
    </div>

    <div class="container  align-self-start">
        <div class="card text-center" style="border-radius:20px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);">
            <div class="card-header text-white" style="background-color: #00BFFF; border-radius:20px;
                    box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);"></div>
            <div class=" card-body">
                <h5 class="card-title">DONACION DE ROPA</h5>
                <p class="card-text">
                    ¿Me pondría yo la ropa que estoy separando para dar? Si la respuesta es no, tampoco sirve para
                    donar.<br>
                    Doná ropa lista para usar: limpia, completa, que no le falten botones o cierres.<br>
                    Si vas a donar en ocasión de una emergencia, por favor entregala en bolsas o cajas, clasificada
                    para hombre, mujer o niño.<br>
                </p>
            </div>
        </div>
    </div>

    <br><br>

    <div class="container  align-self-center">
        <div class="card text-center" style="border-radius:20px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);">
            <div class="card-header text-white" style="background-color: #00CED1; border-radius:20px;
                    box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);"></div>
            <div class=" card-body">
                <h5 class="card-title">DONACION DE ALIMENTOS</h5>
                <p class="card-text">Controlar la fecha de vencimiento y que los envases estén sellados
                    herméticamente de fábrica.</p>
            </div>
        </div>
    </div>

    <br><br>

    <div class="container  ">
        <div class="card text-center" style="border-radius:20px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);">
            <div class="card-header text-white" style="background-color: #CD5C5C; border-radius:20px;
                    box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);"></div>
            <div class=" card-body">
                <h5 class="card-title">DONACION DE MEDICAMENTOS</h5>
                <p class="card-text">Controlar la fecha de vencimiento del medicamento antes de ser donado.</p>
            </div>
        </div>
    </div>

    <br><br>




    <div class="container p-auto mb-4 border border-black"
        style="width: 60%; background-color: rgba(179, 161, 161, 0.9);border-radius: 20px;  box-shadow: 3px 5px 5px rgba(3, 32, 51, .8); ">
        <h3>Contactanos:</h3>

        <form action="" method="POST" autocomplete="off" class="mb-3">
            <div class="mb-2">
                <label for="exampleFormControlInput1" class="form-label">Nombre</label>
                <input type="name" name="nombre" class="form-control"
                    style=" box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);" id="exampleFormControlInput1" placeholder=""
                    require>
            </div>
            <div class="mb-2">
                <label for="exampleFormControlInput1" class="form-label">Teléfono</label>
                <input type="number" name="telefono" class="form-control"
                    style=" box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);" id="exampleFormControlInput1" placeholder=""
                    require>
            </div>

            <div class="mb-2">
                <label for="exampleFormControlInput1" class="form-label">Dirección</label>
                <input type="name" name="direccion" class="form-control"
                    style=" box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);" id="exampleFormControlInput1" placeholder=""
                    require>
            </div>
            <div class="mb-2">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                    style=" box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);" id="exampleFormControlInput1" placeholder=""
                    require>
            </div>

            <div class="mb-2">
                <select class="form-select mb-1"
                    style="border-radius: 5px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);"
                    aria-label="Default select example" name="motivo">
                    <option selected>Motivo</option>
                    <option value="voluntariado">Voluntariado</option>
                    <option value="donacion">Donacion</option>
                    <option value="consultas">Consultas</option>
                </select>

            </div>

            <div class="mb-1">
                <select class="form-select mt-1"
                    style="border-radius: 5px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);"
                    aria-label="Default select example" name="comoNosConociste">
                    <option selected>¿Cómo nos conociste?</option>
                    <option value="redes sociales">Redes sociales</option>
                    <option value="google">Google</option>
                    <option value="conocido">Conocido</option>
                    <option value="otro">Otro</option>
                </select>

            </div>

            <div class="mb-1">
                <label for="exampleFormControlTextarea1" class="form-label">Dejanos un mensaje</label>
                <textarea class="form-control" name="comentario" style=" box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);"
                    id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div>
                <input class="bg-primary" type="submit" name="enviar" style="border-radius: 6px; box-shadow:
                        3px 5px 5px rgba(3, 32, 51, .8);" value=" Enviar consulta">
            </div>
        </form>

    </div>

    <br>
</main>

<?php require_once('../sistemas/footer.php'); ?>

</html>