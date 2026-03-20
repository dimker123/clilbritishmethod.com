<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = strip_tags(trim($_POST["nombre"]));
    $academia = strip_tags(trim($_POST["academia"] ?? ""));
    $email = strip_tags(trim($_POST["email"]));
    $telefono = strip_tags(trim($_POST["telefono"]));
    $alumnos = strip_tags(trim($_POST["alumnos"]));

    if (empty($nombre) || empty($email) || empty($telefono)) {
        http_response_code(400);
        echo "Por favor, completa todos los campos requeridos.";
        exit;
    }

    $recipient = "info@clilbritishmethod.com";
    $subject = "Nueva Solicitud de Partner - " . $academia;

    $email_content = "Has recibido una nueva solicitud de academia.\n\n";
    $email_content .= "Nombre del Director: " . $nombre . "\n";
    $email_content .= "Academia: " . ($academia ?: "No indicada") . "\n";
    $email_content .= "Email Profesional: " . $email . "\n";
    $email_content .= "Teléfono Profesional: " . $telefono . "\n";
    $email_content .= "Nº Alumnos: " . $alumnos . "\n";

    $email_headers = "From: info@clilbritishmethod.com\r\n";
    $email_headers .= "Reply-To: " . $email . "\r\n";
    $email_headers .= "MIME-Version: 1.0\r\n";
    $email_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $email_headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

    if (mail($recipient, $subject, $email_content, $email_headers)) {
        header("Location: /gracias");
    } else {
        http_response_code(500);
        echo "Error al enviar el correo.";
    }
} else {
    header("Location: index.html");
}
?>
