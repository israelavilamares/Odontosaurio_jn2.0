<?php
    require ('conecta.php');
    $curp = $_POST['curp'];
    $idDoctor = $_POST['doctor'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $consultorio = $_POST['consultorio'];
    $sql = "INSERT INTO consulta (CURP_paciente, idDoctor_doctor, hora, consultorio, fecha) VALUES ('$curp', '$idDoctor', '$hora', '$consultorio', '$fecha')";
    if(mysqli_query($con, $sql)){
        echo "Cita agendada con éxito.";
    } else{
        echo "ERROR: No se pudo ejecutar $sql. " . mysqli_error($con);
    }
    mysqli_close($con);
?>
