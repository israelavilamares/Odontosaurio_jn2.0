<?php

// CAMBIOOOOOO  obtenerInfoDoctor.php nuevo php que maneja la info con el id

require('conecta.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id !== null) {
    $sql = "SELECT * FROM doctor WHERE idDoctor = '$id'";
    $resultq = mysqli_query($con, $sql);

    while ($resultado = mysqli_fetch_array($resultq)) {
        ?>

        <ul>
            <li>Nombre: <?php echo $resultado["nombre"]; ?></li>
            <li>Contraseña: </li>
        </ul>
        <div class="linea-negra"></div>
        <h2 class="boton-lista">Editar información</h2>

       
            <?php
    }
} else {
    echo "No se proporcionó una ID válida en la solicitud.";
}
?>
        
 