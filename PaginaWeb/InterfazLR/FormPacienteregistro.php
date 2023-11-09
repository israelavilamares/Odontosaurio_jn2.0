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
          
           
           
            
                <input class="controls" type="text" name="curp" placeholder="ingresa tu Curp" minlength="18" pattern="[A-Za-z0-9]*" title="Solo Puedes Utilizar Letras y Numeros" required> 
            
                <input class="controls" type="text" name="nombre" placeholder="ingresa tu Nombre completo" maxlength="50" required>

                <input class="controls" type="tel" name="telefono" placeholder="ingresa tu Telefono" maxlength="10" required>

                <input class="controls" type="password" name="pass" placeholder="ingresa tu contraseña" required>
            
            
                <input  class="button" type="submit" name="registrar">
            
            <p>¿Ya tienes cuenta?<a href="FormPacientelogin.php"><b>Ingresa Aqui</b></a></p>
            <br>
            <p><a class="salir" href="../index.html"><b>Volver a Pagina Principal</b></a></p>

        </form>
    </div>
    
</body>
</html>