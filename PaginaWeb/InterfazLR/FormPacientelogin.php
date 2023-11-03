
<!DOCTYPE html>
<html>
<head><title >inicio de sesion</title>
 <link rel="stylesheet" type="text/css" href="../css/styleLoginAndRegister.css">
<meta name="viewport" content="width=device-width, user-scalable=no,
initial-scale=1.0, maximum-scale=1.0, minimun-scale=1.0">
</head> 
<body>
    <div class="form-login">

        <h5>Iniciar sesion</h5>
        <form action="" method="post">
        <?php 
            require "conecta.php";
            require "Pacientelogin.php";
        ?>
            
                <input class="controls" type="text" name="nombre" placeholder="ingresa tu curp" required>
           
            
                <input class="controls" type="password" name="pass" placeholder="ingresa tu contraseña" required>
            
            
                <input class="button" type="submit" name="ingresar">
            

            <p>¿No tienes Cuenta?<a href="FormPacienteregistro.php">Registrate</a></p>
            <br>
            <p><a href="../index.html">Volver a Pagina Principal</a></p>

        </form>
    </div>
    
</body>
</html>