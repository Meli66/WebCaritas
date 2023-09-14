<?php 

session_start();
if($_SESSION['rol'] != 1 ){
  
  header("location: ../panelAdmin/indexAdmin.php"); 
  
}

require_once('../config/conexion.php');
//redirecciona a la pagina de usuarios si no encuentra un id
if(empty($_GET['id'])) {

    header('location: lista_usuarios.php');  
}

$idusuario = $_GET['id'];
$query_sql = mysqli_query($conexion, "SELECT u.id, u.nombre, u.apellido, u.email, (u.rol) as idrol, (r.descripcion) as rol 
                                  FROM usuarios u 
                                  INNER JOIN rol r 
                                  on u.rol = r.idrol 
                                  WHERE id = $idusuario ");

$resultado_query = mysqli_num_rows($query_sql);

if($resultado_query == 0) {

  header('location: lista_usuarios.php');
} else {
  $opcion = '';
  while ($data = mysqli_fetch_array($query_sql) ) {
   
    $idusuario = $data['id'];
    $nombre = $data['nombre'];
    $apellido = $data['apellido'];
    $email = $data['email'];
    $idrol = $data['idrol'];
    $descripcion = $data['rol'];

    if($idrol == 1){
        $opcion = '<option value="'.$idrol.'" select>'.$descripcion.'</option>';
    } elseif ($idrol == 2) {
        $opcion = '<option value="'.$idrol.'" select>'.$descripcion .'</option>';
    } 
    }

  }

if(!empty($_POST)) {

    $alert='';
    if (empty($_POST['nombre']) || empty($_POST['apellido']) || empty($_POST['email']) || empty($_POST['rol']))
        {
          $alert='<p>Todos los campos son obligatorios</p>';

        } else {

        $idusuario = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];
        $contrasena = md5($_POST['contrasena']);
        $rol = $_POST['rol'];  // esto sera descripcion? 
        
        $query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email' AND id != $idusuario ");
        $result = mysqli_fetch_array($query);
        
        if($result > 0) {
          $alert='<p>Ya existe un correo asociado</p>';
        } else {

           if (empty($_POST['contrasena'])) {
            
              $actualizar_query = mysqli_query($conexion, "UPDATE usuarios
                                                            SET nombre = '$nombre', apellido = '$apellido', email = '$email', rol = '$rol' /*esto sera descripcion?*/ 
                                                            WHERE id = $idusuario "); 
           } else {

            $actualizar_query = mysqli_query($conexion, "UPDATE usuarios
                                                            SET nombre = '$nombre',apellido = '$apellido', email = '$email', contrasena = '$contrasena', rol = '$rol' /*esto sera descripcion?*/ 
                                                            WHERE id = $idusuario "); 
           }


          if($actualizar_query){
            $alert = '<p>Usuario actualizado correctamente</p>';

          } else {
            $alert = '<p>Error al actualizar el usuario</p>';

          }

          }    
       } 
  }


?>


<?php require_once('../sistemas/headerAdmin.php');?>

<div class="alert"><?php echo isset($alert)? $alert: '';  ?></div>
<div class="d-flex align-content-start m-3">
        <a class="btn p-2 " href="../usuarios/lista_usuarios.php"
        style="color:black; font-weight:bold; text-decoration:none; border-radius : 12px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);border: solid;">Volver</a>
</div>
<div class="container-fluid m-auto p-4 mb-5">
    <form action="" method=" POST">

        <input type="hidden" class="form-control" name="id" style="box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);"
            value="<?php echo $idusuario; ?>">

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" style="box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);"
                name="nombre" value="<?php echo $nombre; ?>">
        </div>
        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" class="form-control" id="apellido" style="box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);"
                name="apellido" value="<?php echo $apellido; ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" style="box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);"
                aria-describedby="emailHelp" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input type="password" id="contrasena" class="form-control"
                style="box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);" aria-describedby="passwordHelpBlock"
                name="contrasena">
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
                <select name="rol" id="rol" style="border-radius: 8px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);">
                    <?php
    echo $opcion;
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
        <input type="submit" class="btn_save btn-primary p-2"
            style="border-radius: 8px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);" name="Actualizar"
            value="Actualizar">
    </form>
</div>
<br><br><br>

<?php require_once('../sistemas/footerAdmin.php');?>