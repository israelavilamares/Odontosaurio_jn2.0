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
    <link rel="stylesheet" type="text/css" href="../css/styleInterfazDoctor.css">
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
        <h2>¡ Bienvenid@, -<?php echo $_SESSION['nombre'];?>-!</h2>
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
            <img src="/odontosaurioApp/PaginaWeb/img/velociraptor.png" alt="" class="imagen-ayuda">

        </div>
    </div>


</header>


<main>

<div id="idinicio">
  <div class="cuadro-blancouser">
    <img src="/odontosaurioApp/PaginaWeb/img/status.png" alt="" class="imagen-status">
    <img src="/odontosaurioApp/PaginaWeb/img/tag.png" alt="" class="imagen-tag">
    <section class="textos-user">
      <h1>DOCTOR</h1>
      <h2>Conectado</h2>
      <img src="/odontosaurioApp/PaginaWeb/img/user.png" alt="" class="imagen-user">
      <h3>Información de contacto</h3>
      <h4>editar</h4>
      <ul>
        <li>Nombre:
        <?php echo $_SESSION['nombre'];?>
        </li>
        <li>especialidad:
       <span><?php echo $_SESSION['espec'];?></span> 
        </li>
        <li>
        Edad: <span><?php echo $_SESSION['edad'];?></span>
        </li>            
        <li>Número de celular: <?php echo $_SESSION['tel'];?></li>
        </ul>

    </section>
  </div>
</div>

<!-- Cuadro blanco  busqueda -->
<div class="cuadro-blancobusqueda">
    <form id="formularioBusqueda">
        <input type="text" class="barra-busqueda" id="busquedaInput" placeholder="Buscar...">
        <div id="resultadosBusqueda"></div>
    </form>
</div>

<script>
    document.getElementById('formularioBusqueda').addEventListener('submit', function (event) {
        event.preventDefault(); // Evitar que el formulario se envíe normalmente

        var query = document.getElementById('busquedaInput').value;

        if (query.length >= 3) {
            // Realiza la búsqueda asincrónica
            buscarEnBaseDeDatos(query);
        }
    });

    function buscarEnBaseDeDatos(query) {
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // Abre un nuevo popup con los resultados y muestra el cuadro deseado
                abrirPopup(this.responseText, 'cuadroResultados');
            }
        };

        // Envía la consulta al servidor PHP sin cambiar la URL
        xmlhttp.open("POST", "buscarUserDoc.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("query=" + encodeURIComponent(query));
    }

    function abrirPopup(resultados, cuadroId) {
    // Obtén el modal
    var modal = document.getElementById(cuadroId);

    // Escribe los resultados en el contenido del modal
    modal.innerHTML = '<span class="cerrar" onclick="cerrarCuadro(\'' + cuadroId + '\')">X</span>';
    modal.innerHTML += '<h2>Resultados de la Búsqueda</h2>';
    modal.innerHTML += '<div id="resultados">' + resultados + '</div>';

    // Muestra el modal
    modal.style.display = 'block';

    // Muestra el cuadro deseado
    mostrarCuadro(cuadroId);
}

    function mostrarCuadro(id) {
        // Si el cuadro a mostrar no es ni 'expedientePaciente' ni 'citasPaciente', oculta los demás
        if (id !== 'expedientePaciente' && id !== 'citasPaciente' && id !== 'altaPaciente' && id !== 'infoDoctor' && id !== 'altaDoctor' && id !== 'altaAdmin' && id !== 'infoAdmin') {
            // Oculta todos los cuadros adicionales
            var cuadros = document.querySelectorAll('.cuadro-adicional');
            cuadros.forEach(function(cuadro) {
                cuadro.style.display = 'none';
            });
        }

        // Muestra el cuadro deseado
        var cuadro = document.getElementById(id);
        cuadro.style.display = 'block';
    }

    function cerrarCuadro(id) {
        var cuadro = document.getElementById(id);
        cuadro.style.display = 'none';
    }
</script>
<!-- Modal para mostrar los resultados -->
<div id="cuadroResultados" class="cuadro-adicional" style="display: none;">
    <span class="cerrar" onclick="cerrarCuadro('cuadroResultados')">X</span>
    <!-- Contenido del modal -->
    <h2>Resultados de la Búsqueda</h2>
    <div id="resultados"></div>
</div>
<!--Fin Cuadro blanco  busqueda -->




