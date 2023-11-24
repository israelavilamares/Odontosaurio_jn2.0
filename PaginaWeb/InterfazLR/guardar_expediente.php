<?php
require('conecta.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $curp = $_POST['curp'];
    $motivo_consulta = $_POST['motivo_consulta'];
    $padecimientos_actuales = $_POST['padecimientos_actuales'];
    $ultimo_examen_dental = $_POST['ultimo_examen_dental'];
    $antecedentes_medicos = $_POST['antecedentes_medicos'];
    $doctor_a_cargo = $_POST['doctor_a_cargo'];

    // Verificar si existe un expediente para la CURP
    $sqlExpedienteExistente = "SELECT * FROM expediente WHERE curp = ?";
    $stmtExpedienteExistente = mysqli_prepare($con, $sqlExpedienteExistente);
    mysqli_stmt_bind_param($stmtExpedienteExistente, 's', $curp);
    mysqli_stmt_execute($stmtExpedienteExistente);
    $resultExpedienteExistente = mysqli_stmt_get_result($stmtExpedienteExistente);

    if (mysqli_num_rows($resultExpedienteExistente) > 0) {
        // El expediente ya existe, realizar la actualización
        $sqlActualizar = "UPDATE expediente SET 
                          motivo_de_consulta = ?, 
                          padecimientos_actuales = ?, 
                          ultimo_examen_dental = ?, 
                          antecedentes_medicos = ?, 
                          doctor_a_cargo = ? 
                          WHERE curp = ?";

        $stmtActualizar = mysqli_prepare($con, $sqlActualizar);
        mysqli_stmt_bind_param(
            $stmtActualizar,
            'ssssss',
            $motivo_consulta,
            $padecimientos_actuales,
            $ultimo_examen_dental,
            $antecedentes_medicos,
            $doctor_a_cargo,
            $curp
        );

        if (mysqli_stmt_execute($stmtActualizar)) {
            echo '<p style="text-align: center;">Expediente actualizado con éxito.</p>';
        } else {
            echo '<p style="text-align: center;">Error al actualizar el expediente: ' . mysqli_error($con) . '</p>';
        }
    } else {
        // El expediente no existe, insertar un nuevo expediente
        $sqlInsertar = "INSERT INTO expediente (curp, motivo_de_consulta, padecimientos_actuales, 
                        ultimo_examen_dental, antecedentes_medicos, doctor_a_cargo) 
                        VALUES (?, ?, ?, ?, ?, ?)";

        $stmtInsertar = mysqli_prepare($con, $sqlInsertar);
        mysqli_stmt_bind_param(
            $stmtInsertar,
            'ssssss',
            $curp,
            $motivo_consulta,
            $padecimientos_actuales,
            $ultimo_examen_dental,
            $antecedentes_medicos,
            $doctor_a_cargo
        );

        if (mysqli_stmt_execute($stmtInsertar)) {
            echo '<p style="text-align: center;">Expediente creado con éxito.</p>';
        } else {
            echo '<p style="text-align: center;">Error al crear el expediente: ' . mysqli_error($con) . '</p>';
        }
    }
}

// Redirigir de vuelta a la página anterior o a donde sea apropiado
header('Location: interfazAdmin.php');
exit();
?>