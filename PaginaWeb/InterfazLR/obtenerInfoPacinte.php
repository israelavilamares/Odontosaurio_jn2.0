<?php 

    // CAMBIOOOOOO  obtenerInfoPacinete.php nuevo php que maneja la info con el id

    require('conecta.php');

    $id = isset($_GET['id']) ? $_GET['id'] : null;


        
        $sql = "SELECT * FROM paciente WHERE id = '$id'";
        $resultq = mysqli_query($con, $sql);

        while ($resultado = mysqli_fetch_array($resultq)) {?>

            <form action="">
                <input type="hidden" name ="id" value="<?php echo $resultado[0];?>">
                <label>Nombre:</label>
                <input  type="text"  name="nombre" value="<?php echo $resultado["nombre"];?>" disabled>
                <label>CURP:</label>
                <input  type="text"  name="curp" value="<?php echo $resultado["curp_usuario"];?>" disabled>
                <label>Telefono:</label>
                <input  type="text"  name="Telefono" value="<?php echo $resultado["telefono"];?>" disabled>
            
                    </form>
                    <br>
                    
                    
                    <?php } ?>                    
                    
                    <br>
                    <div class="linea-negra"></div> <!-- Agrega la línea negra aquí -->
                    <br>
                    <?php   $sql = "select consulta.CURP_paciente,consulta.id,consulta.hora,consulta.fecha from consulta JOIN paciente ON consulta.CURP_paciente=paciente.curp_usuario WHERE paciente.id = '$id' limit 1";
                $resultaq2 = mysqli_query($con, $sql);
                while ($resultadoCP = mysqli_fetch_array($resultaq2)) { 
            ?>

                <form action=""><label>Id:</label>
                <input  type="text"  name="id" value="<?php echo $resultadoCP[1];?>" disabled>
                <label>Hora:</label>
                <input  type="text"  name="hora" value="<?php echo $resultadoCP[2];?>" disabled>
                <label>Fecha:</label>
                <input  type="text"  name="fecha" value = "<?php echo $resultadoCP[3];?>" disabled>
                
            </form>
                <br>
                <button style="text-align: center;"><a href='deleteCitasIntAdm.php?id=<?php echo $resultadoCP["id"];?>' class="bto-eliminar">Eliminar</a></button>
                <?php } ?>
                

        

            

    
                
