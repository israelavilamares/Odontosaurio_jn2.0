<?php 
session_start();
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
            <a href="#configuracion">Configuracion de la cuenta</a>
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
        <li>Nombre: <h3><?php echo $_SESSION['nombre']; ?></h3> </li>
            <li>Edad</li>
            <li>CURP: 
                <h3><?php echo $_SESSION['curp'];?></h3>
            </li>
            <li>Número de celular: 
                <h3><?php echo $_SESSION['tel'];?></h3> 
            </li>

            <li>Nacionalidad</li>
        </ul>
    </section>
</div>


<div class="cuadro-blancocitas">
    <img src="/odontosaurioApp/PaginaWeb/img/boton.png" alt="" class="imagen-boton">
    <img src="/odontosaurioApp/PaginaWeb/img/boton.png" alt="" class="imagen-boton2">
    <section class="textos-citas">
        <h1>Encuentra tu dentista y agenda tu cita</h1>
        <h2>Agendar cita</h2>
        <h3 id="mostrar-popup">Ver citas</h3>
    </section>
</div>

<div id="popup" style="display: none;">
    <div>
        <span id="cerrar-popup">X</span>
        <img src="/odontosaurioApp/PaginaWeb/img/user.png" alt="" class="imagen-user-cita">
        <h2>Citas disponibles de</h2>
        <table>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Dentista</th>
                <th>Borrar Cita</th>
                <!-- Puedes agregar más encabezados según tus necesidades -->
            </tr>
            <tr>
                <td>2023-11-09</td>
                <td>10:00 AM</td>
                <td>Dr. Ejemplo</td>
                <td style="text-align: center;"><img src="/odontosaurioApp/PaginaWeb/img/borrar.png" alt="Borrar" style="cursor: pointer;"></td>
                <!-- Puedes agregar más celdas según tus necesidades -->
            </tr>
            <!-- Puedes agregar más filas según tus necesidades -->
        </table>
    </div>
</div>



<div class="cuadro-blancoexpediente">
    <section class="textos-expediente">
        <h1>Expediente</h1>
        <h2>editar</h2>
        <ul>
            <li>Nombre: <span><?php echo $_SESSION['nombre']; ?></span></li>
            <li>CURP: <span><?php echo $_SESSION['curp']; ?></span></li>
            <div class="linea-negra"></div> <!-- Agrega la línea negra aquí -->
            </li>
        </ul>

        <ul class="expediente" id="lista2">
            <li>Motivo de consulta:</li>
            <li>Padecimientos actuales:</li>
            <li>Ultimo examen dental:</li>
            <li>antecedentes medicos:</li>
            <li>Doctor a cargo:</li>
        </ul>
    </section>
</div>    
   
<div class="cuadro-blancoimajenes">
<img src="/odontosaurioApp/PaginaWeb/img/boton.png" alt="" class="imagen-boton3">
    <section class="textos-imajenes">
        <h1>Multimedia</h1>
        <h2>Subir imajen</h2>
    </section>
</div>    


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
    </body>   
</html>