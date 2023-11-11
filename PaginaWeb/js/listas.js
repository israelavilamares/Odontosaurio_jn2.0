function mostrarCuadro(id) {
    // Si el cuadro a mostrar no es ni 'expedientePaciente' ni 'citasPaciente', oculta los demás
    if (id !== 'expedientePaciente' && id !== 'citasPaciente' && id !== 'altaPaciente' && id !== 'infoDoctor' && id !== 'altaDoctor' && id !== 'altaAdmin') {
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