<div class="cuadro-blancoopciones">
    <section class="textos-opciones">
        <ul>
            <li class="boton-lista" onclick="mostrarCuadro('cuadroPacientes')">Pacientes</li>
            <li class="boton-lista" onclick="mostrarCuadro('cuadroCitas')">Citas</li>
            <li class="boton-lista" onclick="mostrarCuadro('cuadroAgendar')">Agendar</li>
        </ul>
    </section>
    

<!-- Cuadro blanco adicional para Pacientes -->
<div id="cuadroPacientes" class="cuadro-adicional cuadro-pacientes">
    <span class="cerrar" onclick="cerrarCuadro('cuadroPacientes')">X</span>
    <!-- Contenido del cuadro blanco adicional para Pacientes -->
    <h2>Información de Pacientes</h2>
    <button class="boton-alta" onclick="mostrarCuadro('altaPaciente')">Dar de alta paciente</button>
    <input type="button" class="boton-alta" value="Actuliza registros de la tabla"  onclick="location.reload()"></input>

    <table border="1">
        <tr>
             <!--<th>ID<th>-->
            <th>Nombre Paciente</th>
            <th>Expediente</th>
            <th>Citas</th>
            <th>Accion</th>
            
            
            <!-- Puedes agregar más encabezados según tus necesidades -->
        </tr>
        <?php   require ('conecta.php');
      $sql= "select * from paciente";
        $resultq=mysqli_query($con,$sql);
        while ($resultado = mysqli_fetch_array($resultq))
            {                   
     ?>
        <tr>
           <!-- <td><//?php echo $resultado['id']?></td>-->
            <td><?php echo $resultado['nombre']?></td>
            <td style="text-align: center;"><img src="/odontosaurioApp/PaginaWeb/img/see.png" alt="ver" style="cursor: pointer;" onclick="mostrarCuadro('expedientePaciente')?id=<?php echo $resultado['id'];?>"></td>
            <td style="text-align: center;"><img src="/odontosaurioApp/PaginaWeb/img/see.png" alt="ver" style="cursor: pointer;" onclick="mostrarCuadro('citasPaciente')"></td>
            <td style="text-align: center;"><a href="deletePacIntAdm.php?id=<?php echo $resultado['id']?> " class="bto-eliminar">Eliminar</a></td>
            <!-- Puedes agregar más celdas según tus necesidades -->
        </tr>
        <?php 
        }
        ?><!-- Puedes agregar más filas según tus necesidades -->
    </table>
</div>

<!-- Nuevo cuadro adicional para Alta de Paciente -->
<div id="altaPaciente" class="cuadro-adicional" style="display: none;">
    <span class="cerrar" onclick="cerrarCuadro('altaPaciente')">X</span>
    <!-- Contenido específico del nuevo cuadro para el alta de paciente -->
    <section class="textos-alta">
        <h1>Alta de Paciente</h1>
        <!-- Agregar el formulario para dar de alta al paciente -->
        <div class="cuadro-AltoDoctor">


        <form  method="post">
            <?php
           require "conecta.php";
           require('AltaPaciente.php');
            ?>
                <!-- Campos del formulario (nombre, CURP, etc.) -->
                <input class="controller" type="text" id="nombre" name="nombre" placeholder = "nombre completo" required>
                <input class="controller" type="text" id="curp" name="curp" placeholder="curp"  minlength="18" maxlength="18" pattern="[A-Za-z0-9]*" title="Solo Puedes Utilizar Letras y Numeros"required>
                <input class="controller" type="text" id="telefono" name="telefono" maxlength="10" placeholder="telefono" required>
                <input class="controller" type="password" id="contraseña" name="pasw" placeholder="contraseña" required>
                <input class="controller" type="text" id="nacionalidad" name="nacionalidad" placeholder="nacionalidad" required>
                <input class="controller" type="tel" id="edad" name="edad" maxlength="3" placeholder="edad" required>
                
                <!-- Otros campos del formulario... -->
    
                <!-- Botón para enviar el formulario -->
                <input class="buttonAlta-Paciente" type="submit" value="Agregar Paciente" name="RegistraPaciente">
            </form>
        </div>
    </section>
</div>



