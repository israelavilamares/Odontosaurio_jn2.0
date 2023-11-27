<?php
if (isset($_POST['RegistrarAdmin'])) {


    //llamamos a la funcion conecta que sirve para conectar con la base de datos
    require "conecta.php";
    require "verificar.php";
    //traer todas las funciones para verificar
    //require "verificar.php";
    $nombre = $_POST["nombre"];
    $tel = $_POST["telefono"];
    $puesto= $_POST["puesto"];
    $edad = $_POST["edad"];
    $pasw = $_POST['passw'];
    
    // la funcion para verificar si en el campo nombre, esta el nombre de algun administrador
    //$resultAdm = verifAdmin($nombre);
    //llamamos a la variable de nombre contra la que va a comparar del respectivo nombre de campo

    //evita que registren a un doctor con el nombre de un paciente.
    $resultDoc = verifDoctor($nombre);


   
    $resultPac = NomverifPaciente($nombre);

    $resultadoAdm = verifAdmin($nombre);

 if($resultDoc->num_rows > 0){
       echo '<script>';
       echo '    swal("¡Error!", "Ya está registrado ese nombre. Intentelo de Nuevo con otro Nombre, ¡Rawr!", "error");';

       echo '</script>';
      
    }elseif($resultPac->num_rows > 0){
       
       echo '<script>';
       echo '    swal("¡Error!", "Ya está registrado ese nombre. Intentelo de Nuevo con otro Nombre, ¡Rawr!", "error");';

       echo '</script>';
       
    }elseif($resultadoAdm->num_rows > 0){

        echo '<script>';
        echo '    swal("¡DINO-INFORMACIÓN! ¡Rawr!", "El registro ya está actualizado en la tabla!", "success");';
        echo '</script>';

    }else{
                                              
           $pass = password_hash($pasw, PASSWORD_BCRYPT);
                   //hacer la insercion
           $sql = " INSERT INTO administrador(nombre,pasw,puesto,edad,telefono,archivo,archivo_n) VALUES('$nombre','$pass','$puesto','$edad','$tel','NULL','NULL')";
          // $stml = mysqli_query($con, $sql);
          $stmt = $con->prepare($sql);
                   //Esto es importante para prevenir ataques de inyección SQL, ya que asegura que los datos del usuario se manejen de manera segura.
                   if ($stmt->execute())  {          

                           echo '<script>';
                           echo '    swal("Registrado!", "You clicked the button!", "success");';
                           
                          // echo 'setTimeout("document.location.reload()",1000);';
                          
                           echo '</script>';
                 

                   } else {
                       // Error en el registro
                       echo "Error: " . $con->error;
                   }           

       
       }
       $con->close();

}
?>