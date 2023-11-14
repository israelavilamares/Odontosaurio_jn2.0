<?php 

session_start();

require "conecta.php";
require "verificar.php";

if (isset($_POST['ingresar'])) {
      
  //variables de post
  $user = $_POST['curp'];
  $pass = $_POST['pass'];
  //verifica si es el administrador
  $resultAdm = verifAdmin($user);
  //verifica si es el Paciente
  $resultPac = verifPaciente($user);
  //verificar si es doctor
  $resultDoc = verifDoctor($user);
  
    //si no lo es entonces se verifica si el usuario esta registrado
    if ($resultAdm->num_rows == 1) 
    {


          $row = $resultAdm->fetch_assoc();
          //verificamos la contraseña sea correcta
          if (password_verify($pass, $row['pasw'])) 
          {
                // Credenciales válidas, inicia sesión                      
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['telefono'] = $row['telefono'];
                $_SESSION['puesto'] = $row['puesto'];
                $_SESSION['edad'] = $row['edad'];
                  
                // Redirige al panel de control del admin
                header("Location: interfazAdmin.php"); 
                    //cerrar redireccionamiento
                      exit();
          } else{// Contraseña incorrecta                      
                    echo '<label class="alerta">Contraseña incorrecta</label>';
                }
      
    }elseif ($resultPac->num_rows == 1) 
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
    }elseif($resultDoc->num_rows == 1)
    {

      $row = $resultDoc->fetch_assoc();
      if (password_verify($pass, $row['pasw'])) {
                  // Credenciales válidas, inicia sesión

                //variables de sesion en la intefaz login
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['tel'] = $row['telefono'];
            $_SESSION['espec'] = $row['especialidad'];
            $_SESSION['edad'] = $row['edad'];    
                  

            
            header("Location: interfazDoctor.php"); 
            exit();// Redirige al panel de control del usuario
      } else{ // Contraseña incorrecta
                    //  echo "Contraseña incorrecta";
              echo '<label class="alerta">Contraseña incorrecta</label>';
            } 
    }else {
                  // Nombre de usuario no encontrado     
            echo '<label class="alerta">No esta registrado ese usuario</label>';

          }

}
 
?>