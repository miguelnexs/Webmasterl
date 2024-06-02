<footer class="footer">
    <div class="container">
        <div class="footer-links">
            <div>
              <ul>
                <h4>INICIO</h4>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="Contacto/contactar.php">Contacto</a></li>
                <li><a href="servicios/servicios.php">Servicios</a></li>
              </ul>  
            </div>
            <div>
              <ul>
                <h4>ENCUENTRANOS</h4>
                <li><a href="#">Instagram</a></li>
                <li><a href="#">YouTube</a></li>
                <li><a href="#">Facebook</a></li>
              </ul>  
            </div>
            <div class="newsletter">
                <h4>Boletín informativo</h4>
                <section class="newsletter">
                    <form id="newsletterForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input type="email" name="email" placeholder="Correo electrónico" required>
                        <button type="submit">Suscribirse</button>
                    </form>
                    <div id="formMessage">
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                                $to = "webmasterl@webmasterl.es";
                                $subject = "Nueva suscripción al boletín informativo";
                                $message = "Se ha registrado una nueva suscripción al boletín informativo con el siguiente correo electrónico: " . $email;
                                $headers = "From: no-reply@webmasterl.es\r\n" .
                                           "Reply-To: no-reply@webmasterl.es\r\n" .
                                           "Content-Type: text/plain; charset=UTF-8\r\n" .
                                           "X-Mailer: PHP/" . phpversion();

                                if (mail($to, $subject, $message, $headers)) {
                                    echo "Gracias por suscribirte a nuestro boletín informativo.";
                                } else {
                                    echo "Hubo un error al enviar tu suscripción. Por favor, intenta nuevamente.";
                                }
                            } else {
                                echo "Por favor, introduce un correo electrónico válido.";
                            }
                        }
                        ?>
                    </div>
                </section>
            </div>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="script.js"></script>
</body>
</html>
