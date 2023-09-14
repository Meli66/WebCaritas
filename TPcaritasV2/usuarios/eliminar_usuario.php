<?php
require_once('../config/conexion.php');

session_start();
if($_SESSION['rol'] != 1 ){
  
  
  header("location: ../panelAdmin/indexAdmin.php"); 
  
}

if (isset($_POST['idusuario'])) {
    $idusuario = $_POST['idusuario'];
    $query_borrar = mysqli_query($conexion, "DELETE FROM usuarios WHERE id = $idusuario");

    if ($query_borrar) {
        header("Location: lista_usuarios.php");
        exit(); // Aseguramos que el script se detenga después de redireccionar
    } else {
        echo "Error al eliminar el usuario seleccionado";
    }
} elseif (isset($_GET['id'])) {
    $idusuario = $_GET['id'];
    $query = mysqli_query($conexion, "SELECT u.nombre, u.email, r.descripcion
                                      FROM usuarios u
                                      INNER JOIN rol r ON u.rol = r.idrol
                                      WHERE u.id = $idusuario");

    $data = mysqli_fetch_assoc($query); // Obtener una sola fila como un arreglo asociativo

    if ($data) {
        $nombre = $data['nombre'];
        $email = $data['email'];
        $rol = $data['descripcion'];
    } else {
        header("Location: lista_usuarios.php");
        exit(); // Aseguramos que el script se detenga después de redireccionar
    }
} else {
    header("Location: lista_usuarios.php");
    exit(); // Aseguramos que el script se detenga después de redireccionar
}

require_once('../sistemas/headerAdmin.php');
?>

<section>
    <h1>Eliminar usuario</h1>

    <div class="data_delete">
        <h2>¿Está seguro de eliminar el siguiente registro?</h2>
        <p>Nombre: <span><?php echo $nombre; ?></span></p>
        <p>Email: <span><?php echo $email; ?></span></p>
        <p>Rol: <span><?php echo $rol; ?></span></p>

        <form method="POST" action="">
            <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?>">
            <a href="lista_usuarios.php" class="btn_cancel">Volver</a>
            <input type="submit" value="Eliminar" class="btn_ok p-2 ">
        </form>
    </div>
</section>

<?php require_once('../sistemas/footerAdmin.php'); ?>