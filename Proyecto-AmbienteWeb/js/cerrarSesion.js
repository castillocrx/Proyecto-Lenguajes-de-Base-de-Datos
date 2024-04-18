document.addEventListener('DOMContentLoaded', function () {
    var cerrarSesionBtn = document.getElementById('cerrarSesionBtn');

    if (cerrarSesionBtn) {
        cerrarSesionBtn.addEventListener('click', function () {
            window.location.href = 'cerrar-sesion.php';
        });
    }
});



