<?php 
session_start();
if (empty($_SESSION["nombre"])) {
    header("Location: FormPacientelogin.php");
}
?>
<!DOCTYPE>
<html>   
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinica Odontosaurio</title>
    <link rel="stylesheet" type="text/css" href="../css/styleInterfazPaciente.css">
    <link rel="shortcut icon" href="../img/icono.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wdth,wght@96.3,710;100,300;100,400;100,700;100,800&display=swap" rel="stylesheet">
    </head>

    <body>
<header>
    <nav>
    <ul class="nav-links">
        <li>
            <a href="#idinicio">Inicio</a>
        </li>

        <li>
        <a href="#" id="ayudaBtn">Ayuda y soporte técnico</a>
        </li>
        <li>
            <form action='sessionDestroy.php'>
    	    <input class="cerrar-session" type="submit" name="destruirsession" value="Cerrar sesion"/>
		    </form>
        </li>
        
        </ul>
        <h2>¡ Bienvenid@ ! <span><?php echo $_SESSION['nombre']; ?></span> </h2>
        <div class="burger" >
          <div class="line1"></div>
          <div class="line2"></div>
          <div class="line3"></div>
        </div>
    </nav>


    <div class="popup" id="ayudaPopup">
        <div class="popup-content">
            <span class="close" onclick="cerrarPopup('ayudaPopup')">&times;</span>
            <!-- Contenido de tu popup para Ayuda y Soporte -->
            <h1>Contenido de Ayuda y Soporte</h1>
            <h2>¿Tienes alguna duda? ¡No te preocupes!</h2>
            <h3>En este tutorial abarcamos todas las preguntas frecuentes que nos han hecho.</h3>
            <h4>Si las dudas persisten, no dudes en contactarnosen nuestro apartado "dudas y comentarios" en nuestra pagina principal.</h4>
            <img src="../img/velociraptor.png" alt="" class="imagen-ayuda">
        </div>
    </div>


</header>


<main>

<div id="idinicio">
  <div class="cuadro-blancouser">
    <img src="/odontosaurioApp/PaginaWeb/img/status.png" alt="" class="imagen-status">
    <img src="/odontosaurioApp/PaginaWeb/img/tag.png" alt="" class="imagen-tag">
    <section class="textos-user">
      <h1>MI CUENTA</h1>
      <h2>Conectado</h2>
      <img src="/odontosaurioApp/PaginaWeb/img/user.png" alt="" class="imagen-user">
    </section>
  </div>
</div>

<div class="cuadro-blancoinfo">
    <section class="textos-info">
        <h1>Información de contacto</h1>
        <h2>editar</h2>
        <ul>
        <form  method="post">
            <?php
           require "conecta.php";
           require('EditarPaciente.php');
           ?>
        <li>Nombre: <span><?php echo $_SESSION['nombre']; ?></span><input class="controls" type="text" name="nombre_edit" placeholder="ingresa tu Nombre completo" maxlength="50" required></li>
            <li>Edad: <span><?php echo $_SESSION['edad'];?><span><input class="controls" type="tel" name="edad_edit" placeholder="ingresa tu edad" minlength="1" maxlength="3" pattern="[0-9]*" title="Solo puedes Poner Numeros" required></li>
            <li>CURP: <span><?php echo $_SESSION['curp'];?><span><input class="controls" type="text" name="curp_edit" value= <?php echo $_SESSION['curp']?> disabled> </li>
            <li>Número de celular: <span><?php echo $_SESSION['tel'];?><span><input class="controls" type="tel" name="telefono" placeholder="ingresa tu Telefono" minlength="10" maxlength="10" pattern="[0-9]*" title="Solo puedes Poner Numeros" required></li>
            <li>Nacionalidad: <span><?php echo $_SESSION['nacionalidad'];?><span><input class="controls" type="text" name="nacionalidad_edit" placeholder="ingresa tu Nacionalidad" maxlength="50" required>
            <input  class="button" type="submit" name="editar"></li>
            </form>
        </ul>
    </section>
</div>


