
<!DOCTYPE html>
<html>
<head><title >Inicio de sesión</title>
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
            require "Adminlogin.php";
        ?>
            
                <input class="controls" type="text" name="curp" placeholder="Ingresa tu nombre completo" required>
           
            
                <input class="controls" type="password" name="pass" placeholder="Ingresa tu contraseña" required>
            
            
                <input class="button" type="submit" name="ingresar">
            <br>
            <p><a href="../index.html">Volver a la página principal</a></b>

        </form>
    </div>
    
</body>
</html>