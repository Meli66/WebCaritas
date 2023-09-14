<?php require_once('header.php');?>


<br><br>
<div>
    <div class="row">
        <div class="col-md-12">
            <div class="thumbnail text-center">
                <img src="../img/portada2.jpg" alt="Lights"
                    style="width:95%; border-radius:20px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8); ">
                <div class="text-center mt-5">
                    <h1 class="text-center"> Cáritas <span style=" font-style:oblique; color: firebrick;">-San Antonio
                            de Padua</span>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
<div class="container">
    <br>
    <!-- Carrousel -->
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>

        </ol>
        <div class="carousel-inner"
            style=" border-radius:20px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8); border: solid ;">
            <div class="carousel-item active">
                <img class="d-block w-100" src="../img/mural.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="../img/gente.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="../img/huerta.jpg" alt="Third slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="../img/dia_niño.jpg" alt="Third slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="../img/plaza1.jpg" alt="Third slide">
            </div>

        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
<br><br>

<?php require_once('footer.php');?>