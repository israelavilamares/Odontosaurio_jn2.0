<?php
// Conecta con la base de datos (reemplaza con tu código de conexión)
require "conecta.php";

// Recibe la consulta de búsqueda desde la solicitud POST
$query = isset($_POST['query']) ? $_POST['query'] : '';

// Realiza la consulta en la base de datos solo si 'query' está presente
if ($query !== '') {
    // Buscar en la tabla paciente
    $sql_paciente = "SELECT id, nombre, pasw, edad, telefono, curp_usuario, nacionalidad, NULL as especialidad, NULL as puesto FROM paciente WHERE nombre LIKE '%$query%'";

    $resultado = $con->query($sql_paciente);

    // Muestra los resultados
    if ($resultado->num_rows > 0) {
        while ($fila = $resultado->fetch_assoc()) {
            // Muestra los detalles específicos de la tabla paciente
            echo '<p>Nombre: ' . $fila['nombre'] . '</p>';
            echo '<p>Contraseña: ' . $fila['pasw'] . '</p>';
            echo '<p>Edad: ' . $fila['edad'] . '</p>';
            echo '<p>CURP: ' . $fila['curp_usuario'] . '</p>';
            echo '<p>Telefono: ' . $fila['telefono'] . '</p>';
            echo '<p>Nacionalidad: ' . $fila['nacionalidad'] . '</p>';
            
            // ... Otros detalles específicos de la tabla paciente
        }
    } else {
        echo 'No se encontraron resultados de pacientes con ese nombre';
    }
} else {
    echo 'La variable "query" no está presente en la solicitud';
}

// Cierra la conexión
$con->close();
?>