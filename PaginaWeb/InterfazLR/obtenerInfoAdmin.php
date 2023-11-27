<?php
// CAMBIOOOOOO  obtenerInfoAdmin.php nuevo php que maneja la info con el id

require('conecta.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id !== null) {
    $sql = "SELECT * FROM administrador WHERE idAdmin = '$id'";
    $resultq = mysqli_query($con, $sql);
    
    while ($resultado = mysqli_fetch_array($resultq)) {
    ?>

        <form action="updateIntAdm.php" method="POST">
            
            <input type="hidden" name="id" value="<?php echo $resultado[0]; ?>">
            <label>Nombre: </label>
            <input type="text" name="nombre"  value=" <?php echo $resultado[1]; ?>" required>
            <label  >Puesto: </label>
            <input type="text" name = "puesto" value="<?php echo $resultado[3]; ?>"required>
            <div class="linea-negra"></div>
            <label>Contraseña: </label>
            <input name = "pasw"  type="password" required>
            <label >Edad: </label>
            <input name = "edad" value="<?php echo $resultado[4]; ?>"required>
            <label >Número de teléfono: </label>
            <input name = "tel" value="<?php echo $resultado[5]; ?>"required>
            
            <div class="linea-negra"></div>
            <input  class="boton-lista" type="submit" value="Editar" >
        </form>
        <?php
    }
} else {
    echo "No se proporcionó una ID válida en la solicitud.";
}
?>