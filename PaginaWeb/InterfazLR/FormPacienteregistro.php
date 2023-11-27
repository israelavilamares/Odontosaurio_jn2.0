<!DOCTYPE html>
<html>
<head><title >registro</title>
 <link rel="stylesheet" type="text/css" href="../css/styleLoginAndRegister.css">
<meta name="viewport" content="width=device-width, user-scalable=no,
initial-scale=1.0, maximum-scale=1.0, minimun-scale=1.0">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <div class="form-login">
        <h5 class="inicioS">Registro</h5>
        <form  method="post">
            <?php
           require "conecta.php";
           require('PacienteRegistro.php');
            ?>
          
           
           
                
                <input class="controls" type="text" name="curp" placeholder="Ingresa tu CURP" minlength="18" maxlength="18" pattern="[A-Za-z0-9]*" title="Sólo puedes poner números y letras, rawr" required> 
            
                <input class="controls" type="text" name="nombre" placeholder="Ingresa tu nombre completo" maxlength="50" required>

                <input class="controls" type="tel" name="telefono" placeholder="Ingresa tu número de teléfono" minlength="10" maxlength="10" pattern="[0-9]*" title="Sólo puedes poner números, rawr" required>

                <input class="controls" type="password" name="pass" placeholder="Ingresa tu contraseña" required>

                <input class="controls" type="text" name="nacionalidad" placeholder="Ingresa tu nacionalidad" maxlength="50" required>

                <input class="controls" type="tel" name="edad" placeholder="Ingresa tu edad" minlength="1" maxlength="3" pattern="[0-9]*" title="Sólo puedes poner números, rawr" required>

                <input  class="button" type="submit" name="registrar">
            
            <p>¿Ya tienes cuenta?<a href="FormPacientelogin.php"><b>Ingresa Aqui</b></a></p>
            <br>
            <p><a class="salir" href="../index.html"><b>Volver a Pagina Principal</b></a></p>

        </form>
    </div>
    
</body>
</html>