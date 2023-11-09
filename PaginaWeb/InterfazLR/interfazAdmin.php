<?php 
session_start();

?>

<!DOCTYPE>
<html>
    <head>
        <title>hola</title>
        <h1>administrador</h1>
        <h2>bienvenido: <?php echo $_SESSION['curp'];?></h2>
        <form action='sessionDestroy.php'>
    	<input type="submit" name="destruirsession" value="Cerrar sesion"/>
		</form>
    </head>
</html>