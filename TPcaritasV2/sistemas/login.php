<?php
session_start();

if(isset($_SESSION['active'])) {

    header("Location: ../panelAdmin/indexAdmin.php");

} else {

    if(isset($_POST)){

        if (isset($_POST['email']) && isset($_POST['contrasena'])) {
            require_once('../config/conexion.php');

            $email = mysqli_real_escape_string($conexion,$_POST['email']) ;
            $contrasena = md5(mysqli_real_escape_string($conexion,$_POST['contrasena']));
    
            $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE email = '$email' AND contrasena = '$contrasena'");
            mysqli_close($conexion);
            $result = mysqli_num_rows( $query);
            
            if ($result > 0) {
    
              $data = mysqli_fetch_array($query);
              
              $_SESSION['active'] = true;
              $_SESSION['id'] = $data['id'];
              $_SESSION['nombre'] = $data['nombre'];
              $_SESSION['email'] = $data['email'];
              $_SESSION['rol'] = $data['rol'];

            
              header("Location: ../panelAdmin/indexAdmin.php");
              
            } else {
                $alert = 'El usuario o la clave son incorrectos';
                session_destroy();
            }
        }  else {
            //$alert = 'Ingrese su usuario y contraseña';
        }  
    }

}

?>

<?php require_once('header.php');?>


<div class="container-fluid" style="background-image: url(../img/1.png);background-size:cover; height: 85vh;">

    <div class="container mb-4">
        <div class="d-flex justify-content-center align-items-center" style="height: 5rem;">
            <div class="container text-center">
                <h2 class="fs-6" style=" font-style:oblique; color: firebrick;">
                    <span style="color: black; font-style: normal; ">Ingresa a tu panel de</span>
                    - Administracion
                </h2>
            </div>
        </div>
        <br>
        <div class="container-fluid m-auto p-3 mb-6"
            style="width: 48%; background-color: rgba(179, 161, 161, 0.9);border-radius: 20px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);">
            <form method="post" action="">
                <div class="form-group">
                    <label style="font-weight: bolder;" for="email">Usuario:</label>
                    <input type="text" class="form-control" style="box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);"
                        placeholder="Ingrese su usuario" name="email" id="email" maxlength="40" minlength="4" required>
                </div>
                <br>
                <div class="form-group">
                    <label style="font-weight: bolder; " for="contrasena">Contraseña:</label>
                    <input type="password" class="form-control" style="box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);"
                        placeholder="Ingrese contrasena" name="contrasena" id="contrasena" maxlength="40" minlength="4"
                        required>
                </div>
                <div class="alert"><?php echo isset($alert)? $alert: '';  ?></div>

                <button type="submit" class="btn btn-primary border-radius: 20px; "
                    style="box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);">Ingresar</button>
        </div>
    </div>
</div>
<br>
<?php require_once('footer.php');?>