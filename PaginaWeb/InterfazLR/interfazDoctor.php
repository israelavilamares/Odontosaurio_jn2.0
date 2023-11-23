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
            <li id="mostrar-popup-agendar" class="boton-lista">Agendar</li>
        </ul>
    </section>
    


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
       
    </section>
</div>



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
        <?php
        require('conecta.php');
        
        // Supongamos que tienes la CURP almacenada en la variable $_SESSION['curp']
        $id = $_SESSION['id'];
        // Consulta SQL para obtener las citas relacionadas con la CURP
        $sql = "SELECT consulta.*, paciente.nombre
                FROM consulta
                JOIN paciente ON  consulta.CURP_paciente = paciente.curp_usuario 
                WHERE consulta.idDoctor_doctor = ?
                ORDER BY consulta.fecha, consulta.hora";

        // Preparar la consulta
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 's', $id);
        
        // Ejecutar la consulta
        mysqli_stmt_execute($stmt);

        // Obtener resultados
        $resultq = mysqli_stmt_get_result($stmt);

        while ($resultado = mysqli_fetch_array($resultq)) { ?>
            <tr>
                <td><?php echo $resultado['fecha'] ?></td>
                <td><?php echo $resultado['hora'] ?></td>
                <td><?php echo $resultado['nombre'] ?></td>
                <td style="text-align: center;"><a href='deleteCitasIntDoc.php?id=<?php echo $resultado['id']; ?>' class="bto-eliminar">Eliminar</a></td>
                <!-- Puedes agregar más celdas según tus necesidades -->
            </tr>
            <!-- Puedes agregar más filas según tus necesidades -->
        <?php } ?>
    </table>
</div>
<!-- Fin del Cuadro blanco adicional para citas -->






<!-- popup agendar citas-->
<div id="popup-agendar" class="popup-agendar">
    <form id="form-agendar" method="post" action="agendar.php">
        <div>
            <span id="cerrar-popup-agendar" class="cerrar-popup">X</span>
            Selecciona un paciente: 
            <select name="curp" id="paciente">
            <?php
                  require('conecta.php');
    
                  // Cambia la consulta para obtener todos los pacientes, no solo los asociados al doctor actual
                  $sql = "SELECT nombre, curp_usuario FROM paciente";
                  $resultq = mysqli_query($con, $sql);

                  while ($resultado = mysqli_fetch_array($resultq)) {
                  echo "<option value='" . $resultado['curp_usuario'] . "' data-nombre='" . $resultado['nombre'] . "'>" . $resultado['nombre'] . "</option>";
                  }
             ?>
            </select>
            <br><br><br>
            Selecciona un día:    <input type="date" name="fecha" id="fecha" min="2023-12-01" max="2024-06-30">         
            Selecciona una hora:    <input type="time" name="hora" id="hora" min="09:00" max="19:00" required> <br><br><br>
            Selecciona un doctor: 
            <select name="doctor" id="doctor">
            <?php
                require ('conecta.php');
                $sql= "select * from doctor";
                $resultq=mysqli_query($con,$sql);
                $consultorios = range(1, 5); // Crear un array con los números de consultorio
                shuffle($consultorios); // Mezclar el array para asignar consultorios de manera aleatoria
                while ($resultado = mysqli_fetch_array($resultq))
                {   
                    $consultorio = array_pop($consultorios); // Asignar un consultorio a cada doctor
                    echo "<option value='".$resultado['idDoctor']."' data-consultorio='".$consultorio."'>".$resultado['nombre']." (Consultorio: ".$consultorio.")</option>";
                }
            ?>
            </select> <br><br><br>
            <input type="hidden" name="consultorio" id="consultorio" value="">
            <input type="submit" value="Agendar">
        </div>
    </form>
    <div id="mensaje-exito" class="mensaje-exito">Cita agendada con éxito.</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    // Cuando se cambia el valor del select de doctores
    $('#doctor').change(function() {
        // Obtén el valor del atributo data-consultorio de la opción seleccionada
        var consultorio = $('option:selected', this).data('consultorio');
        // Establece el valor del campo oculto de consultorio
        $('#consultorio').val(consultorio);
    });

    // Asigna el valor del consultorio de la opción predeterminada al cargar la página
    var consultorio = $('#doctor option:selected').data('consultorio');
    $('#consultorio').val(consultorio);

    // Cuando se cambia el valor del select de pacientes
    $('#paciente').change(function() {
        // Obtén el valor de la opción seleccionada
        var curp = $(this).val();
        // Establece el valor del campo de curp
        $('#curp').val(curp);
    });

    // Asigna el valor de curp de la opción predeterminada al cargar la página
    var curp = $('#paciente option:selected').val();
    $('#curp').val(curp);

    $("#form-agendar").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url: 'agendar.php',
            type: 'post',
            data: $(this).serialize(),
            success: function(response){
                $("#mensaje-exito").show().delay(3000).fadeOut();
                setTimeout(function() {
                        location.reload();
                    }, 2000);
                $("#popup-agendar").delay(3000).fadeOut();
            }
        });
    });
});
</script>
<!-- fin popup agendar citas-->
















<!-- Nuevo cuadro adicional para Citas del Paciente -->
<div id="citasPaciente" class="cuadro-adicional" style="display: none;">
    <span class="cerrar" onclick="cerrarCuadro('citasPaciente')">X</span>
    <!-- Contenido específico del nuevo cuadro para las citas del paciente -->
    <section class="textos-citas">

    </section>
</div>
<!-- Fin del Cuadro blanco adicional para Pacientes -->




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
        <?php
        require('conecta.php');
        
        // Supongamos que tienes la CURP almacenada en la variable $_SESSION['curp']
        $id = $_SESSION['id'];
        // Consulta SQL para obtener las citas relacionadas con la CURP
        $sql = "SELECT consulta.*, paciente.nombre 
                FROM consulta
                JOIN paciente ON  consulta.CURP_paciente = paciente.curp_usuario 
                WHERE consulta.idDoctor_doctor = ?
                ORDER BY consulta.fecha, consulta.hora";

        // Preparar la consulta
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 's', $id);
        
        // Ejecutar la consulta
        mysqli_stmt_execute($stmt);

        // Obtener resultados
        $resultq = mysqli_stmt_get_result($stmt);

        while ($resultado = mysqli_fetch_array($resultq)) { ?>
        <tr>
           <!-- <td><//?php echo $resultado['id']?></td>-->
            <td><?php echo $resultado['nombre']?></td>
            <td style="text-align: center;"><a href="#" class="ver-DocExp" data-id="<?php echo $resultado['id']?>" style="cursor: pointer;"><img src="/odontosaurioApp/PaginaWeb/img/see.png"></img></a></td>
            <td style="text-align: center;"><a href="#" class="ver-DocPac" data-id="<?php echo $resultado['id']?>" style="cursor: pointer;"><img src="/odontosaurioApp/PaginaWeb/img/see.png"></img></a></td>
            <td style="text-align: center;"><a href="deletePacIntDoc.php?id=<?php echo $resultado['id']?> " class="bto-eliminar">Eliminar</a></td>
            <!-- Puedes agregar más celdas según tus necesidades -->
        </tr>
        <?php 
        }
        ?><!-- Puedes agregar más filas según tus necesidades -->
    </table>
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
    <script src="/odontosaurioApp/PaginaWeb/js/listas.js"></script>
    <script src="/odontosaurioApp/PaginaWeb/js/PopupCita.js"></script>
    <script src="/odontosaurioApp/PaginaWeb/js/PopupAyudaySoporte.js"></script>
    </body>   
</html>