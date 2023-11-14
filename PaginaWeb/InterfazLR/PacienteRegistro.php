<?php 
session_start();
if (isset($_POST['registrar'])) {


   //llamamos a la funcion conecta que sirve para conectar con la base de datos
    require "conecta.php";
    //traer todas las funciones para verificar
    require "verificar.php";
    //llamamos a la variable de nombre contra la que va a comparar del respectivo nombre de campo
    $nombreAdm = $_POST['nombre'];
    // la funcion para verificar si en el campo nombre, esta el nombre de algun administrador
    $resultAdm = verifAdmin($nombreAdm);
    //llamamos a la variable de curp contra la que va a comparar
    $curp = $_POST["curp"];
    //funcion de comparacion que evita que registren a un usuario igual a otro
    $resultPac = verifPaciente($curp);
    //llamamos a la variable de nombre contra la que va a comparar del respectivo nombre de campo
    $nombreDoc = $_POST['nombre'];
    //evita que registren a un doctor con el nombre de un paciente.
    $resultDoc = verifDoctor($nombreDoc);
    //evita el registro de usuarios que ya estan el base de datos que no sea igual a el de administrador.
    if ($resultAdm->num_rows > 0) 
    {
        //mensaje error
        echo '<div class="alerta">ya esta registrado ese Nombre. Intentelo de Nuevo con otro Nombre</div>';
    }elseif($resultPac->num_rows > 0)
    {        //mensaje error
        echo '<div class="alerta">ya esta registrado esa Curp. Intentelo de Nuevo</div>';
    }elseif($resultDoc->num_rows > 0 ){
        echo '<div class="alerta">ya esta registrado ese Nombre.Intentelo de Nuevo con otro Nombre</div>';
    }else{

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
                        
                        echo '<div class="mensaje-correcto">Registro exitoso</div>';
                        sleep(1);
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