<!-- Nuevo cuadro adicional para Expediente del Paciente -->
<div id="expedientePaciente" class="cuadro-adicional" style="display: none;">
    <span class="cerrar" onclick="cerrarCuadro('expedientePaciente')">X</span>
    <!-- Contenido específico del nuevo cuadro para el expediente del paciente -->
    <section class="textos-expediente">
        <h1>Expediente</h1>
        <ul>
            <li>Nombre:</li>
            <li>CURP:</li>
            <div class="linea-negra"></div> <!-- Agrega la línea negra aquí -->
        </ul>

        <ul class="expediente" id="lista1">
            <li>Motivo de consulta:</li>
            <li>Padecimientos actuales:</li>
            <li>Ultimo examen dental:</li>
            <li>Antecedentes médicos:</li>
            <li>Doctor a cargo:</li>
        </ul>
        <h2 class="boton-lista">Modificar expediente</h2>
    </section>
</div>

<!-- Nuevo cuadro adicional para Citas del Paciente -->
<div id="citasPaciente" class="cuadro-adicional" style="display: none;">
    <span class="cerrar" onclick="cerrarCuadro('citasPaciente')">X</span>
    <!-- Contenido específico del nuevo cuadro para las citas del paciente -->
    <section class="textos-citas">
        <h1>Citas</h1>
        <ul>
            <li>Nombre:</li>
            <li>CURP:</li>
            <li>Numero celular:</li>
            <div class="linea-negra"></div> <!-- Agrega la línea negra aquí -->
        </ul>

        <ul class="citas" id="lista2">
            <li>Numero cita:</li>
            <li>Fecha:</li>
            <li>Hora:</li>
            <li>Doctor a cargo:</li>
        </ul>
        <h2 class="boton-lista">Eliminar cita</h2>
    </section>
</div>
<!-- Fin del Cuadro blanco adicional para Pacientes -->







<!-- Cuadro blanco adicional para agendar -->
<div id="cuadroAgendar" class="cuadro-adicional cuadro-agendar">
        <span class="cerrar" onclick="cerrarCuadro('cuadroAgendar')">X</span>
        <!-- Contenido del cuadro blanco adicional para doctores -->
        <h2>Agendar cita</h2>
        

    </div>
<!-- Fin del Cuadro blanco adicional para agendar -->












<!-- Nuevo cuadro adicional para Citas del Paciente -->
<div id="citasPaciente" class="cuadro-adicional" style="display: none;">
    <span class="cerrar" onclick="cerrarCuadro('citasPaciente')">X</span>
    <!-- Contenido específico del nuevo cuadro para las citas del paciente -->
    <section class="textos-citas">
        <h1>Citas</h1>
        <ul>
            <li>Nombre:</li>
            <li>CURP:</li>
            <li>Numero celular:</li>
            <div class="linea-negra"></div> <!-- Agrega la línea negra aquí -->
        </ul>

        <ul class="citas" id="lista2">
            <li>Numero cita:</li>
            <li>Fecha:</li>
            <li>Hora:</li>
            <li>Doctor a cargo:</li>
        </ul>
        <h2 class="boton-lista">Eliminar cita</h2>
    </section>
</div>
<!-- Fin del Cuadro blanco adicional para Pacientes -->






<!-- Cuadro blanco adicional para citas -->
    <div id="cuadroCitas" class="cuadro-adicional cuadro-citas">
        <span class="cerrar" onclick="cerrarCuadro('cuadroCitas')">X</span>
        <!-- Contenido del cuadro blanco adicional para citas -->
        <h2>Información de citas</h2>
        <table border="1">
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Paciente</th>
            <th>Borrar Cita</th>
            <!-- Puedes agregar más encabezados según tus necesidades -->
        </tr>
        <tr>
            <td>2023-11-09</td>
            <td>10:00 AM</td>
            <td>Jose eduardo perez jimenez</td>
            <td style="text-align: center;"><img src="/odontosaurioApp/PaginaWeb/img/borrar.png" alt="Borrar" style="cursor: pointer;"></td>
            <!-- Puedes agregar más celdas según tus necesidades -->
        </tr>
        <!-- Puedes agregar más filas según tus necesidades -->
    </table>
    </div>
</div>
<!-- Fin del Cuadro blanco adicional para citas -->



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
    <script src="/odontosaurioApp/PaginaWeb/js/listas.js"></script>
    <script src="/odontosaurioApp/PaginaWeb/js/PopupAyudaySoporte.js"></script>
    </body>   
</html>