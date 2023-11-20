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

//CAMBIOOOO nuevo sejmento que controla las ids sin cambiar la URL
document.addEventListener('DOMContentLoaded', function () {
    var enlacesVerAdmin = document.querySelectorAll('.ver-admin');

    enlacesVerAdmin.forEach(function (enlace) {
        enlace.addEventListener('click', function (event) {
            event.preventDefault();

            var idAdmin = enlace.getAttribute('data-id');

            // Utiliza AJAX para enviar la ID al servidor
            $.ajax({
                url: 'obtenerInfoAdmin.php', // Nombre del script PHP que manejará la solicitud
                type: 'GET',
                data: { id: idAdmin },
                success: function (data) {
                    // Muestra el cuadro de información del administrador con la respuesta del servidor
                    mostrarCuadro('infoAdmin');
                    // Actualiza el contenido del cuadro con la información obtenida del servidor
                    document.querySelector('#infoAdmin .textos-info-admin').innerHTML = data;
                },
                error: function () {
                    console.error('Error al obtener información del administrador.');
                }
            });
        });
    });
});

//CAMBIOOOO nuevo sejmento que controla las ids sin cambiar la URL
document.addEventListener('DOMContentLoaded', function () {
    var enlacesVerDoc = document.querySelectorAll('.ver-Doc');

    enlacesVerDoc.forEach(function (enlace) {
        enlace.addEventListener('click', function (event) {
            event.preventDefault();

            var idDoctor = enlace.getAttribute('data-id');

            // Utiliza AJAX para enviar la ID al servidor
            $.ajax({
                url: 'obtenerInfoDoc.php', // Nombre del script PHP que manejará la solicitud
                type: 'GET',
                data: { id: idDoctor },
                success: function (data) {
                    // Muestra el cuadro de información del administrador con la respuesta del servidor
                    mostrarCuadro('infoDoctor');
                    // Actualiza el contenido del cuadro con la información obtenida del servidor
                    document.querySelector('#infoDoctor.textos-info-doctor').innerHTML = data;
                },
                error: function () {
                    console.error('Error al obtener información del Doctor.');
                }
            });
        });
    });
});