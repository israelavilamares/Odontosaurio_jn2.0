<?php
if (isset($_POST['RegistrarAdmin'])) {


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
    if($resultDoc->num_rows > 0 ){
        echo '<script>';
        echo '    swal("Error!", "ya esta registrado ese Nombre. Intentelo de Nuevo con otro Nombre!", "error");';
        echo '</script>';
     }elseif( $resultAdm->num_rows > 0 )
    {
        echo '<script>';
        echo '    swal("Error!", "ya esta registrado ese Nombre. Intentelo de Nuevo con otro Nombre!", "error");';
        echo '</script>';
    }else{

     
            //variables post
               
                $nombre = $_POST["nombre"];
                $tel = $_POST["tel"];
                $puesto= $_POST["puesto"];
                $edad = $_POST["edad"];

                //cifra la contraseña
                $pass = password_hash($_POST['passw'], PASSWORD_BCRYPT);
                //hacer la insercion
                $sql = "INSERT INTO administrador(nombre,pasw,puesto,edad,telefono,archivo,archivo_n) VALUES('$nombre','$pass',$puesto,$edad,$tel,'NULL','NULL')";
                $stmt = $con->prepare($sql);
                //Esto es importante para prevenir ataques de inyección SQL, ya que asegura que los datos del usuario se manejen de manera segura.
                    if ($stmt->execute()) {                               
                        
                        
                        // Registro exitoso 
                        echo '<script>';
                        echo '    swal("Registrado!", "You clicked the button!", "success");';
                        echo '</script>';
                      
                        
                       
                    } else {
                        // Error en el registro
                        echo "Error: " . $conn->error;
                    }    
        }
        

}
?>