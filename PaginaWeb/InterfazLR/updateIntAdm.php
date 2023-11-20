<?php 

require "conecta.php";

$id = $_POST["id"];
$name = $_POST["nombre"];
$puest = $_POST["puesto"];
$edad = $_POST["edad"];
$tel = $_POST["tel"];

$pass = password_hash($_POST['pasw'], PASSWORD_BCRYPT);

$sql = "UPDATE administrador SET nombre = '$name',pasw = '$pass' ,puesto='$puest',edad='$edad',telefono= '$tel'  WHERE idAdmin = '$id';";
if($con->query($sql)){

    echo '   <script>';
    echo ' swal("Registrado!", "You clicked the button!", "success");';
    echo '  window.location.href="interfazAdmin.php";';
    echo '    </script>';

}else{
    echo "ERROR";
}


mysqli_close($con);




?>