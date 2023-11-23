<?php
require 'conecta.php';
$id=$_GET["id"];
$query = "DELETE FROM consulta WHERE id = '$id'";
$con->query($query);

header("Location:  interfazDoctor.php");

?>