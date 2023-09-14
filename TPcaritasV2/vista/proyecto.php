<?php require_once('../sistemas/header.php');?>
<?php require_once "../config/conexion.php"; ?>
<?php require_once "../sistemas/helper_paginador.php"; ?>
<?php
$articulos=mysqli_query($conexion, "SELECT * FROM proyecto ;");
$num_registros=@mysqli_num_rows($articulos);

//define los parametros del paginador en la pagina
$pag = $_GET['pag'] ?? 1;
$registros_por_pagina = 6;
$cantidad_registros = $num_registros;
$paginas = paginador($pag, $cantidad_registros, $registros_por_pagina);
$desde = ($pag - 1) * $registros_por_pagina;
?>

<!-- Body -->
<main style="background-color: floralwhite;">
    <br>
    <div class="row text-center mt-5 mb-1">
        <div class="col-md-12 container-fluid">
            <div class=" container ">
                <img src=" ../img/portada-proyecto.jpg" alt="Lights" style="width:70%;
                height= 30%; border-radius:20px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8); ">
            </div>
        </div>
    </div>
    <br>
    <br>
    <div class="container text-center">
        <h1 style=" font-style:oblique; color: firebrick;">Nuestros proyectos</h1>
    </div>
    <br>
    <div class=" container-fluid d-flex row w-auto justify-content-center pt-4 pb-4">
        <?php
                $proyecto = mysqli_query($conexion, "SELECT p.* FROM proyecto p LIMIT $desde, $registros_por_pagina;");
                $query = mysqli_query($conexion, "SELECT p.* FROM proyecto p LIMIT $desde, $registros_por_pagina;");
                $result = mysqli_num_rows($query);
                foreach ($proyecto as $proyect) { ?>
        <div class="card m-5 bg-dark h-80"
            style="width: 20rem; border-radius:20px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);">
            <img class="card-img-top" style="border-radius:20px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);"
                src="../assets/img/<?php echo $proyect['imagen']?>" alt="imagen1" />
            <div class="card-body text-white">
                <h5 class="card-title"><?php echo $proyect['titulo']?></h5>
                <p class="card-text"><?php echo $proyect['descripcion']?></p>
            </div>
        </div>
        <?php  } ?>
        <div class="container">
            <nav aria-label="...">
                <ul class="pagination">
                    <?php if($paginas['anterior']){?>
                    <li class="page-item">
                        <a class="page-link" href="?pag-<?php echo $paginas['primera'] ?>" tabindex="-1">Primera
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link"
                            href="?pag=<?php echo $paginas ['anterior'] ?>"><?php echo $paginas['anterior']; ?></a>
                    </li>
                    <?php } ?>
                    <li class="page-item active">
                        <a class="page-link disabled" href="#"><?php echo $paginas['actual'] ?></a>
                    </li>
                    <?php if($paginas['siguiente']){?>
                    <li class="page-item">
                        <a class="page-link"
                            href="?pag=<?php echo $paginas['siguiente'] ?>"><?php echo $paginas['siguiente']; ?></a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="?pag=<?php echo $paginas['ultima'] ?>">Última </a>
                    </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
</main>
<?php require_once('../sistemas/footer.php');?>