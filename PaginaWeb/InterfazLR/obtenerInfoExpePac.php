<?php
require('conecta.php');

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id !== null) {
    $sql = "SELECT * FROM paciente WHERE id = '$id'";
    $resultq = mysqli_query($con, $sql);

    while ($resultado = mysqli_fetch_array($resultq)) {
        ?>
        <input type="hidden" name="id" value="<?php echo $resultado[0]; ?>" required>
        <ul>
            <li>Nombre:<?php echo $resultado[5]; ?></li>
            <li>CURP: <?php echo $resultado[1]; ?></li>
            <li>Número celular: <?php echo $resultado[6]; ?></li>
            <div class="linea-negra"></div> <!-- Agrega la línea negra aquí -->
            <h2 style="text-align: center;">Información del Expediente</h2>

            <!-- Realizar una consulta para obtener información adicional de la tabla expediente -->
            <?php
            $curp = $resultado['curp_usuario'];
            $sqlExpediente = "SELECT * FROM expediente WHERE curp = ?";
            
            $stmtExpediente = mysqli_prepare($con, $sqlExpediente);
            mysqli_stmt_bind_param($stmtExpediente, 's', $curp);
            mysqli_stmt_execute($stmtExpediente);
            $resultqExpediente = mysqli_stmt_get_result($stmtExpediente);
            $rowExpediente = mysqli_fetch_array($resultqExpediente);

            // Verificar si hay datos en el expediente
            if ($rowExpediente) {
                // Mostrar información del expediente
                ?>
                <ul>
                    <li>Motivo de consulta: <?php echo $rowExpediente['motivo_de_consulta']; ?></li>
                    <li>Padecimientos actuales: <?php echo $rowExpediente['padecimientos_actuales']; ?></li>
                    <li>Ultimo examen dental: <?php echo $rowExpediente['ultimo_examen_dental']; ?></li>
                    <li>Antecedentes médicos: <?php echo $rowExpediente['antecedentes_medicos']; ?></li>
                    <li>Doctor a cargo: <?php echo $rowExpediente['doctor_a_cargo']; ?></li>
                </ul>
                <?php
            } else {
                // Mostrar mensaje de que no hay expediente
                echo '<p style="text-align: center;">No hay expediente disponible para este paciente.</p>';
            }
            ?>

            <!-- También puedes agregar más detalles según sea necesario -->
        </ul>
    <?php
    }
} else {
    echo '<p style="text-align: center;">No se proporcionó una ID válida en la solicitud.</p>';
}
?>