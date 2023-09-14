<?php require_once('../sistemas/headerAdmin.php');?>

<?php require_once('../config/conexion.php');?>

<section id="container">
    <br>
    <br>
    <h1>Usuarios</h1>
    <a href="registro.php" class="btn_new p-2"
        style="border-radius: 8px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);">Crear
        usuario</a>
    <br>
    <br>
    <div class="d-flex align-content-start m-3">
        <a class="btn p-2 " href="../panelAdmin/indexAdmin.php"
            style="color:black; font-weight:bold; text-decoration:none; border-radius : 12px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);border: solid;">Volver</a>
    </div>
    <table class="container table-bordered" style="border-radius:10px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Email</th>
            <th>Rol</th>
            <th></th>
        </tr>

        <?php 

$query = mysqli_query($conexion, "SELECT u.id, u.nombre, u.apellido, u.email, r.descripcion FROM usuarios u INNER JOIN rol r ON u.rol = r.idrol");

$resultado = mysqli_num_rows($query);

if($resultado > 0){

    while ($data = mysqli_fetch_array($query)) {
 
 ?>
        <tr>
            <td><?php echo $data["id"] ?></td>
            <td><?php echo $data["nombre"] ?></td>
            <td><?php echo $data["apellido"] ?></td>
            <td><?php echo $data["email"] ?></td>
            <td><?php echo $data["descripcion"] ?></td>
            <td>
                <a class="link_edit p-2 btn-warning"
                    style="color:white; font-weight:bold; text-decoration:none; border-radius : 8px; " href="
                    editar_usuario.php?id=<?php echo $data["id"] ?>">Editar</a>

                <?php if ($data["id"] != 1): ?>
                <a class="link_delete p-2 btn-danger"
                    style="color:white; font-weight:bold; text-decoration:none; border-radius: 8px;"
                    href="eliminar_usuario.php?id=<?php echo $data["id"]; ?>">Eliminar</a>
                <?php endif; ?>


            </td>
        </tr>
        <?php
    }
}

?>



    </table>

    <br>
    <br>
    <br>
</section>









<?php require_once('../sistemas/footerAdmin.php');?>