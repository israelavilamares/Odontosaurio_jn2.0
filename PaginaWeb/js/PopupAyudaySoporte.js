document.addEventListener("DOMContentLoaded", function () {
    var mostrarAyudaPopupButton = document.getElementById("ayudaBtn");
    var cerrarAyudaPopupButton = document.querySelector("#ayudaPopup .close");
    var ayudaPopup = document.getElementById("ayudaPopup");

    mostrarAyudaPopupButton.addEventListener("click", function (e) {
        e.preventDefault(); // Evitar que el enlace cambie la URL
        ayudaPopup.style.display = "block";
    });

    cerrarAyudaPopupButton.addEventListener("click", function () {
        ayudaPopup.style.display = "none";
    });

    // Agregar evento de clic para cerrar el popup cuando se hace clic fuera de él
    document.addEventListener("click", function (e) {
        if (e.target === ayudaPopup) {
            ayudaPopup.style.display = "none";
        }
    });
});

function cerrarAyudaPopup(id) {
    var ayudaPopup = document.getElementById(id);
    ayudaPopup.style.display = "none";
}