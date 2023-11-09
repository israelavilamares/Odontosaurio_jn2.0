<?php 
session_start();
if (isset($_POST['registrar'])) {

            require "conecta.php";

            //verificar si ya esta registrado el usuario
                $query = "SELECT * FROM paciente where curp_usuario	= ?";
                $query = $con->prepare($query);
                  $query->bind_param("s", $_POST["curp"]);
                  $query->execute();
                  $resul = $query->get_result();



                    if ($resul->num_rows > 0) //evita el registro de usuarios que ya estan el base de datos y tambien del administrador.
                    {
                    echo '<div class="alerta">ya esta registrado ese usuario.Intentelo de Nuevo</div>';
                    }else
                    {
                        //variables post
                        $curp = $_POST["curp"];
                        $nombre = $_POST["nombre"];
                        $tel = $_POST["telefono"];

                        //cifra la contraseña
                        $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
                        //hacer la insercion
                        $sql = "INSERT INTO PACIENTE (curp_usuario,pasw,archivo,archivo_n,nombre,telefono) VALUES('$curp','$pass','NULL','NULL','$nombre','$tel')";
                        $stmt = $con->prepare($sql);
                        //Esto es importante para prevenir ataques de inyección SQL, ya que asegura que los datos del usuario se manejen de manera segura.
                            if ($stmt->execute()) {                               
                                
                             
                                // Registro exitoso                                                               
                                header("Location: FormPacientelogin.php");
                                //es para cerrar la el redireccinamiento
                                exit();
                                 // Redirige al formulario de inicio de sesión
                            } else {
                                // Error en el registro
                                echo "Error: " . $conn->error;
                            }           
                    
                    }
        
        

}

?>