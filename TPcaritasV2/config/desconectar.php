<?php 

session_start();
session_destroy();

header('location: ../sistemas/login.php');


?>