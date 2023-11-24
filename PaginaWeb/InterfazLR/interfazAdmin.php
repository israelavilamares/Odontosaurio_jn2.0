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
    <link rel="stylesheet" type="text/css" href="../css/styleInterfazAdministrador.css">
    <link rel="shortcut icon" href="../img/icono.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wdth,wght@96.3,710;100,300;100,400;100,700;100,800&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> <!--CAMBIOOOOO agregue esta libreria para controlar los popup sin cambiar la URL-->
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
      <h1>ADMINISTRADOR</h1>
      <h2>Conectado</h2>
      <img src="/odontosaurioApp/PaginaWeb/img/user.png" alt="" class="imagen-user">
      <h3>Información de contacto</h3>
    
      <ul>
        <li>Nombre:
        <?php echo $_SESSION['nombre'];?>
        </li>
        <li>Puesto:
       <span><?php echo $_SESSION['puesto'];?></span> 
        </li>
            <li>
            Edad: <span><?php echo $_SESSION['edad'];?></span>
            </li>            
            <li>Número de celular: <?php echo $_SESSION['telefono'];?></li>
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
        xmlhttp.open("POST", "buscar.php", true);
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
            <li class="boton-lista" onclick="mostrarCuadro('cuadroDoctores')">Doctores</li>
            <li class="boton-lista" onclick="mostrarCuadro('cuadroAdministradores')">Administradores</li>
            <li class="boton-lista" onclick="mostrarCuadro('cuadroCitas')">Citas</li>
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
            <th>Agregar Expediente</th>
            <th>Eliminar</th>
            
            
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
            <td style="text-align: center;"><a href="#" class="ver-Exp" data-id="<?php echo $resultado[0]?>" style="cursor: pointer;"><img src="/odontosaurioApp/PaginaWeb/img/see.png"></img></a></td>
            <td style="text-align: center;"><a href="#" class="ver-Pac" data-id="<?php echo $resultado[0]?>" style="cursor: pointer;"><img src="/odontosaurioApp/PaginaWeb/img/see.png"></img></a></td>
            <td style="text-align: center;"><a href="#" class="alta-Exp" data-id="<?php echo $resultado[0]?>" style="cursor: pointer;"><img src="/odontosaurioApp/PaginaWeb/img/folder.png"></img></a></td>
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
        <div class="cuadro-AltaPaciente">


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







<!-- Nuevo cuadro adicional para Alta Expediente del Paciente -->
<div id="expedienteAlta" class="cuadro-adicional" style="display: none;">
    <span class="cerrar" onclick="cerrarCuadro('expedienteAlta')">X</span>
    <!-- Contenido específico del nuevo cuadro para el expediente del paciente -->
    <section class="textos-alta-expediente">
    </section>
</div>
<!-- Fin del Cuadro blanco adicional para Alta expedientes del paciente -->













<!-- Nuevo cuadro adicional para Expediente del Paciente -->
<div id="expedientePaciente" class="cuadro-adicional" style="display: none;">
    <span class="cerrar" onclick="cerrarCuadro('expedientePaciente')">X</span>
    <!-- Contenido específico del nuevo cuadro para el expediente del paciente -->
    <section class="textos-expediente">
    </section>
</div>
<!-- Fin del Cuadro blanco adicional para expedientes del paciente -->




<!-- Nuevo cuadro adicional para Citas del Paciente -->
<div id="citasPaciente" class="cuadro-adicional" style="display: none;">
    <span class="cerrar" onclick="cerrarCuadro('citasPaciente')">X</span>
    <!-- Contenido específico del nuevo cuadro para las citas del paciente -->
    <section class="textos-citas">
    </section>
</div>
<!-- Fin del Cuadro blanco adicional para Pacientes -->






