
<?php

require 'conecta.php';
$id=$_GET["id"];
$query = "DELETE FROM paciente WHERE id = '$id'";
$con->query($query);



mysqli_close($con);
?>