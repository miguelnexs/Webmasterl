<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $response = array();

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $to = "webmasterl@webmasterl.es";
        $subject = "Nueva suscripción al boletín informativo";
        $message = "Se ha registrado una nueva suscripción al boletín informativo con el siguiente correo electrónico: " . $email;
        $headers = "From: no-reply@webmasterl.es\r\n" .
                   "Reply-To: no-reply@webmasterl.es\r\n" .
                   "X-Mailer: PHP/" . phpversion();

        if (mail($to, $subject, $message, $headers)) {
            $response['message'] = "Gracias por suscribirte a nuestro boletín informativo.";
        } else {
            $response['message'] = "Hubo un error al enviar tu suscripción. Por favor, intenta nuevamente.";
        }
    } else {
        $response['message'] = "Por favor, introduce un correo electrónico válido.";
    }

    echo json_encode($response);
}
?>
