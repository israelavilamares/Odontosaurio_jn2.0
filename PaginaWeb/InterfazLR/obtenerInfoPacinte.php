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
            <h2 style="text-align: center;">Información de citas</h2>
            
            <table border="1" style="width: 100%; border-collapse: collapse; margin-top: 20px;">
                <tr style="background-color: #f2f2f2; padding: 15px;">
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Dentista</th>
                    <th>Borrar Cita</th>
                    <!-- Puedes agregar más estilos según tus necesidades -->
                </tr>
                <?php
                require('conecta.php');

                // Utiliza $resultado[1] directamente para obtener la CURP
                $curp = $resultado[1];

                // Consulta SQL para obtener las citas relacionadas con la CURP
                $sql = "SELECT consulta.*, doctor.nombre
                        FROM consulta
                        JOIN doctor ON doctor.idDoctor = consulta.idDoctor_doctor
                        WHERE consulta.curp_paciente = ?
                        ORDER BY consulta.fecha, consulta.hora";

                // Preparar la consulta
                $stmt = mysqli_prepare($con, $sql);
                mysqli_stmt_bind_param($stmt, 's', $curp);

                // Ejecutar la consulta
                mysqli_stmt_execute($stmt);

                // Obtener resultados
                $resultq = mysqli_stmt_get_result($stmt);

                while ($resultado = mysqli_fetch_array($resultq)) { ?>
                    <tr style="border-bottom: 2px solid #ddd;">
                        <td style="padding: 10px;"><?php echo $resultado['fecha'] ?></td>
                        <td style="padding: 10px;"><?php echo $resultado['hora'] ?></td>
                        <td style="padding: 10px;"><?php echo $resultado['nombre'] ?></td>
                        <td style="text-align: center; padding: 10px;"><a href='deleteCitasIntAdm.php?id=<?php echo $resultado['id']; ?>' style="text-decoration: none;">Eliminar</a></td>
                        <!-- Puedes agregar más estilos según tus necesidades -->
                    </tr>
                    <!-- Puedes agregar más filas según tus necesidades -->
                <?php } ?>
            </table>
        </ul>
<?php
    }
} else {
    echo "No se proporcionó una ID válida en la solicitud.";
}
?>