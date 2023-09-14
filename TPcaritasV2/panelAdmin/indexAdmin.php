<?php require_once("../sistemas/headerAdmin.php");?>
<?php require_once ("../config/conexion.php"); ?>



<main style="background-color: floralwhite;">
    <br>
    <h1 style="font-weigth: boler;">Bienvenido </h1>
    <br>
    <br>
    <br>
    <br>
    <div class="container m-auto">
        <a class="p-4 m-5"
            style="color:white;background-color:cornflowerblue; font-weight:bold; text-decoration:none; border-radius : 12px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8); font-size: x-large; font-weigth: bold; border: solid black;"
            href="lista_proyectos.php">Proyectos</a>
        <a class="p-4 m-5"
            style="color:white;background-color:cornflowerblue; font-weight:bold; text-decoration:none; border-radius : 12px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8); font-size: x-large; font-weigth: bold;border: solid black; "
            href="../usuarios/lista_usuarios.php">Usuarios</a>
        <a class="p-4 m-5"
            style="color:white;background-color:cornflowerblue; font-weight:bold; text-decoration:none; border-radius : 12px; box-shadow: 3px 5px 5px rgba(3, 32, 51, .8);  font-size: x-large; font-weigth: bold;border: solid black;"
            href="lista_mensajes.php">Mensajes</a>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
    <br>
    <?php require_once('../sistemas/footerAdmin.php');?>