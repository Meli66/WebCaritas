<?php require_once('../sistemas/headerAdmin.php');?>

<?php require_once('../config/conexion.php');?>

<?php
//session_start();
if($_SESSION['rol'] != 1 ){
  
  
  header("location: ../panelAdmin/indexAdmin.php"); 

}
?>

<?php
$proyectos = mysqli_query($conexion, "SELECT * FROM Proyecto");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lista de Proyectos</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/estilo.css">
    <link rel="shortcut icon" href="img/caritas_icono.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>



<body>
    <br>
    <h1>Proyectos</h1>

<?php $articulos=mysqli_query($conexion, "SELECT * FROM proyecto ;"); ?>
    
<!-- agrega un nuevo proyecto a la pagina -->
<?php 
   if (isset($_POST)) {
    if (!empty($_POST)) {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $img = $_FILES['foto'];
    $name = $img['name'];
    $tmpname = $img['tmp_name'];
    $fecha = date("YmdHis");
    $foto = $fecha . ".jpg";
    $destino = "../assets/img/" . $foto;
    $query = mysqli_query($conexion, "INSERT INTO proyecto(titulo, descripcion, imagen) VALUES ('$titulo', '$descripcion', '$foto')");
      if ($query) {
           if (move_uploaded_file($tmpname, $destino)) {
             header('Location: ../vista/proyecto.php');
           }
       }
   }
}
?>

 <!-- boton para sumar el recuerdo -->
   <br>
<div class="d-sm-flex align-items-center justify-content-center mb-4 ">
      <button class="d-none d-sm-inline-block btn btn btn-primary shadow-sm" data-toggle="modal" data-target="#productos"><i
            class="fas fa-plus fa-sm text-white-50"></i> Ingresar un nuevo proyecto</button>
</div> 

<!-- agregar una entrada nueva en proyecto -->
<div id= "productos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
       <div class="modal-dialog modal-lg border border-light" role="document">
           <div class="modal-content">
              <div class="modal-header bg-gradient-primary">
                  <h5 class="modal-title" id="title">Nuevo</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>

               <div class="modal-body">
                  <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                      <div class="row">
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="titulo">Titulo</label>
                                  <input id="titulo" class="form-control" type="text" name="titulo" placeholder="titulo"
                                    required>
                             </div>
                         </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="descripcion">Descripción</label>
                                  <textarea id="descripcion" class="form-control" name="descripcion"
                                    placeholder="Descripción" rows="3" required></textarea>
                             </div>
                         </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="imagen">Foto</label>
                                  <input type="file" class="form-control" name="foto" required>
                             </div>
                         </div>
                     </div>
                      <button class="btn btn-primary" type="submit" data-dismiss="modal">Agregar</button>
                 </form>
             </div>          
          </div>
      </div>
  </div>

  <?php $articulos=mysqli_query($conexion, "SELECT * FROM proyecto ;"); ?>


<!-- Editar un proyecto en la pagina -->
<?php 
if (isset($_POST['id']) && isset($_POST['titulo']) && isset($_POST['descripcion'])) {
    $proyectoId = $_POST['id'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $img = $_FILES['foto'];

    $proyectoExistente = mysqli_prepare($conexion, "SELECT * FROM proyecto WHERE id = ?");
    mysqli_stmt_bind_param($proyectoExistente, "i", $proyectoId);
    mysqli_stmt_execute($proyectoExistente);

    $proyectoResult = mysqli_stmt_get_result($proyectoExistente);
    

    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $img = $_FILES['foto'];
        $name = $img['name'];
        $tmpname = $img['tmp_name'];
        $fecha = date("YmdHis");
        $foto = $fecha . ".jpg";
        $destino = "../assets/img/" . $foto;
    
        $query = mysqli_prepare($conexion, "UPDATE proyecto SET titulo = ?, descripcion = ?, imagen = ? WHERE id = ?");
        mysqli_stmt_bind_param($query, "sssi", $titulo, $descripcion, $foto, $proyectoId);
        mysqli_stmt_execute($query);
    
        if (mysqli_stmt_affected_rows($query) > 0) {
            if (move_uploaded_file($tmpname, $destino)) {
                header('Location: ../vista/proyecto.php');
                exit();
            }
        }
    } else {
        // El proyecto no existe, mostrar un mensaje de error o realizar alguna otra acción
        echo "El ID del proyecto no es válido.";
    }
}
?>

<!-- boton para editar el proyecto  -->
<br>
<div class="d-sm-flex align-items-center justify-content-center mb-4 ">
      <button name="editarProducto"class="d-none d-sm-inline-block btn btn btn-primary shadow-sm"  data-toggle="modal" data-target="#editarProductos">
        <i class="fas fa-plus fa-sm text-white-50"></i> Editar un proyecto </button>
</div> 

<!-- editar nueva entrada en proyecto -->
<div id="editarProductos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
       <div class="modal-dialog modal-lg border border-light" role="document">
           <div class="modal-content">
              <div class="modal-header bg-gradient-primary">
                  <h5 class="modal-title" id="title">Editar proyecto</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
               <div class="modal-body">
                  <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                      <div class="row">

                          <div class="col-md-6">
                              <div class="form-group">
                                 <label for="id">ID</label>
                                  <input id="id" class="form-control" type="text" name="id" placeholder="ID del proyecto a editar" required>
                              </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="titulo">Titulo</label>
                                  <input id="titulo" class="form-control" type="text" name="titulo" placeholder="titulo"
                                    required>
                             </div>
                         </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="descripcion">Descripción</label>
                                  <textarea id="descripcion" class="form-control" name="descripcion"
                                    placeholder="Descripción" rows="3" required></textarea>
                             </div>
                         </div>
                          <div class="col-md-6">
                              <div class="form-group">
                                  <label for="imagen">Foto</label>
                                  <input type="file" class="form-control" name="foto" required>
                             </div>
                         </div>
                     </div>
                      <button class="btn btn-primary" type="submit">Editar</button>
                 </form>
             </div>          
          </div>
      </div>
  </div>
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
            <th>Titulo</th>
            <th>Descripcion</th>
            <th>Imagen</th>
            <th></th>
        </tr>

   <?php while ($proyecto = mysqli_fetch_assoc($proyectos)): ?>
  <tr>
      <td><?php echo $proyecto['id']; ?></td>
      <td><?php echo $proyecto['titulo']; ?></td>
      <td><?php echo $proyecto['descripcion']; ?></td>
      <td><img src="../assets/img/<?php echo $proyecto['imagen']; ?>" alt="Imagen del proyecto"
            style="max-width: 100px;"></td>
      <td>
     </td>

 </tr> 
  <?php endwhile; ?>




    </table>

    <br>
    <br>
    <br>
 
</section>


  




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <?php require_once('../sistemas/footerAdmin.php'); ?>
</body>

</html>







<?php require_once('../sistemas/footerAdmin.php');?>