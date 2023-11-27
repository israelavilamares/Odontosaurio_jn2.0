<?php
    require ('conecta.php');
    $curp = $_POST['curp'];
    $idDoctor = $_POST['doctor'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $consultorio = $_POST['consultorio'];

    // Verifica si el doctor ya tiene una cita a esa hora
    $sql_check = "SELECT * FROM consulta WHERE idDoctor_doctor = '$idDoctor' AND fecha = '$fecha' AND hora = '$hora'";
    $result_check = mysqli_query($con, $sql_check);
    if (mysqli_num_rows($result_check) > 0) {
        // Si el doctor ya tiene una cita a esa hora, muestra un mensaje de error
        echo "El doctor ya tiene una cita a esa hora.";
    } else {
        // Si el doctor no tiene una cita a esa hora, inserta la nueva cita
        $sql_insert = "INSERT INTO consulta (CURP_paciente, idDoctor_doctor, hora, consultorio, fecha) VALUES ('$curp', '$idDoctor', '$hora', '$consultorio', '$fecha')";
        if(mysqli_query($con, $sql_insert)){
            echo "Cita agendada con éxito.";
        } else{
            echo "ERROR: No se pudo ejecutar $sql_insert. " . mysqli_error($con);
        }
    }
    mysqli_close($con);
?>
