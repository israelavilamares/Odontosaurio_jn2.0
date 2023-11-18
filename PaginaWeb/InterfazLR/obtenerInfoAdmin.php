<?php
// CAMBIOOOOOO  obtenerInfoAdmin.php nuevo php que maneja la info con el id

require('conecta.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id !== null) {
    $sql = "SELECT * FROM administrador WHERE idAdmin = '$id'";
    $resultq = mysqli_query($con, $sql);
    
    while ($resultado = mysqli_fetch_array($resultq)) {
    ?>
    
        <ul>
            <li style="text-align: center;" >Nombre: <?php echo $resultado[1]; ?></li>
            <li style="text-align: center;">Puesto: <?php echo $resultado[3]; ?> </li>
            <li style="text-align: center;">Edad: <?php echo $resultado[4]; ?></li>
            <li style="text-align: center;">Telefono: <?php echo $resultado[5]; ?></li>

        </ul>
        <div class="linea-negra"></div>
        <h2 class="boton-lista">Editar información</h2>
        <?php
    }
} else {
    echo "No se proporcionó una ID válida en la solicitud.";
}
?>