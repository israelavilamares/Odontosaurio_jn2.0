
<?php

require 'conecta.php';
$id=$_GET["id"];
$query = "DELETE FROM paciente WHERE id = '$id'";
$con->query($query);


   // echo '<script>';
   // echo '"location.href = "interfazAdmin.php";';
   // echo '    swal("Registrado!", "You clicked the button!", "success");';
   // echo '</script>';
//
    header("Location: interfazAdmin.php");
    //echo '<script language="javascript">';
    //echo 'alert("Eliminado Correctamente");';
    //echo '</script>';
    //echo '<script language="javascript">window.location.href="interfazAdmin.php"</script>';
   


?>