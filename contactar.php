<?php include 'header.php'; ?>

<link rel="stylesheet" href="contactar.css">

<section class="principal">
    <div class="formulario">
        <div class="imagen_fondo">
            <div class="objeto"></div>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="formulario-contacto" id="contactForm">
                <h3>Comunícanos de inmediato</h3>
                <div class="input">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" required>
                    <div class="error" id="errorNombre"></div>
                </div>
                <div class="input">
                    <label for="numero">Número:</label>
                    <input type="tel" id="numero" name="numero" required>
                    <div class="error" id="errorNumero"></div>
                </div>
                <div class="input">
                    <label for="email">Correo electrónico:</label>
                    <input type="email" id="email" name="email" required>
                    <div class="error" id="errorEmail"></div>
                </div>
                <div class="input">
                    <label for="mensaje">Mensaje:</label>
                    <textarea id="mensaje" name="mensaje" cols="30" rows="10" required></textarea>
                    <div class="error" id="errorMensaje"></div>
                </div>
                <input type="submit" value="Enviar">
            </form>
        </div>
    </div>
    <div id="formMessage">
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
            $numero = filter_var($_POST['numero'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $mensaje = filter_var($_POST['mensaje'], FILTER_SANITIZE_STRING);

            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $to = "webmasterl@webmasterl.es";
                $subject = "Nuevo mensaje de contacto";
                $message = "Nombre: " . $nombre . "\n" .
                           "Número: " . $numero . "\n" .
                           "Correo electrónico: " . $email . "\n" .
                           "Mensaje: " . $mensaje;
                $headers = "From: no-reply@webmasterl.es\r\n" .
                           "Reply-To: " . $email . "\r\n" .
                           "Content-Type: text/plain; charset=UTF-8\r\n" .
                           "X-Mailer: PHP/" . phpversion();

                if (mail($to, $subject, $message, $headers)) {
                    echo "Gracias por contactarnos. Nos pondremos en contacto contigo pronto.";
                    echo "<script>document.getElementById('contactForm').reset();</script>";
                } else {
                    echo "Hubo un error al enviar tu mensaje. Por favor, intenta nuevamente.";
                }
            } else {
                echo "Por favor, introduce un correo electrónico válido.";
            }
        }
        ?>
    </div>
</section>

<?php include 'footer.php'; ?>

<script>
    document.getElementById('contactForm').addEventListener('submit', function(event) {
        var nombre = document.getElementById('nombre').value;
        var numero = document.getElementById('numero').value;
        var email = document.getElementById('email').value;
        var mensaje = document.getElementById('mensaje').value;

        var isValid = true;

        // Validación básica del formulario
        if (!nombre.trim()) {
            isValid = false;
            document.getElementById('errorNombre').textContent = 'Por favor, introduce tu nombre.';
        } else {
            document.getElementById('errorNombre').textContent = '';
        }

        if (!numero.trim()) {
            isValid = false;
            document.getElementById('errorNumero').textContent = 'Por favor, introduce tu número.';
        } else {
            document.getElementById('errorNumero').textContent = '';
        }

        if (!email.trim() || !/^\S+@\S+\.\S+$/.test(email)) {
            isValid = false;
            document.getElementById('errorEmail').textContent = 'Por favor, introduce un correo electrónico válido.';
        } else {
            document.getElementById('errorEmail').textContent = '';
        }

        if (!mensaje.trim()) {
            isValid = false;
            document.getElementById('errorMensaje').textContent = 'Por favor, introduce tu mensaje.';
        } else {
            document.getElementById('errorMensaje').textContent = '';
        }

        if (!isValid) {
            event.preventDefault(); // Evita que se envíe el formulario si hay errores
        } else {
            // Reinicia los mensajes de error si el formulario es válido
            document.querySelectorAll('.error').forEach(function(error) {
                error.textContent = '';
            });
        }
    });
</script>

