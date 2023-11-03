<!DOCTYPE html>
<html>
<head><title >registro</title>
 <link rel="stylesheet" type="text/css" href="../css/styleLoginAndRegister.css">
<meta name="viewport" content="width=device-width, user-scalable=no,
initial-scale=1.0, maximum-scale=1.0, minimun-scale=1.0">
</head>
<body>
    <div class="form-login">
        <h5 class="inicioS">Registro</h5>
        <form  method="post">
            <?php
           require "conecta.php";
           require('PacienteRegistro.php');
            ?>
          
           
           
            
                <input class="controls" type="text" name="curp" placeholder="ingresa tu Curp" minlength="18" required>
            
           
                <input class="controls" type="password" name="pass" placeholder="ingresa tu contraseña"  required>
            
            
                <input  class="button" type="submit" name="registrar">
            
            <p>¿Ya tienes cuenta?<a href="FormPacientelogin.php">Ingresa Aqui</a></p>
            <br>
            <p><a class="salir" href="../index.html">Volver a Pagina Principal</a></p>

        </form>
    </div>
    
</body>
</html>