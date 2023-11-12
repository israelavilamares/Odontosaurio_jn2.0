<?php 
session_start();
if (empty($_SESSION["nombre"])) {
    header("Location: FormPacientelogin.php");
}

?>

<!DOCTYPE>
<html>
    <head>
        <title>hola</title>
        <h1>Doctor</h1>
        <h2>bienvenido: <?php echo $_SESSION['nombre'];?></h2>
        <form action='sessionDestroy.php'>
    	<input type="submit" name="destruirsession" value="Cerrar sesion"/>
		</form>
    </head>
</html>