<?php 
if (isset($_POST['editar'])) {
    // Llamamos a la función "conecta" que sirve para conectar con la base de datos
    require "conecta.php";
    // Traemos todas las funciones para verificar
    require "verificar.php";

    // Variables POST
    $curp = $_SESSION['curp']; 
    $nombre = $_POST["nombre_edit"];
    $tel = $_POST["telefono"];
    $nac = $_POST["nacionalidad_edit"];
    $edad = $_POST["edad_edit"];

    // Consulta preparada para actualizar la información del paciente
    $sql = "UPDATE paciente SET nombre=?, telefono=?, nacionalidad=?, edad=? WHERE curp_usuario=?";
    $stmt = $con->prepare($sql);

    // Vincular parámetros
    $stmt->bind_param("sssss", $nombre, $tel, $nac, $edad, $curp);

    // Ejecutar la consulta
    if ($stmt->execute()) {                               
        // Después de ejecutar la consulta de actualización
        // Vuelve a cargar los datos de la sesión
        $_SESSION['nombre'] = $nombre;
        $_SESSION['edad'] = $edad;
        $_SESSION['tel'] = $tel;
        $_SESSION['nacionalidad'] = $nac;

        echo '<div class="mensaje-correcto">Edición exitosa</div>';
        // Redirige al formulario de inicio de sesión
        header("Location: interfazPaciente.php");
        // Es buena práctica terminar el script después de una redirección
        exit();
    } else {
        // Error en la actualización
        echo "Error: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $con->close();
}
?>