<?php 

session_start();

require "conecta.php";
require "verificar.php";

if (isset($_POST['ingresar'])) {
      
  //variables de post
  $user = $_POST['curp'];
  $pass = $_POST['pass'];
  //verifica si es el Paciente
  $resultPac = verifPaciente($user);
  
    //si no lo es entonces se verifica si el usuario esta registrado
    if ($resultPac->num_rows == 1) 
        {

            $row = $resultPac->fetch_assoc();
            if (password_verify($pass, $row['pasw'])) {
                        // Credenciales válidas, inicia sesión
                      
                  $_SESSION['nombre'] = $row['nombre'];
                  $_SESSION['tel'] = $row['telefono'];
                  $_SESSION['curp'] = $row['curp_usuario'];
                  $_SESSION['nacionalidad'] = $row['nacionalidad'];
                  $_SESSION['edad'] = $row['edad'];                        
                  
                  header("Location: interfazPaciente.php"); 
                  exit();// Redirige al panel de control del usuario
            } else{ // Contraseña incorrecta
                          //  echo "Contraseña incorrecta";
                    echo '<label class="alerta">Contraseña incorrecta</label>';
                  } 
    }
         mysqli_close($con);
}
 
?>