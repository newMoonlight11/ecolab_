// Seleccionamos ambos botones
const btnPrestamo = document.getElementById('btnPrestamo');
const btnDevolucion = document.getElementById('btnDevolucion');

// Función para alternar la clase 'active' entre ambos botones
btnPrestamo.addEventListener('click', function () {
    btnPrestamo.classList.add('active');
    btnDevolucion.classList.remove('active');
});

btnDevolucion.addEventListener('click', function () {
    btnDevolucion.classList.add('active');
    btnPrestamo.classList.remove('active');
});
