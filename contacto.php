<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = strip_tags(trim($_POST["nombre"]));
    $academia = strip_tags(trim($_POST["academia"]));
    $contacto = strip_tags(trim($_POST["contacto"]));
    $alumnos = strip_tags(trim($_POST["alumnos"]));

    if (empty($nombre) || empty($academia) || empty($contacto)) {
        http_response_code(400);
        echo "Por favor, completa todos los campos requeridos.";
        exit;
    }

    $recipient = "info@clilbritishmethod.com";
    $subject = "Nueva Solicitud de Partner - " . $academia;

    $email_content = "Has recibido una nueva solicitud de academia.\n\n";
    $email_content .= "Nombre del Director: " . $nombre . "\n";
    $email_content .= "Academia: " . $academia . "\n";
    $email_content .= "Contacto (Email/Tlf): " . $contacto . "\n";
    $email_content .= "Nº Alumnos: " . $alumnos . "\n";

    $email_headers = "From: noreply@clilbritishmethod.com\r\n";
    $email_headers .= "Reply-To: " . $contacto . "\r\n";
    $email_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($recipient, $subject, $email_content, $email_headers)) {
        header("Location: index.html?success=1");
    } else {
        http_response_code(500);
        echo "Error al enviar el correo.";
    }
} else {
    header("Location: index.html");
}
?>
