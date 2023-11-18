
<?php
require 'conecta.php';
$id=$_GET["id"];
$query = "DELETE FROM administrador WHERE idAdmin = '$id'";
$con->query($query);

    header("Location: interfazAdmin.php");
 

?>