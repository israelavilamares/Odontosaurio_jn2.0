<div id="editChildresn" class="cuadro-adicional" style="display: none;">
    <span class="cerrar" onclick="cerrarCuadro('editChildresn')">X</span>
    <!-- Contenido específico del nuevo cuadro para el infodoctor -->
    <section class="textos-info-doctor">
        <h1>Info</h1>
       <form method="POST" action="">
        <input type="hidden" name ="id" value="<?php echo $resultado[0];  ?>">
        <label for="recip-name">Nombre</label>
        <input class=controller type="text"  name="nombre" value="<?php echo $resultado[1];  ?>">
        <label for="recip-name">especialidad</label>
          <input  type="text"  name="especialidad" value="<?php echo $resultado[3];  ?>" >
          <label for="recip-name">telefono</label>
          <input  type="text"  name="telefono" value="<?php echo $resultado[4];  ?>">
          <label for="recip-name">password</label>
          <input  type="password" name="pass" value="<?php echo $resultado[2];  ?>">
          <label for="recip-name">edad</label>
          <input  type="text" name="edad" value="<?php echo $resultado[5];  ?>">
          <button type="submit">Guardar Cambios</button>
        </form>
        <h2 class="boton-lista">Editar informacion</h2>
    </section>
</div>