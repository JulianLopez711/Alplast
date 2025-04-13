<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $correo = $_POST['correo'];
    $ciudad = $_POST['ciudad'];
    $telefono = $_POST['telefono'];
    $producto = $_POST['producto'];
    $descripcion = $_POST['descripcion'];
    
    // Validar datos
    if (empty($nombre) || empty($apellido) || empty($correo) || empty($ciudad) || empty($telefono) || empty($producto) || empty($descripcion)) {
        echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios"]);
        exit();
    }
    
    // Validar formato de correo electrónico
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["status" => "error", "message" => "Formato de correo electrónico inválido"]);
        exit();
    }
    
    // Configuración del email
    $para = "alvaro.paez@alplast.com.co"; // Cambiado a la dirección correcta
    $asunto = "Nuevo contacto desde formulario web - Interesado en $producto";
    
    // Crear el mensaje en formato HTML
    $mensaje = "
    <html>
    <head>
        <title>Nuevo mensaje de contacto</title>
        <style>
            body { font-family: Arial, sans-serif; line-height: 1.6; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px; }
            h2 { color: #0056b3; }
            .info { margin-bottom: 20px; }
            .label { font-weight: bold; }
        </style>
    </head>
    <body>
        <div class='container'>
            <h2>Nuevo mensaje de contacto - Alplast</h2>
            <div class='info'>
                <p><span class='label'>Nombre completo:</span> $nombre $apellido</p>
                <p><span class='label'>Correo electrónico:</span> $correo</p>
                <p><span class='label'>Ciudad:</span> $ciudad</p>
                <p><span class='label'>Teléfono:</span> $telefono</p>
                <p><span class='label'>Producto de interés:</span> $producto</p>
                <p><span class='label'>Descripción:</span><br>$descripcion</p>
            </div>
            <p>Este mensaje fue enviado desde el formulario de contacto en la página web.</p>
        </div>
    </body>
    </html>
    ";
    
    // Cabeceras para enviar email en formato HTML
    $cabeceras = "MIME-Version: 1.0\r\n";
    $cabeceras .= "Content-type: text/html; charset=UTF-8\r\n";
    $cabeceras .= "From: Web Alplast <noreply@alplast.com>\r\n";
    $cabeceras .= "Reply-To: $correo\r\n";
    
    // Enviar el email
    if (mail($para, $asunto, $mensaje, $cabeceras)) {
        // Email enviado con éxito
        echo json_encode(["status" => "success", "message" => "Mensaje enviado con éxito"]);
    } else {
        // Error al enviar el email
        echo json_encode(["status" => "error", "message" => "Error al enviar el mensaje"]);
    }
} else {
    // Si no es una solicitud POST, redirigir a la página principal
    header("Location: index.html");
    exit();
}
?>