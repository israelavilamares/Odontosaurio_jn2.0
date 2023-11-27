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
    <meta http-equiv="X-UA-Compatible" content="IEwedge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Odontosaurio</title>
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
        <h2>¡ Bienvenid@, <span><?php echo $_SESSION['nombre']; ?>!</span> </h2>
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
            <h1>Contenido de ayuda y soporte</h1>
            <h2>¿Tienes alguna duda? ¡No te preocupes!</h2>
            <h3>En este tutorial abarcamos todas las preguntas frecuentes que nos han hecho.</h3>
            <h4>Si las dudas persisten, no dudes en contactarnosen nuestro apartado "dudas y comentarios" en nuestra página principal.</h4>
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
      <h2>Conectad@</h2>
      <img src="/odontosaurioApp/PaginaWeb/img/user.png" alt="" class="imagen-user">
    </section>
  </div>
</div>

<div class="cuadro-blancoinfo">
    <section class="textos-info">
        <h1>Información de contacto</h1>
        <ul>
        <form  method="post">
            <?php
           require "conecta.php";
           require('EditarPaciente.php');
           ?>
            <li>Nombre: <span><?php echo $_SESSION['nombre']; ?></span>&nbsp;&nbsp;&nbsp;&nbsp;<input class="controls" type="text" name="nombre_edit" placeholder="Editar nombre completo" maxlength="50" required></li>
            <li>Edad: <span><?php echo $_SESSION['edad'];?><span>&nbsp;&nbsp;&nbsp;&nbsp;<input class="controls" type="tel" name="edad_edit" placeholder="Editar edad" minlength="1" maxlength="3" pattern="[0-9]*" title="Solo puedes Poner Numeros" required></li>
            <li>CURP: <span><?php echo $_SESSION['curp'];?><span>&nbsp;&nbsp;&nbsp;&nbsp;<input class="controls" type="text" name="curp_edit" value= <?php echo $_SESSION['curp']?> disabled> </li>
            <li>Número de celular: <span><?php echo $_SESSION['tel'];?><span>&nbsp;&nbsp;&nbsp;&nbsp;<input class="controls" type="tel" name="telefono" placeholder="Editar número de teléfono" minlength="10" maxlength="10" pattern="[0-9]*" title="Solo puedes Poner Numeros" required></li>
            <li>Nacionalidad: <span><?php echo $_SESSION['nacionalidad'];?><span>&nbsp;&nbsp;&nbsp;&nbsp;<input class="controls" type="text" name="nacionalidad_edit" placeholder="Editar nacionalidad" maxlength="50" required>&nbsp;&nbsp;
            <input class="button custom-button" type="submit" name="editar" onclick="recargarPagina()"></li>
            </form>
        </ul>
    </section>
</div>

<script>
    function recargarPagina() {
        var form = document.getElementById("editarForm");
        var formData = new FormData(form);

        // Utiliza AJAX para enviar el formulario
        var xhr = new XMLHttpRequest();
        xhr.open("POST", form.action, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Maneja la respuesta del servidor aquí si es necesario

                // Recarga la página sin caché
                setTimeout(function () {
                    location.reload(true);
                }, 500);
            }
        };
        xhr.send(formData);
    }
</script>



