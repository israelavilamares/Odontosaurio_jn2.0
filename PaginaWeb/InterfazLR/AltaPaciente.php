<?php
if (isset($_POST['RegistraPaciente'])) {


     //llamamos a la funcion conecta que sirve para conectar con la base de datos
     require "conecta.php";
     require "verificar.php";
     //traer todas las funciones para verificar
     //require "verificar.php";
     $nombreAdm = $_POST['nombre'];
     // la funcion para verificar si en el campo nombre, esta el nombre de algun administrador
     $resultAdm = verifAdmin($nombreAdm);
     //llamamos a la variable de nombre contra la que va a comparar del respectivo nombre de campo
     $nombreDoc = $_POST['nombre'];
     //evita que registren a un doctor con el nombre de un paciente.
     $resultDoc = verifDoctor($nombreDoc);
     //evita el registro de usuarios que ya estan el base de datos que no sea igual a el de administrador.
     $nombrePac = $_POST['curp'];

     $resultPac=verifPaciente($nombrePac);
     if ($resultAdm->num_rows > 0) 
     {
         //mensaje error
         echo '<script>';
         echo '    swal("Error!", "ya esta registrado ese Nombre. Intentelo de Nuevo con otro Nombre!", "error");';
         echo '</script>';
         
     }elseif($resultDoc->num_rows > 0 ){
        echo '<script>';
        echo '    swal("Error!", "ya esta registrado ese Nombre. Intentelo de Nuevo con otro Nombre!", "error");';
        echo '</script>';
     }elseif( $resultPac->num_rows > 0 )
    {
        echo '<script>';
        echo '    swal("INFORMACION!", "El Registro ya esta en la Tabla!", "info");';
        echo '</script>';
    }else{

       
            //variables post
         
                //variables post
                $curp = $_POST["curp"];
                $nombre = $_POST["nombre"];
                $tel = $_POST["telefono"];
                $nacionalidad = $_POST["nacionalidad"];
                $edad = $_POST["edad"];
                //cifra la contraseña
                $pass = password_hash($_POST['pasw'], PASSWORD_BCRYPT);
                //hacer la insercion
                $sql = "INSERT INTO PACIENTE (curp_usuario,pasw,archivo,archivo_n,nombre,telefono,nacionalidad,edad) VALUES('$curp','$pass','NULL','NULL','$nombre','$tel','$nacionalidad','$edad')";
                $stmt = $con->prepare($sql);
                //Esto es importante para prevenir ataques de inyección SQL, ya que asegura que los datos del usuario se manejen de manera segura.
                    if ($stmt->execute()) {                               
                        
                        // Registro exitoso                                                               
   
                        echo '<script>';
                        echo '    swal("Registrado!", "You clicked the button!", "success");';
                        echo 'setTimeout("document.location.reload()",5000);';
                        echo '</script>';
                      
                        
                       
                    } else {
                        // Error en el registro
                        echo "Error: " . $conn->error;
                    }    
        }
        

}
?>