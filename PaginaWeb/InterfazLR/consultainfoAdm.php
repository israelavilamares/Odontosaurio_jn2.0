<?php
require 'conecta.php';
$id=$_GET["id"];
$query = "SELECT FROM administrador WHERE idAdmin = '$id'";
$con->query($query);

?>