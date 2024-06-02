document.addEventListener("DOMContentLoaded", function() {
    createStars();
});

function createStars() {
    const numStars = 200; // Cambiar el número de estrellas a crear
    const container = document.querySelector(".principal");
    
    for (let i = 0; i < numStars; i++) {
        const star = document.createElement("div");
        star.classList.add("punto-blanco");
        star.style.left = `${Math.random() * 100}%`;
        star.style.top = `${Math.random() * 100}%`;
        star.style.animationDelay = `${Math.random() * 3}s`; // Retraso de la animación aleatorio
        container.appendChild(star);
    }
}


// Obtener la imagen
const globo = document.getElementById('globo');

// Función para animar la imagen
function animate() {
    let leftPosition = 0;
    const screenWidth = window.innerWidth;
    const step = 0.3; // Hacer que la animación sea más lenta

    // Función de animación
    function move() {
        leftPosition += step;
        globo.style.left = leftPosition + 'px';

        // Si la imagen sale completamente de la pantalla, regresarla al principio
        if (leftPosition > screenWidth) {
            leftPosition = -globo.width;
            globo.style.left = leftPosition + 'px'; // Mover la imagen de vuelta rápidamente
        }

        // Siguiente paso de la animación
        requestAnimationFrame(move);
    }

    // Iniciar la animación
    move();
}

// Iniciar la animación cuando la ventana esté cargada
window.onload = function() {
    animate();
};

const menuHamburguesa = document.querySelector('.menu_hamburguesa');
const navEnlaces = document.querySelector('.enlaces');

menuHamburguesa.addEventListener('click', () => {
    navEnlaces.classList.toggle('open');
});


// Función para mostrar la imagen seleccionada antes de enviar el formulario
document.querySelector('input[type="file"]').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
    const reader = new FileReader();
    reader.onload = function() {
        document.getElementById('preview').src = reader.result;
        document.getElementById('preview').style.display = 'block';
    }
    reader.readAsDataURL(file);
    }
});

function toggleVerMas(element) {
    const ul = element.previousElementSibling;
    ul.classList.toggle('expandido');
    element.textContent = ul.classList.contains('expandido') ? 'Ver menos' : 'Ver más';
}


$(document).ready(function(){
    $('#newsletterForm').on('submit', function(event){
        event.preventDefault(); // Detiene el envío del formulario
        $.ajax({
            url: $(this).attr('action'),
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#formMessage').html(response); // Muestra la respuesta en el div
            },
            error: function() {
                $('#formMessage').html('Hubo un error al enviar tu suscripción. Por favor, intenta nuevamente.');
            }
        });
    });
});

