<?php 
if (isset($_POST['editar'])) {


   //llamamos a la funcion conecta que sirve para conectar con la base de datos
    require "conecta.php";
    //traer todas las funciones para verificar
    require "verificar.php";
    //llamamos a la variable de nombre contra la que va a comparar del respectivo nombre de campo
                //variables post
                $curp = $_SESSION['curp']; 
                $nombre = $_POST["nombre_edit"];
                $tel = $_POST["telefono"];
                $nac = $_POST["nacionalidad_edit"];
                $edad = $_POST["edad_edit"];
                $sql = "UPDATE paciente SET nombre='$nombre', telefono='$tel', nacionalidad='$nac', edad='$edad' WHERE curp_usuario='$curp'";
                $stmt = $con->prepare($sql);
                //Esto es importante para prevenir ataques de inyección SQL, ya que asegura que los datos del usuario se manejen de manera segura.
                    if ($stmt->execute()) {                               
                        
                        echo '<div class="mensaje-correcto">edicion exitoso</div>';
                        sleep(1);
                        // Registro exitoso                                                               
                        header("Location: interfazPaciente.php");
                        //es para cerrar la el redireccinamiento
                        exit();
                         // Redirige al formulario de inicio de sesión
                    } else {
                        // Error en el registro
                        echo "Error: " . $conn->error;
                    }           
            
            

            


}
?>