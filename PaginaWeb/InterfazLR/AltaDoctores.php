<?php
if (isset($_POST['RegistraDoc'])) {


     //llamamos a la funcion conecta que sirve para conectar con la base de datos
     require "conecta.php";
     //traer todas las funciones para verificar
     require "verificar.php";

    //llamamos a la variable de curp contra la que va a comparar
   // $nombreDoc = $_POST['nombre'];
    //evita que registren a un doctor con el nombre de un paciente.
    $resultDoc = verifDoctor($_POST['nombre']);
    //evita el registro de usuarios que ya estan el base de datos que no sea igual a el de administrador.
    if($resultDoc->num_rows > 0 ){
        echo '<script>window.alert("Ya Esta Registrado Ese Nombre.Intentelo de Nuevo con otro Nombre")</script>';
        
    }else{
        
         //variables post
         
         $nombre = $_POST["nombre"];
         $especialidad = $_POST["especialidad"];
         $tel = $_POST["telefono"];
         $pasw = $_POST["pass"];
         $edad = $_POST["edad"];
        
        $pass = password_hash($pasw, PASSWORD_BCRYPT);
                //hacer la insercion
        $sql = "INSERT INTO doctor(nombre,pasw,especialidad,telefono,edad,archivo,archivo_n) VALUES('$nombre','$pass','$especialidad','$tel','$edad','NULL','NULL')";
        $stmt = $con->prepare($sql);
                //Esto es importante para prevenir ataques de inyección SQL, ya que asegura que los datos del usuario se manejen de manera segura.
                    if ($stmt->execute()) {                               
                        
                        echo '<script>window.alert("Registrado")</script';
                        
                    } else {
                        // Error en el registro
                        echo "Error: " . $conn->error;
                    }           

        }
 

}
?>