<!-- Cuadro blanco adicional para doctores -->
    <div id="cuadroDoctores" class="cuadro-adicional cuadro-doctores">
        <span class="cerrar" onclick="cerrarCuadro('cuadroDoctores')">X</span>
        <!-- Contenido del cuadro blanco adicional para doctores -->
        <h2>Información de Doctores</h2>
        <button class="boton-alta" onclick="mostrarCuadro('altaDoctor')">Dar alta doctor </button>
        <input type="button" class="boton-alta" value="Actuliza registros de la tabla"  onclick="location.reload()"></input>
        <table border="1">
        <tr>
            <th>Nombre Doctor</th>
            <th>Info</th>
            <th>Eliminar</th>
            <!-- Puedes agregar más encabezados según tus necesidades -->
        </tr>
     <?php   require ('conecta.php');
      $sql= "select * from doctor";
        $resultq=mysqli_query($con,$sql);
        while ($resultado = mysqli_fetch_array($resultq))
            {                   
     ?>
        <tr>
            <td><?php echo $resultado['nombre'];  ?></td>
            <td style="text-align: center;"><a href="#"  class="ver-Doc" data-id="<?php echo $resultado['idDoctor']?>" style="cursor: pointer;"><img src="/odontosaurioApp/PaginaWeb/img/see.png"></img></a></td>
            <td style="text-align: center;"><a href='deleteDocIntAdm.php?id=<?php echo $resultado['idDoctor'];?>' class="bto-eliminar2">Eliminar</a></td>
        
        </tr>
        
        <?php } ?>
    </table>
</div>



     <!--popup infodoctor-->
     <div id="infoDoctor" class="cuadro-adicional" style="display: none;">
    <span class="cerrar" onclick="cerrarCuadro('infoDoctor')">X</span>
    <!-- Contenido específico del nuevo cuadro para el infodoctor -->
    <section class="textos-info-doctor">
    <h1>Info</h1>
    </section>
    </div> 
    






<!-- Nuevo cuadro adicional para Alta de doctor -->
<div id="altaDoctor" class="cuadro-adicional" style="display: none;">
    <span class="cerrar" onclick="cerrarCuadro('altaDoctor')">X</span>
    <!-- Contenido específico del nuevo cuadro para el alta de paciente -->
    <section class="textos-alta-doctor">
        <h1>Alta de Doctor</h1>
        <!-- Agregar el formulario para dar de alta al doctor -->
        <div class="cuadro-AltaDoctor">
            <form  method="post">
            <?php
           require "conecta.php";
           require('AltaDoctores.php');
            ?>
            
            <input class=controller type="text"  name="nombre" placeholder="nombre completo" required>
          
            <input class=controller type="text"  name="especialidad" placeholder="especialidad" required>
            
            <input class=controller type="text"  name="telefono" placeholder="telefono" maxlength="10"  required>
           
            <input class=controller type="password" name="pass" placeholder="contraseña"  required>
            
            <input class=controller type="text" name="edad" placeholder="Edad" required>
            <!-- Botón para enviar el formulario -->
            <input class="boton-Alta-Doctor" type="submit" name="RegistraDoc" value="Agregar">
        </form></div>

    </section>
</div>
<!-- Fin del Cuadro blanco adicional para Doctores -->










<!-- Cuadro blanco adicional para administradores -->

<!--CAMBIOOOOO aqui estaba el error de ver (corregido)-->
<div id="cuadroAdministradores" class="cuadro-adicional cuadro-administradores">
    <span class="cerrar" onclick="cerrarCuadro('cuadroAdministradores')">X</span>

    <!-- Contenido del cuadro blanco adicional para administradores -->
    <h2>Información de administradores</h2>
    <button class="boton-alta" onclick="mostrarCuadro('altaAdmin')">Dar alta Administrador </button>
    
    <input type="button" class="boton-alta" value="Actuliza registros de la tabla"  onclick="location.reload()"></input>
    <table border="1">
        <tr>
            <th>Nombre Admin</th>
            <th>Info</th>
            <th>Eliminar</th>
            <!-- Puedes agregar más encabezados según tus necesidades -->
        </tr>
        <?php
        require ('conecta.php');
        $sql = "select * from administrador";
        $resultq = mysqli_query($con, $sql);
        while ($resultado = mysqli_fetch_array($resultq)) { ?>
            <tr>
                <td><?php echo $resultado['nombre'] ?></td>
                <!-- Asegúrate de envolver la ID en comillas -->
               <td style="text-align: center;"><a href="#" class="ver-admin" data-id="<?php echo $resultado['idAdmin']?>" style="cursor: pointer;"><img src="/odontosaurioApp/PaginaWeb/img/see.png"></img></a></td>
                <td style="text-align: center;"><a href='deleteAdmIntAdm.php?id=<?php echo $resultado['idAdmin'];?>' class="bto-eliminar">Eliminar</a></td>
                <!-- Puedes agregar más celdas según tus necesidades -->
            </tr>
        <?php } ?>
        <!-- Puedes agregar más filas según tus necesidades -->
    </table>
