 document.addEventListener("DOMContentLoaded", function () {
        var mostrarPopupButton = document.getElementById("mostrar-popup");
        var cerrarPopupButton = document.getElementById("cerrar-popup");
        var popup = document.getElementById("popup");

        mostrarPopupButton.addEventListener("click", function () {
            popup.style.display = "block";
        });

        cerrarPopupButton.addEventListener("click", function () {
            popup.style.display = "none";
        });
        // Agregar evento de clic para cerrar el popup cuando se hace clic fuera de él
        document.addEventListener("click", function (e) {
            if (e.target === popup) {
                popup.style.display = "none";
            }
        });
    });