<?php 

require "conecta.php";

$id = $_POST["id"];
$name = $_POST["nombre"];
$esp = $_POST["especialidad"];
$tel = $_POST["telefono"];
$edad = $_POST["edad"];

$pass = password_hash($_POST['pass'], PASSWORD_BCRYPT);

$sql = "UPDATE doctor SET nombre = '$name' , pasw = '$pass' , especialidad ='$esp' , edad='$edad' , telefono= '$tel' WHERE idDoctor = '$id';";
if($con->query($sql)){

    echo '   <script>';
    echo '  alert("Actulizado")';
    echo '  window.location.href="interfazAdmin.php";';
    echo '    </script>';
   
}else{
    echo "ERROR";
}
mysqli_close($con);