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
            <h2 style="text-align: center;">Información del expediente</h2>

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
                // Mostrar formulario para editar el expediente
                ?>
                <form method="post" action="guardar_expedienteDoc.php">
                    <input type="hidden" name="curp" value="<?php echo $resultado['curp_usuario']; ?>">
                     <label for="motivo_consulta">Motivo de consulta:</label>
                     <input type="text" name="motivo_consulta" value="<?php echo $rowExpediente['motivo_de_consulta']; ?>">

                       <label for="padecimientos_actuales">Padecimientos actuales:</label>
                    <input type="text" name="padecimientos_actuales" value="<?php echo $rowExpediente['padecimientos_actuales']; ?>">

                   <label for="ultimo_examen_dental">Ultimo examen dental:</label>
                    <input type="text" name="ultimo_examen_dental" value="<?php echo $rowExpediente['ultimo_examen_dental']; ?>">

                   <label for="antecedentes_medicos">Antecedentes médicos:</label>
                    <input type="text" name="antecedentes_medicos" value="<?php echo $rowExpediente['antecedentes_medicos']; ?>">

                   <label for="doctor_a_cargo">Doctor a cargo:</label>
                   <input type="text" name="doctor_a_cargo" value="<?php echo $rowExpediente['doctor_a_cargo']; ?>">

                   <button type="submit">Guardar cambios</button>
                </form>
                <?php
            } else {
                // El expediente no existe, mostrar un formulario para crearlo
                ?>
                <form method="post" action="guardar_expedienteDoc.php">
    <input type="hidden" name="curp" value="<?php echo $resultado['curp_usuario']; ?>">
    
    <label for="motivo_consulta">Motivo de consulta:</label>
    <input type="text" name="motivo_consulta" value="<?php echo $rowExpediente ? $rowExpediente['motivo_de_consulta'] : ''; ?>">

    <label for="padecimientos_actuales">Padecimientos actuales:</label>
    <input type="text" name="padecimientos_actuales" value="<?php echo $rowExpediente ? $rowExpediente['padecimientos_actuales'] : ''; ?>">

    <label for="ultimo_examen_dental">Último examen dental:</label>
    <input type="text" name="ultimo_examen_dental" value="<?php echo $rowExpediente ? $rowExpediente['ultimo_examen_dental'] : ''; ?>">

    <label for="antecedentes_medicos">Antecedentes médicos:</label>
    <input type="text" name="antecedentes_medicos" value="<?php echo $rowExpediente ? $rowExpediente['antecedentes_medicos'] : ''; ?>">

    <label for="doctor_a_cargo">Doctor a cargo:</label>
    <input type="text" name="doctor_a_cargo" value="<?php echo $rowExpediente ? $rowExpediente['doctor_a_cargo'] : ''; ?>">

    <button type="submit">Guardar cambios</button>
</form>
                <?php
            }
            }
} else {
    echo '<p style="text-align: center;">No se proporcionó una ID válida en la solicitud.</p>';
}
?>