document.addEventListener("DOMContentLoaded", function () {
    var mostrarPopupAgendarButton = document.getElementById("mostrar-popup-agendar");
    var cerrarPopupAgendarButton = document.getElementById("cerrar-popup-agendar");
    var popupAgendar = document.getElementById("popup-agendar");

    mostrarPopupAgendarButton.addEventListener("click", function () {
        popupAgendar.style.display = "block";
    });

    cerrarPopupAgendarButton.addEventListener("click", function () {
        popupAgendar.style.display = "none";
    });

    // Agregar evento de clic para cerrar el popup cuando se hace clic fuera de él
    document.addEventListener("click", function (e) {
        if (e.target === popupAgendar) {
            popupAgendar.style.display = "none";
        }
    });

    var mostrarPopupVerButton = document.getElementById("mostrar-popup-ver");
    var cerrarPopupVerButton = document.getElementById("cerrar-popup-ver");
    var popupVer = document.getElementById("popup-ver");

    mostrarPopupVerButton.addEventListener("click", function () {
        popupVer.style.display = "block";
    });

    cerrarPopupVerButton.addEventListener("click", function () {
        popupVer.style.display = "none";
    });

    // Agregar evento de clic para cerrar el popup cuando se hace clic fuera de él
    document.addEventListener("click", function (e) {
        if (e.target === popupVer) {
            popupVer.style.display = "none";
        }
    });
});