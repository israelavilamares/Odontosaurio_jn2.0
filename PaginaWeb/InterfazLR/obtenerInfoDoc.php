<?php

// CAMBIOOOOOO  obtenerInfoDoctor.php nuevo php que maneja la info con el id

require('conecta.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id !== null) {
    $sql = "SELECT * FROM doctor WHERE idDoctor = '$id'";
    $resultq = mysqli_query($con, $sql);

    while ($resultado = mysqli_fetch_array($resultq)) {
        ?>

          <form method="POST" action="updateIntDoc.php">
          <input type="hidden" name ="id" value="<?php echo $resultado[0];?>" required>
          <label>Nombre</label>
          <input  type="text"  name="nombre" value="<?php echo $resultado[1];?>" required>
          <label>especialidad</label>
          <input  type="text"  name="especialidad" value="<?php echo $resultado[3];  ?>" required>
          <div class="linea-negra"></div>
          <label>password</label>
          <input  type="password" name="pass" required>
          <label>telefono</label>
          <input  type="text"  name="telefono" value="<?php echo $resultado[4];  ?>"required>
          <label>edad</label>
          <input  type="text" name="edad" value="<?php echo $resultado[5];  ?>"required>
          <div class="linea-negra"></div> <!-- Agrega la línea negra aquí -->
          <input  class="boton-lista" type="submit" id="boton-Int-info-Doc" value="Editar">          
        </form> 
       
            <?php
    }
} else {
    echo "No se proporcionó una ID válida en la solicitud.";
}
?>
        
 