<?php
require_once __DIR__ . "/Tools/PDO.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Políticas de Privacidad | ArengApp</title>
  <meta name="description" content="Términos y políticas de privacidad de la plataforma ArengApp.">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="./style.css">
  <style>
    .privacy-container {
      position: relative;
      z-index: 10;
      max-width: 800px;
      margin: 80px auto 40px;
      padding: 30px;
      background: rgba(255, 255, 255, 0.95);
      border-radius: 8px;
      box-shadow: 0 10px 40px rgba(0,0,0,0.15);
      font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
      color: #333;
      line-height: 1.6;
      max-height: calc(100vh - 160px);
      overflow-y: auto;
    }
    .privacy-container h1 {
      font-family: 'Oswald', sans-serif;
      color: #252120;
      border-bottom: 3px solid #18DFAD;
      padding-bottom: 10px;
      margin-top: 0;
    }
    .privacy-container h2 {
      font-family: 'Oswald', sans-serif;
      color: #33476a;
      margin-top: 24px;
      font-size: 1.25rem;
    }
    .back-btn-top {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: #252120;
      background: #18DFAD;
      padding: 8px 16px;
      border-radius: 20px;
      font-family: 'Oswald', sans-serif;
      font-size: 14px;
      text-decoration: none;
      margin-bottom: 20px;
      transition: background 0.2s;
    }
    .back-btn-top:hover {
      background: #15c498;
    }
  </style>
</head>
<body>

<div class="wrapper">
  <!-- Wave background -->
  <div class="wave-container">
    <div class="wave -one"></div>
    <div class="wave -two"></div>
    <div class="wave -three"></div>
  </div>

  <div class="privacy-container">
    <a href="index.php" class="back-btn-top"><i class="fa fa-arrow-left"></i> Volver al Reproductor</a>

    <h1>Política de Privacidad de ArengApp</h1>
    <p>
      La presente Política de Privacidad establece los términos en que <strong>ArengApp</strong> usa y protege la información que es proporcionada por sus usuarios al momento de utilizar su sitio web. Esta iniciativa está comprometida con la seguridad de los datos de sus usuarios y la preservación del patrimonio sonoro popular.
    </p>

    <h2>1. Información que es recogida</h2>
    <p>
      Nuestro sitio web podrá recoger información técnica de navegación (como dirección IP anónima, tipo de navegador y sistema operativo) únicamente con fines analíticos y de rendimiento de audio. ArengApp no solicita ni almacena datos personales sensibles sin el consentimiento expreso del usuario.
    </p>

    <h2>2. Uso de la información recogida</h2>
    <p>
      La información técnica se emplea con el fin de optimizar el streaming de audio, asegurar la compatibilidad entre dispositivos y mejorar la experiencia de usuario del catálogo de arengas. ArengApp está altamente comprometido para cumplir con el compromiso de mantener su información segura.
    </p>

    <h2>3. Uso de Cookies</h2>
    <p>
      Una cookie se refiere a un fichero enviado con el fin de solicitar permiso para almacenarse en su navegador web. ArengApp utiliza cookies técnicas y de sesión para recordar el estado de reproducción, volumen y preferencias de filtrado de categorías. Usted puede eliminar o declinar el uso de cookies en cualquier momento desde la configuración de su navegador.
    </p>

    <h2>4. Enlaces a Terceros</h2>
    <p>
      Este sitio web puede contener enlaces a otros sitios de interés o perfiles de código abierto (como repositorios de GitHub). Una vez que haga clic en estos enlaces y abandone nuestra página, no tenemos control sobre las políticas ni la protección de datos de dichos sitios externos.
    </p>

    <h2>5. Control de su información personal</h2>
    <p>
      ArengApp no venderá, cederá ni distribuirá información personal que sea recopilada sin su consentimiento, salvo requerimiento judicial formal. ArengApp se reserva el derecho de cambiar los términos de la presente Política de Privacidad en cualquier momento.
    </p>

    <div style="margin-top: 30px; text-align: center; border-top: 1px solid #eee; padding-top: 15px; font-size: 13px; color: #777;">
      Desarrollado por Kevin Andrey Herrera Silva &bull; Todos los derechos reservados
    </div>
  </div>
</div>

</body>
</html>
