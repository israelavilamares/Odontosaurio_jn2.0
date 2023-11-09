<?php 
session_start();
?>
<!DOCTYPE>
<html>
    <head>
        <title>hola</title>
        <link rel="stylesheet" type="text/css" href="../css/styleinterfazPaciente.css">
    </head>
    <body>
    <h1>paciente prueba</h1>
    <h2>bienvenido: <?php echo $_SESSION['nombre']?> </h2>
        <form action='sessionDestroy.php'>
    	<input type="submit" name="destruirsession" value="Cerrar sesion"/>
		</form>
    </body>
        

    
</html>