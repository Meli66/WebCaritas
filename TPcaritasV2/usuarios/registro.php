
<?php require_once('../sistemas/headerAdmin.php');?>
<?php require_once('../config/conexion.php'); ?>


<?php

if(!empty($_POST)) {

    $alert='';
    if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['email']) || empty($_POST['contrasena']) ||
        empty($_POST['rol']))
        {
          $alert='<p>Todos los campos son obligatorios</p>';

        } else {

        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $contrasena = md5($_POST['contrasena']);
        $rol = $_POST['rol'];  
        
        $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email'" );  
        
        $result = mysqli_fetch_array($query);
        
        if($result > 0) {
          $alert='<p>Ya existe un correo asociado</p>';
        } else {

           $query_insert = mysqli_query($conexion, "INSERT INTO usuarios(nombre, apellido, email, contrasena, rol) 
                                                     VALUES ('$nombre','$apellido', '$email','$contrasena','$rol')"); 

          if($query_insert){
            $alert = '<p>Usuario creado correctamente</p>';

          } else {
            $alert = '<p>Error al crear el usuario</p>';

          }

          }    
       } 
  }


?>
<div class="alert"><?php echo isset($alert)? $alert: '';  ?></div>
<div class="d-flex align-content-start m-3">
        <a class="btn p-2 " href="../usuarios/lista_usuarios.php"
        style="color:black; font-weight:bold; text-decoration:none; border-radius : 12px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);border: solid;">Volver</a>
</div>
<div class="container-fluid m-auto p-4 mb-5">
    <form action="" method="POST">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre"
               >
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido"
                style=" box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" aria-describedby="emailHelp" name="email"
                style=" box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);">
        </div>
        <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input type="password" id="contrasena" class="form-control" aria-describedby="passwordHelpBlock"
                name="contrasena" style=" box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);" style="box-shadow: 3px 5px 5px
                rgba(3, 32, 51, .8)">
            <div id="passwordHelpBlock" class="form-text">
                Tu contraseña debe tener entre 8 y 20 carácteres, debe contener numeros y letras, y no puede contener
                espacios, caracteres especiales o emojis.
            </div>
            <br>
            <?php

$query_rol = mysqli_query($conexion, "SELECT * FROM rol");
mysqli_close($conexion);
$result_rol = mysqli_num_rows($query_rol);

?>

            <div class="mb-3">
                <label for="rol" class="form-label">Seleccionar rol</label>
                <select name="rol" id="rol">
                    <?php
    if( $result_rol > 0 ) {

          while ($rol = mysqli_fetch_array($query_rol)) {
?>
                    <option value="<?php echo $rol["idrol"] ?>"><?php echo $rol["descripcion"] ?></option>
                    <?php
          }
      }
?>

                </select>
            </div>
        </div>
        <input type="submit" class="btn_save btn-primary p-2" name="registro" value="Registrar">
    </form>
</div>
<br><br><br>

<?php require_once('../sistemas/footerAdmin.php');?>