<div class="cuadro-blancocitas">
    <img src="/odontosaurioApp/PaginaWeb/img/boton.png" alt="" class="imagen-boton">
    <img src="/odontosaurioApp/PaginaWeb/img/boton.png" alt="" class="imagen-boton2">
    <section class="textos-citas">
        <h1>Encuentra tu dentista y agenda tu cita</h1>
        <h2 id="mostrar-popup-agendar">Agendar cita</h2>
        <h3 class="boton-lista" onclick="mostrarCuadro('cuadroCitas')"> Ver Citas</h3>
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
            <th>Dentista</th>
            <th>Borrar Cita</th>
            <!-- Puedes agregar más encabezados según tus necesidades -->
        </tr>
        <?php
        require('conecta.php');
        
        // Supongamos que tienes la CURP almacenada en la variable $_SESSION['curp']
        $curp = $_SESSION['curp'];

        // Consulta SQL para obtener las citas relacionadas con la CURP
        $sql = "SELECT consulta.*, doctor.nombre
                FROM consulta
                JOIN doctor ON doctor.idDoctor = consulta.idDoctor_doctor
                WHERE consulta.curp_paciente = ?
                ORDER BY consulta.fecha, consulta.hora";

        // Preparar la consulta
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, 's', $curp);
        
        // Ejecutar la consulta
        mysqli_stmt_execute($stmt);

        // Obtener resultados
        $resultq = mysqli_stmt_get_result($stmt);

        while ($resultado = mysqli_fetch_array($resultq)) { ?>
            <tr>
                <td><?php echo $resultado['fecha'] ?></td>
                <td><?php echo $resultado['hora'] ?></td>
                <td><?php echo $resultado['nombre'] ?></td>
                <td style="text-align: center;"><a href='deleteCitasIntPacient.php?id=<?php echo $resultado['id']; ?>' class="bto-eliminar">Eliminar</a></td>
                <!-- Puedes agregar más celdas según tus necesidades -->
            </tr>
            <!-- Puedes agregar más filas según tus necesidades -->
        <?php } ?>
    </table>
</div>
<!-- Fin del Cuadro blanco adicional para citas -->



<!-- popup agendar citas-->
<div id="popup-agendar" style="display: none; position: fixed; width: 80%; max-width: 600px; height: 80%; max-height: 400px; overflow: auto; background-color: white; z-index: 1000; border: 1px solid black; padding: 20px;">
    <form id="form-agendar" method="post" action="agendar.php">
        <div>
            <span id="cerrar-popup-agendar">X</span>
            Selecciona un paciente: 
            <select name="curp" id="paciente">
            <?php
                require ('conecta.php');
                $sql= "select nombre, curp_usuario from paciente where nombre = '".$_SESSION["nombre"]."'";
                $resultq=mysqli_query($con,$sql);
                while ($resultado = mysqli_fetch_array($resultq))
                    {   
                        echo "<option value='".$resultado['curp_usuario']."'>".$resultado['nombre']."</option>";
                    }
            ?>
            </select> <br><br><br>
            Selecciona un dia:    <input type="date" name="fecha" id="fecha" min="2023-12-01" max="2024-06-30">         
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
    <div id="mensaje-exito" style="display: none;">Cita agendada con éxito.</div>
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





<div class="cuadro-blancoexpediente">
    <section class="textos-expediente">
        <h1>Expediente</h1>
        <h2></h2>
        <ul>
            <li>Nombre: <span><?php echo $_SESSION['nombre']; ?></span></li>
            <li>CURP: <span><?php echo $_SESSION['curp']; ?></span></li>
            <div class="linea-negra"></div> <!-- Agrega la línea negra aquí -->
            </li>
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
            <li>Último examen dental: <span><?php echo $recuperado["ultimo_examen_dental"]; ?></span></li>
            <li>Antecedentes médicos: <span><?php echo $recuperado["antecedentes_medicos"]; ?></span></li>
            <li>Doctor/a a cargo: <span><?php echo $recuperado["doctor_a_cargo"]; ?></span></li>
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
        <h2 id="mostrar-popup-imagen">Subir imagen</h2>
    </section>
</div>    

<!-- popup para subir imagen -->
<div id="popup-imagen" style="display: none;">
    <div>
        <span id="cerrar-popup-imagen">X</span>
        Selecciona tu archivo: <br>
        <input type="file" name="archivos" id="archivos" accept=".jpg,.jpeg,.png"> <br><br><br>
        <input type="submit" value="Guardar">
        <!-- Contenido del popup para subir imagen -->
    </div>
</div>
<!-- Fin del popup para subir imagen -->

</main>

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
    <script src="/odontosaurioApp/PaginaWeb/js/listas.js"></script>
    </body>   
</html>