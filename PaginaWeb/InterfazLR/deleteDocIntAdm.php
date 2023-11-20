
<?php
require 'conecta.php';
$id=$_GET["id"];
$query = "DELETE FROM doctor WHERE idDoctor = '$id'";
$con->query($query);

     header("Location: interfazAdmin.php");

   
 

?>