<?php

  $hacia = 'alguien@cygnusmedia.cl';
  $subject = "Mensaje de : ".$_POST['nombre'];
  $mensaje = "Nombre: ".$_POST["nombre"]."<br>"."<br>"; 
  $mensaje .= "Empresa: ".$_POST["mail"]."<br>"."<br>"; 
  $mensaje .= "IP :".$_SERVER['REMOTE_ADDR']."<br>"."<br>";
  $mensaje .= "Mensaje: <br>".$_POST["mensaje"]."<br><br>";
  $fromaddress = $_POST['mail'];
  $ip = $_SERVER['REMOTE_ADDR'];
  $sIP = md5($subject.date('dmY'));
  
  // HEDERS \\
 
  
  $headers = 'From: '.$fromaddress.PHP_EOL; // de ...
  $headers.= 'Reply-To: '.$fromaddress.PHP_EOL;  // responder a...
  $headers.= 'Return-Receipt-To: '.$fromaddress.PHP_EOL;  // responder a...
  $headers.= 'Return-Path: '.$fromaddress.PHP_EOL;  // responder a...
  $headers.= 'Message-ID: <'.time().' no-reply@'.$_SERVER['SERVER_NAME'].'>'.PHP_EOL; // anti-spam
  $headers.= 'X-Mailer: MyMailer v0.001'.PHP_EOL;  // info
  $headers.= 'Content-Type: multipart/alternative; boundary="'.$sIP.'"'.PHP_EOL.PHP_EOL;  // anti-spam
  // En caso de que no podamos leer html \\
  $msg  = '--'.$sIP.PHP_EOL;
  $msg .= 'Content-Type: text/plain; charset=iso-8859-1'.PHP_EOL;
  $msg .= 'Content-Transfer-Encoding: 7bit'.PHP_EOL.PHP_EOL;
  $msg .= 'Este e-mail requiere que active HTML.'.PHP_EOL;
  $msg .= 'Si usted esta leyendo esto, por favor actualice su cliente de correo.'.PHP_EOL;
  $msg .= 'Acentos y tildes omitidos con intencion.'.PHP_EOL;
  $msg .= '------- Mensaje cortado -------'.PHP_EOL.PHP_EOL;

  // Lo "normal", que podamos leer html \\
  $msg .= '--'.$sIP.PHP_EOL;
  $msg .= 'Content-Type: text/html; charset=UTF-8'.PHP_EOL;
  $msg .= 'Content-Transfer-Encoding: 7bit'.PHP_EOL.PHP_EOL;

  $msg .= $mensaje.PHP_EOL.PHP_EOL;

  ini_set('sendmail_from',$fromaddress); // anti-spam
  if (mail($hacia, $subject, wordwrap($msg,70,PHP_EOL), $headers)) {
    ini_restore('sendmail_from');
    header("Location: http://cygnusmedia.cl/prueba_1/index.html");
die();

    return TRUE;
  }
  else {
    ini_restore('sendmail_from');
    echo "Something went grong D:, if the problem persist contact me at federico@cygnusmedia.cl";
    return FALSE;
  }



	?>