<div class="cuadro-blancocitas">
    <img src="/odontosaurioApp/PaginaWeb/img/boton.png" alt="" class="imagen-boton">
    <img src="/odontosaurioApp/PaginaWeb/img/boton.png" alt="" class="imagen-boton2">
    <section class="textos-citas">
        <h1>Encuentra tu dentista y agenda tu cita</h1>
        <h2 id="mostrar-popup-agendar">Agendar cita</h2>
        <h3 id="mostrar-popup-ver">Ver citas</h3>
    </section>
</div>

<!-- popup ver citas-->
<div id="popup-ver" style="display: none;">
    <div>
        <span id="cerrar-popup-ver">X</span>
        soy ver citas
        <!-- contnido para "Ver citas" popup -->
    </div>
</div>
<!-- fin popup ver citas-->

<!-- popup agendar citas-->
<div id="popup-agendar" style="display: none;">
    <div>
        <span id="cerrar-popup-agendar">X</span>
        soy agendar citas
        <!-- contenido para "Agendar citas" popup -->
    </div>
</div>
<!-- fin popup agendar citas-->


<div class="cuadro-blancoexpediente">
    <section class="textos-expediente">
        <h1>Expediente</h1>
        <h2></h2>
        <ul>
            <li>Nombre: <span><?php echo $_SESSION['nombre']; ?></span></li>
            <li>CURP: <span><?php echo $_SESSION['curp']; ?></span></li>
           
            <div class="linea-negra"></div> <!-- Agrega la línea negra aquí -->
            </li>
            <ul class="expediente" id="lista2">
        </ul>
        
<?php
require "conecta.php";
$curp = $_SESSION['curp']; 
$res = $con->query("SELECT * FROM expediente WHERE curp = '$curp'");
$recuperado= $res->fetch_assoc();
if ($recuperado) {
    // Hay datos en la tabla, puedes mostrar la información
    ?>
    <form method="post">
        <ul>
            <li>Padecimientos actuales: <span><?php echo $recuperado["padecimientos_actuales"]; ?></span></li>
            <li>Ultimo examen dental: <span><?php echo $recuperado["ultimo_examen_dental"]; ?></span></li>
            <li>Antecedentes médicos: <span><?php echo $recuperado["antecedentes_medicos"]; ?></span></li>
            <li>Doctor a cargo: <span><?php echo $recuperado["doctor_a_cargo"]; ?></span></li>
        </ul>
    </form>
    <?php
} else {
    // No hay datos en la tabla, puedes mostrar un mensaje o realizar otra acción
    echo "No hay datos disponibles.";
}
?>
</section>
</div>

   
<div class="cuadro-blancoimajenes">
<img src="/odontosaurioApp/PaginaWeb/img/boton.png" alt="" class="imagen-boton3">
    <section class="textos-imajenes">
        <h1>Multimedia</h1>
        <h2 id="mostrar-popup-imagen">Subir imajen</h2>
    </section>
</div>    

<!-- popup para subir imagen -->
<div id="popup-imagen" style="display: none;">
    <div>
        <span id="cerrar-popup-imagen">X</span>
        <!-- Contenido del popup para subir imagen -->
    </div>
</div>
<!-- Fin del popup para subir imagen -->




</main>

<footer>
   <div class="contenedor-footer">
       <div class="content-foo">
           <h4>Teléfono</h4>
           <p>3337984333</p>
       </div>
       <div class="content-foo">
            <h4>Correo electrónico</h4>
            <p>odontosaurio.clinic@gmail.com</p>
       </div>
       <div class="content-foo">
           <h4> Ubicación </h4>
           <p>Mar Mediterranio#227 Col.Popotla CP11400 </p>
       </div>
   </div>
   <h2 class="titulo-final">&copy; Six Gears | IngSoftware</h2>
</footer>

    <!-- Desabilita el clickderecho -->
    <script src="/odontosaurioApp/Bak/clickderecho.js"></script>
    <!-- Botones para el fullscreen -->
    <!-- <script src="../Bak/botones.js"></script> -->
    <!-- Menu pegajoso -->
    <script src="/odontosaurioApp/Bak/menu.js"></script>
    <script src="/odontosaurioApp/Nav/animation.js"></script>
    <script src="/odontosaurioApp/PaginaWeb/js/PopupCita.js"></script>
    <script src="/odontosaurioApp/PaginaWeb/js/PopupAyudaySoporte.js"></script>
    <script src="/odontosaurioApp/PaginaWeb/js/PopupImagen.js"></script>
    </body>   
</html>