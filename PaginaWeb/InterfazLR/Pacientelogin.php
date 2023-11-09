<?php 

session_start();
require "conecta.php";


if (isset($_POST['ingresar'])) {

        $user = $_POST['curp'];
        $pass = $_POST['pass'];
                
         $queryadm = "SELECT * FROM administrador where nombre= ?";
        $stmt2 = $con->prepare($queryadm);
        $stmt2->bind_param("s", $user);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        if ($result2->num_rows == 0) {
           
           
              //id,nombre, curp_usuario,
              $queryuser = "SELECT * FROM paciente where curp_usuario= ?";
              $stmt = $con->prepare($queryuser);
              $stmt->bind_param("s", $user);
              $stmt->execute();
              $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                        $row = $result->fetch_assoc();
                            if (password_verify($pass, $row['pasw'])) {
                            // Credenciales válidas, inicia sesión

                           
                                $_SESSION['nombre'] = $row['nombre'];
                                $_SESSION['tel'] = $row['telefono'];
                                $_SESSION['curp'] = $row['curp_usuario'];
                             

                       
                            header("Location: interfazPaciente.php"); 
                            exit();// Redirige al panel de control del usuario
                        } else{ // Contraseña incorrecta
                              //  echo "Contraseña incorrecta";
                                echo '<label class="alerta">Contraseña incorrecta</label>';
                                } 
                    }else {
                      // Nombre de usuario no encontrado     
                      echo '<label class="alerta">Nombre de usuario no encontrado</label>';

                         }
    
    }else{

                $row = $result2->fetch_assoc();
                if (password_verify($pass, $row['pasw'])) {
                // Credenciales válidas, inicia sesión
                      
                        $_SESSION['curp'] = $row['nombre'];
                      //  $_SESSION['pass'] = $row['pass'];

                // Redirige al panel de control del admin
                    header("Location: interfazAdmin.php"); 
                      //cerrar redireccionamiento
                        exit();
                    } else{// Contraseña incorrecta
                    //  echo "Contraseña incorrecta";

                            echo '<label class="alerta">Contraseña incorrecta administrador</label>';
                        }


        }

            
        

       

    }

?>