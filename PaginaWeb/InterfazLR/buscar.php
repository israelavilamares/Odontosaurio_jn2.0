<?php
// Conecta con la base de datos (reemplaza con tu código de conexión)
require "conecta.php";

// Recibe la consulta de búsqueda desde la solicitud POST
$query = isset($_POST['query']) ? $_POST['query'] : '';

// Realiza la consulta en la base de datos solo si 'query' está presente
if ($query !== '') {
   // Buscar en la tabla paciente
$sql_paciente = "SELECT id, nombre, pasw, edad, telefono, curp_usuario, nacionalidad, NULL as especialidad, NULL as puesto FROM paciente WHERE nombre LIKE '%$query%'";

// Buscar en la tabla doctor
$sql_doctor = "SELECT idDoctor as id, nombre, pasw, edad, telefono, NULL as curp_usuario, NULL as nacionalidad, especialidad, NULL as puesto FROM doctor WHERE nombre LIKE '%$query%'";

// Buscar en la tabla administrador
$sql_administrador = "SELECT idAdmin as id, nombre, pasw, edad, telefono, NULL as curp_usuario, NULL as nacionalidad, NULL as especialidad, puesto FROM administrador WHERE nombre LIKE '%$query%'";

// Unir los resultados de las tres consultas utilizando UNION
$sql = "$sql_paciente UNION $sql_doctor UNION $sql_administrador";

$resultado = $con->query($sql);

// Muestra los resultados
if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        // Identifica de qué tabla proviene la entidad y muestra los detalles correspondientes
        if (isset($fila['curp_usuario'])) { // Esto indica que es un paciente
            echo '<p>Nombre: ' . $fila['nombre'] . '</p>';
            echo '<p>Contraseña: ' . $fila['pasw'] . '</p>';
            echo '<p>Edad: ' . $fila['edad'] . '</p>';
            echo '<p>CURP: ' . $fila['curp_usuario'] . '</p>';
            echo '<p>Telefono: ' . $fila['telefono'] . '</p>';
            echo '<p>Nacionalidad: ' . $fila['nacionalidad'] . '</p>';
            // ... Otros detalles específicos de la tabla paciente
        } elseif (isset($fila['especialidad'])) { // Esto indica que es un doctor
            echo '<p>Nombre: ' . $fila['nombre'] . '</p>';
            echo '<p>Contraseña: ' . $fila['pasw'] . '</p>';
            echo '<p>Especialidad: ' . $fila['especialidad'] . '</p>';
            echo '<p>Edad: ' . $fila['edad'] . '</p>';
            echo '<p>Telefono: ' . $fila['telefono'] . '</p>';
            // ... Otros detalles específicos de la tabla doctor
        } elseif (isset($fila['puesto'])) { // Esto indica que es un administrador
            echo '<p>Nombre: ' . $fila['nombre'] . '</p>';
            echo '<p>Contraseña: ' . $fila['pasw'] . '</p>';
            echo '<p>Edad: ' . $fila['edad'] . '</p>';
            echo '<p>Puesto: ' . $fila['puesto'] . '</p>';
            echo '<p>Telefono: ' . $fila['telefono'] . '</p>';
            // ... Otros detalles específicos de la tabla administrador
        }
    }
} else {
    echo 'No se encontraron resultados';
}
} else {
    echo 'La variable "query" no está presente en la solicitud';
}

// Cierra la conexión
$con->close();
?>