</div>


<!--popup infoadminstrados-->
<div id="infoAdmin" class="cuadro-adicional" style="display: none;">
    <span class="cerrar" onclick="cerrarCuadro('infoAdmin')">X</span>
    <!-- Contenido específico del nuevo cuadro para el infoadmin -->
    <section class="textos-info-admin">
        <h1>Info</h1>
        
    </section>
</div>




<!-- Nuevo cuadro adicional para Alta de admin -->
<div id="altaAdmin" class="cuadro-adicional" style="display: none;">
    <span class="cerrar" onclick="cerrarCuadro('altaAdmin')">X</span>
    <!-- Contenido específico del nuevo cuadro para el alta de paciente -->
    <section class="textos-alta-Admin">
        <h1>Alta de Administrador</h1>
        <div  class="cuadro-AltaAdmin">
            <form method="post">
            <?php
           require "conecta.php";
           require('AltaAdmin.php');
           ?>
                <!-- Campos del formulario (nombre, apellido, etc.) -->
                <input class="controller" type="text" id="nombre" name="nombre" placeholder="nombre completo" required>
                <input class="controller" type="password" id="contraseña" name="passw" placeholder="contraseña" required>
                <input class="controller" type="tel" id="tel" name="telefono" placeholder="telefono" maxlength="10" required> 
                <input class="controller" type="text" id="puesto" name="puesto" placeholder="puesto" required>
                <input class="controller" type="tel" id="edad" name="edad" placeholder="edad" maxlength="3" required>
                
                <!-- Otros campos del formulario... -->
    
                <!-- Botón para enviar el formulario -->
                <input type="submit" class="boton-Alta-Admin" name="RegistrarAdmin" value="Dar de Alta">
            </form>
        </div>
        <!-- Agregar el formulario para dar de alta al admin -->
    </section>
</div>

<!-- Fin del Cuadro blanco adicional para Administradores -->









<!-- Cuadro blanco adicional para citas -->
<div id="cuadroCitas" class="cuadro-adicional cuadro-citas">
        <span class="cerrar" onclick="cerrarCuadro('cuadroCitas')">X</span>
        <!-- Contenido del cuadro blanco adicional para citas -->
        <h2>Información de citas</h2>
        <table border="1">
        <tr>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Dentista</th>
            <th>Borrar Cita</th>
            <!-- Puedes agregar más encabezados según tus necesidades -->
        </tr>
        <?php
         require ('conecta.php');
        $sql = "select * from consulta";
        $resultq = mysqli_query($con, $sql);
        while ($resultado = mysqli_fetch_array($resultq)) { ?>
        <tr>
            
            <td><?php echo $resultado[5]?></td>
            <td><?php echo $resultado[3]?></td>
            <?php    $sql = "select nombre from doctor JOIN consulta ON  doctor.idDoctor=consulta.idDoctor_doctor WHERE idDoctor = '$resultado[1]' limit 1";
        $resultaq2 = mysqli_query($con, $sql);
        while ($resultadoND = mysqli_fetch_array($resultaq2)) { ?>
             
             <td><?php echo $resultadoND[0]?></td>
             <?php } ?>      
            <td style="text-align: center;"><a href='deleteCitasIntAdm.php?id=<?php echo $resultado[2];?>' class="bto-eliminar">Eliminar</a></td>
            <!-- Puedes agregar más celdas según tus necesidades -->
        </tr>
        <!-- Puedes agregar más filas según tus necesidades -->
        <?php } ?>
    </table>

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