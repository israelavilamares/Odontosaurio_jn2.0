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
      <h4>editar</h4>
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

<div class="cuadro-blancobusqueda">
    <input type="text" class="barra-busqueda" placeholder="Buscar...">
</div>



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





<!-- Cuadro blanco adicional para doctores -->
    <div id="cuadroDoctores" class="cuadro-adicional cuadro-doctores">
        <span class="cerrar" onclick="cerrarCuadro('cuadroDoctores')">X</span>
        <!-- Contenido del cuadro blanco adicional para doctores -->
        <h2>Información de Doctores</h2>
        <button class="boton-alta" onclick="mostrarCuadro('altaDoctor')">Dar alta doctor </button>
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
            <td style="text-align: center;"><img src="/odontosaurioApp/PaginaWeb/img/see.png" alt="ver" style="cursor: pointer;" onclick="mostrarCuadro('infoDoctor')"></td>
            <td style="text-align: center;"><a href='deleteDocIntAdm.php?id=<?php echo $resultado['idDoctor'];?>' class="bto-eliminar2">Eliminar</a></td>
            <!-- Puedes agregar más celdas según tus necesidades -->
        </tr>
        <!-- Puedes agregar más filas según tus necesidades -->
        <?php 
        } ?>
    </table>
    <a href=""></a>
    </div>

     <!--popup infodoctor-->
    <div id="infoDoctor" class="cuadro-adicional" style="display: none;">
    <span class="cerrar" onclick="cerrarCuadro('infoDoctor')">X</span>
    <!-- Contenido específico del nuevo cuadro para el infodoctor -->
    <section class="textos-info-doctor">
        <h1>Info</h1>
        <ul>
            <li>Nombre:</li>
            <li>Apellidos:</li>
            <li>Contraseña:</li>
            <li>Numero celular:</li>
            <li>Especialidad:</li>
            <div class="linea-negra"></div> <!-- Agrega la línea negra aquí -->
        </ul>
        <h2 class="boton-lista">Editar informacion</h2>
    </section>
</div>


<!-- Nuevo cuadro adicional para Alta de doctor -->
<div id="altaDoctor" class="cuadro-adicional" style="display: none;">
    <span class="cerrar" onclick="cerrarCuadro('altaDoctor')">X</span>
    <!-- Contenido específico del nuevo cuadro para el alta de paciente -->
    <section class="textos-alta-doctor">
        <h1>Alta de Doctor</h1>
        <!-- Agregar el formulario para dar de alta al doctor -->
        <div class="cuadro-AltoDoctor">
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
    <div id="cuadroAdministradores" class="cuadro-adicional cuadro-administradores">
        <span class="cerrar" onclick="cerrarCuadro('cuadroAdministradores')">X</span>
        <!-- Contenido del cuadro blanco adicional para administradores -->
        <h2>Información de administradores</h2>
        <button class="boton-alta" onclick="mostrarCuadro('altaAdmin')">Dar alta Administrador </button>
        <table border="1">
        <tr>
            <th>Nombre Admin</th>
            <th>Info</th>
            <th>Eliminar</th>
            <!-- Puedes agregar más encabezados según tus necesidades -->
        </tr>
        <?php      require ('conecta.php');
      $sql= "select * from administrador";
        $resultq=mysqli_query($con,$sql);
        while ($resultado = mysqli_fetch_array($resultq))
            {                   
     ?>
        <tr>
            <td><?php echo $resultado['nombre'] ?></td>
           <!-- <td><a href="#" style="cursor: pointer;" data-id="<//?php echo $resultado['idAdmin'];?>" onclick="mostrarCuadro('infoAdmin')">ver</a></td>-->
           <td><a id="<?php echo $resultado['idAdmin']?>" style="cursor: pointer;"  onclick="mostrarCuadro('infoAdmin')">ver</a></td>
            <td style="text-align: center;"><a href='deleteAdmIntAdm.php?id=<?php echo $resultado['idAdmin'];?>' class="bto-eliminar">Eliminar</a></td>
            <!-- Puedes agregar más celdas según tus necesidades -->
        </tr>
        <?php 
        }
        ?>
        <!-- Puedes agregar más filas según tus necesidades -->
    </table>
    </div>

    <script>
       document.addEventListener('click', function(e){
    e.preventDefault();
      elemento = e.target;
      dataID = elemento.getAttribute('data-id');

     console.log(dataID);
      
      
});
    </script>

     <!--popup infoadminstrados-->
     <div id="infoAdmin"  class="cuadro-adicional" style="display: none;">
    <span class="cerrar" onclick="cerrarCuadro('infoAdmin')">X</span>
    <!-- Contenido específico del nuevo cuadro para el infoadmin -->
    <section class="textos-info-admin">
        <h1>Info</h1>
        <?php require ('conecta.php');
        $id=$_GET["id"];
      $sql= "select * from administrador WHERE idAdmin = '$id'";
        $resultq=mysqli_query($con,$sql);
        while ($resultado = mysqli_fetch_array($resultq))
           {         
                      
    ?>
        <ul>
            <li>Nombre: <?php echo $resultado["nombre"]; ?></li>
            <li>Contraseña: </li>
      <!--  <?php 
        
        }?>-->
            <div class="linea-negra"></div> <!-- Agrega la línea negra aquí -->
        </ul>
        <h2 class="boton-lista">Editar informacion</h2>
    </section>
</div>


<!-- Nuevo cuadro adicional para Alta de doctor -->
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