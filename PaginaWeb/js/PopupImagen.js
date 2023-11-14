document.addEventListener("DOMContentLoaded", function () {
    var mostrarPopupImagenButton = document.getElementById("mostrar-popup-imagen");
    var cerrarPopupImagenButton = document.getElementById("cerrar-popup-imagen");
    var popupImagen = document.getElementById("popup-imagen");

    mostrarPopupImagenButton.addEventListener("click", function () {
        popupImagen.style.display = "block";
    });

    cerrarPopupImagenButton.addEventListener("click", function () {
        popupImagen.style.display = "none";
    });

    // Agregar evento de clic para cerrar el popup cuando se hace clic fuera de él
    document.addEventListener("click", function (e) {
        if (e.target === popupImagen) {
            popupImagen.style.display = "none";
        }
    });
});