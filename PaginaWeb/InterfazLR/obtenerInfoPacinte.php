<?php

// CAMBIOOOOOO  obtenerInfoDoctor.php nuevo php que maneja la info con el id

require('conecta.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id !== null) {
    $sql = "SELECT * FROM paciente WHERE id = '$id'";
    $resultq = mysqli_query($con, $sql);

    while ($resultado = mysqli_fetch_array($resultq)) {
        ?>



        <input type="hidden" name ="id" value="<?php echo $resultado[0];?>" required>
        <ul>
        <li>Nombre:<?php echo $resultado[5]; ?></li>
        <li>CURP: <?php echo $resultado[1]; ?></li>
        <li>Numero celular: <?php echo $resultado[6]; ?></li>

          
          <div class="linea-negra"></div> <!-- Agrega la línea negra aquí -->
      </ul>
      <?php    $sql = "select nombre from doctor JOIN consulta ON  doctor.idDoctor=consulta.idDoctor_doctor WHERE idDoctor = '$resultado[1]' limit 1";
        $resultaq2 = mysqli_query($con, $sql);
        while ($resultadoND = mysqli_fetch_array($resultaq2)) { ?>

      <ul class="citas" id="lista2">
          <li>Numero cita:</li>
          <li>Fecha:</li>
          <li>Hora:</li>
          <li>Doctor a cargo:</li>
      </ul>
   <?php } ?>
      <button style="text-align: center;"><a href='deleteCitasIntAdm.php?id=<?php echo $resultado[0];?>' class="bto-eliminar">Eliminar</a></button>
            
        <?php
    }
} else {
    echo "No se proporcionó una ID válida en la solicitud.";
}
?>