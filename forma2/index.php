<?php


require 'vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

var_dump($_FILES);
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
  $mail->SMTPDebug = 2; // Nivel de depuración (0, 1, 2, o 3)
$mail->Debugoutput = function ($str, $level) {
    file_put_contents('debug.log', $str, FILE_APPEND);
};


  //Server settings
  $mail->SMTPDebug = 0;            
  $mail->isSMTP();                                 
  $mail->Host       = 'mail.eprern.gov.ar';                     
  $mail->SMTPAuth   = true;       
  $mail->SMTPAutoTLS = false;       
  $mail->Username   = 'administrador@eprern.gov.ar';                     
  $mail->Password   = 'c1G482ur@37';
  $mail->SMTPSecure = '';  // Sin SSL ni TLS                
  $mail->Port       = 587;                                    


    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $dni = $_POST['dni'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $email = $_POST['email'] ?? '';
    $checkNombrePropio = $_POST['checkNombrePropio'] ?? '';
    $nombreRepresentante = $_POST['nombreRepresentante'] ?? '';
    $apellidoRepresentante = $_POST['apellidoRepresentante'] ?? '';
    $dniRepresentante = $_POST['dniRepresentante'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $localidad = $_POST['localidad'] ?? '';
    $codigoPostal = $_POST['codigoPostal'] ?? '';
    $direccionAlternativa = $_POST['direccionAlternativa'] ?? '';
    $localidadAlternativa = $_POST['localidadAlternativa'] ?? '';
    $codigoPostalAlternativo = $_POST['codigoPostalAlternativo'] ?? '';
    $nis = $_POST['nis'] ?? '';
    $numeroDeCliente = $_POST['numeroDeCliente'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $errorFacturacion = $_POST['errorFacturacion'] ?? '';
    $resarcimiento = $_POST['resarcimiento'] ?? '';
    $suspencionSuministro = $_POST['suspencionSuministro'] ?? '';
    $malaAtencionComercial = $_POST['malaAtencionComercial'] ?? '';
    $negativaConexion = $_POST['negativaConexion'] ?? '';
    $inconvenienteTension = $_POST['inconvenienteTension'] ?? '';
    $facturaFueraDeTermino = $_POST['facturaFueraDeTermino'] ?? '';
    $uploadedFiles = []; // Array para almacenar los archivos subidos
    $uploadDir = __DIR__ . '/uploads/'; // Ruta absoluta al directorio uploads

    // Verifica y crea la carpeta uploads si no existe
    if (!is_dir($uploadDir)) {
        if (!mkdir($uploadDir, 0777, true)) {
            die('Fallo al crear la carpeta de uploads...');
        }
    }

    // Directorio de destino para guardar los archivos subidos
    if (isset($_FILES['files']) && is_array($_FILES['files'])) {
      $attachmentInfo = $_FILES['files'];
  
      $fileName = $attachmentInfo['name'];
      $fileTmpName = $attachmentInfo['tmp_name'];
      $fileSize = $attachmentInfo['size'];
  
      $destination = $uploadDir . $fileName;
  
      if (move_uploaded_file($fileTmpName, $destination)) {
          echo "Archivo $fileName subido correctamente a $destination<br>";
          $uploadedFiles[] = $destination;
      } else {
          echo "Error al subir el archivo $fileName a $destination<br>";
          echo "Error: " . $attachmentInfo['error'];
          // Agrega un log
          error_log("Error al subir el archivo $fileName a $destination - Error: " . $attachmentInfo['error']);
      }
  } else {
      echo "El formato de archivos adjuntos no es válido o no se detectaron archivos adjuntos<br>";
  }
   
  





    $htmlBody = 
    '<h1><FONT color="#69b545"><u>Datos del USUARIO</u></FONT></h1><br>' .
    '<p><strong><u>Nombre:</u></strong> ' . $nombre . '</p>' .
    '<p><strong><u>Apellido:</u></strong> ' . $apellido . '</p>' .
    '<p><strong><u>DNI:</u></strong> ' . $dni . '</p>' .
 
    '<p><strong><u>Codigo Postal:</u></strong> ' . $codigoPostal . '</p>' .
    '<p><strong><u>Actua en Nombre Propio?:</u></strong> ' . $checkNombrePropio . '</p>' .
    '<p><strong><u>Nombre del Representante:</u></strong> ' . $nombreRepresentante . '</p>' .
    '<p><strong><u>Apellido del Representante:</u></strong> ' . $apellidoRepresentante . '</p>' .
    '<p><strong><u>DNI del Representante:</u></strong> ' . $dniRepresentante . '</p>' .

    '<p><strong><u>Direccion:</u></strong> ' . $direccion . '</p>' .
    '<p><strong><u>Localidad:</u></strong> ' . $localidad . '</p>' .
    '<p><strong><u>Codigo Postal:</u></strong> ' . $codigoPostal . '</p>' .

    '<p><strong><u>Nº NIS:</u></strong> ' . $nis . '</p>' .
    '<p><strong><u>Numero de Cuenta:</u></strong> ' . $numeroDeCliente . '</p>' .
   
   
    '<h3><FONT color="#69b545"><u>Coincide Direccion? Si estos datos estan repetidos ha marcado que si</u></FONT></h3>' .
    '<p><strong><u>Direccion 2:</u></strong> ' . $direccionAlternativa . '</p>' .
    '<p><strong><u>Localidad 2:</u></strong> ' . $localidadAlternativa . '</p>' .
    '<p><strong><u>Codigo Postal 2:</u></strong> ' . $codigoPostalAlternativo . '</p>' .
   

    '<p><strong><u>Telefono:</u></strong> ' . $telefono . '</p>' .
    '<p><strong><u>Correo Electronico:</u></strong> ' . $email . '</p>' .

   
    '<p><strong><u>Descripcion del RECLAMO:</u></strong> ' . $descripcion . '</p>' .
    '<h1><FONT color="#69b545"><u>Tipologia de Reclamo</u></FONT></h1>' .
    '<p><strong><u>Error Facturacion:</u></strong> ' . $errorFacturacion . '</p>' .
    '<p><strong><u>Resarcimiento:</u></strong> ' . $resarcimiento . '</p>' .
    '<p><strong><u>Suspension Suministro:</u></strong> ' . $suspencionSuministro . '</p>' .
    '<p><strong><u>Mala Atencion Comercial:</u></strong> ' . $malaAtencionComercial . '</p>' .
    '<p><strong><u>Negativa Conexion:</u></strong> ' . $negativaConexion . '</p>' .
    '<p><strong><u>Inconveniente Tension:</u></strong> ' . $inconvenienteTension . '</p>' .
    '<p><strong><u>Factura Fuera de Termino/no recibidas:</u></strong> ' . $facturaFueraDeTermino . '</p>';


  

    $mail->setFrom('administrador@eprern.gov.ar', 'admin');
    $mail->addAddress('lavila@eprern.gov.ar');     
    $mail->addAddress('lautiavila96@gmail.com');        
    // $mail->addAddress('pbejarano@eprern.gov.ar');          
   
    $mail->isHTML(true);
    $mail->Subject = 'Nuevo formulario de Reclamos';
    $mail->Body = $htmlBody;

    foreach ($uploadedFiles as $file) {
      if (file_exists($file)) {
        echo "Adjuntando $file al correo<br>";
        $mail->addAttachment($file);
      } else {
        echo "No se encontró el archivo $file para adjuntar al correo<br>";
      }
    }

  






    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

   
    // $mail->addAttachment('/var/tmp/file.tar.gz');
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); 




    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {


    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>