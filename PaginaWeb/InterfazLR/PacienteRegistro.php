<?php 
session_start();
if (isset($_POST['registrar'])) {

        if(empty($_POST["curp"]) or empty($_POST["nombre"]) or empty($_POST["pass"]))
        {
             echo '<label class="alerta">Faltan Campos Por Rellenar</label>';
        }else
        {

            require "conecta.php";

                //verificar si ya esta registrado los usuario adminstrados y el usuario normal
                $queryAdm = "SELECT * FROM administrador where nombre= ?";
                $queryAdm = $con->prepare($queryAdm);
                  $queryAdm->bind_param("s", $_POST["nombre"]);
                  $queryAdm->execute();
                  $resul2 = $queryAdm->get_result();


                $query = "SELECT * FROM paciente where nombre= ?";
                $query = $con->prepare($query);
                  $query->bind_param("s", $_POST["nombre"]);
                  $query->execute();
                  $resul = $query->get_result();



                    if ($resul->num_rows > 0 or $resul2->num_rows > 0) //evita el registro de usuarios que ya estan el base de datos y tambien del administrador.
                    {
                    echo '<div class="alerta">ya esta registrado ese usuario.Intentelo de Nuevo</div>';
                    }else
                    {
                        $curp = $_POST["curp"];
                        $nombre = $_POST["nombre"];
                        //cifra la contraseña
                        $pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);
                        $sql = "INSERT INTO PACIENTE VALUES('$curp','$nombre','$pass','NULL','NULL')";
                        $stmt = $con->prepare($sql);
                        //Esto es importante para prevenir ataques de inyección SQL, ya que asegura que los datos del usuario se manejen de manera segura.
                            if ($stmt->execute()) {
                                // Registro exitoso

                                //echo '<div class"mensaje-correcto" >!!Usuario Registrado. Ahora Inicie Secion</div>';
                                 // sleep(1);

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

}

?>