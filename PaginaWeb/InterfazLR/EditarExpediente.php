<?php 
if (isset($_POST['editarExpediente'])) {


   //llamamos a la funcion conecta que sirve para conectar con la base de datos
    require "conecta.php";
    //traer todas las funciones para verificar
    require "verificar.php";
    //llamamos a la variable de nombre contra la que va a comparar del respectivo nombre de campo
   
   
                //variables post
                $motivo = $_POST["motivo_edit"];
                echo '<h2>$curp</h2>';
                $padecimientos = $_POST["padecimientos_edit"];
                $examen = $_POST["examen_edit"];
                $antecedentes = $_POST["antecedentes_edit"];
                $sql = "UPDATE expediente SET nmotivo_de_consulta='$motivo', padecimientos_actuales='$padecimientos', ultimo_examen_dental='$examen', antecedentes_medicos='$antecedentes ' Where curp_usuario='$curp'";
                $stmt = $con->prepare($sql);
                //Esto es importante para prevenir ataques de inyección SQL, ya que asegura que los datos del usuario se manejen de manera segura.
                    if ($stmt->execute()) {                               
                        
                        echo '<div class="mensaje-correcto">¡Edición exitosa!</div>';
                        sleep(1);
                        // Registro exitoso                                                               
                        header("Location: interfazPaciente.php");
                        //es para cerrar la el redireccinamiento
                        exit();
                         // Redirige al formulario de inicio de sesión
                    } else {
                        // Error en el registro
                        echo "Error: " . $con->error;
                    }           
            
}
?>