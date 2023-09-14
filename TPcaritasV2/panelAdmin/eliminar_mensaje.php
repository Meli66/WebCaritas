<?php
// Establecer la cabecera JSON
header('Content-Type: application/json');

// Habilitar informes de errores para depuración
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Respuesta predeterminada
$response = array('success' => false);

// Verificar si se ha enviado una solicitud POST con el parámetro 'idmensajes'
if (isset($_POST['idmensajes'])) {
    // Obtener el ID del mensaje a eliminar
    $idMensaje = $_POST['idmensajes'];

    // Incluir el archivo de configuración de la base de datos
    require_once("../config/conexion.php");

    // Escapar el ID del mensaje para evitar inyecciones SQL
    $idMensaje = mysqli_real_escape_string($conexion, $idMensaje);

    // Realizar la operación de eliminación en la base de datos
    $eliminarQuery = "DELETE FROM mensajes WHERE id = '$idMensaje'";
    $resultado = mysqli_query($conexion, $eliminarQuery);

    if ($resultado) {
        $response['success'] = true;
    }
}

// Enviar la respuesta JSON
echo json_encode($response);
?>