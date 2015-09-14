<?php

  $hacia = 'cristobal@cygnusmedia.cl , federico@cygnusmedia.cl , francisco@cygnusmedia.cl , victor@cygnusmedia.cl';
  $subject=$_POST['nombre'];
  $mensaje = "Nombre: ".$_POST["nombre"]."<br>"."<br>"; 
  $mensaje .= "Empresa: ".$_POST["mail"]."<br>"."<br>"; 
  $mensaje .= "IP :".$_SERVER['REMOTE_ADDR'];
  $mensaje .= "Mensaje: ".$_POST["mensaje"]."<br>";
  $fromaddress = 'cygnusme@cygnusmedia.cl';
  $ip = $_SERVER['REMOTE_ADDR'];
  $sIP = '' 
  $eol = PHP_EOL;

  if ($sIP == '') $sIP = md5($subject.date('dmY'));
  if ($fromaddress == '') $fromaddress = '"Página Web" <cygnusme@'.$_SERVER['SERVER_NAME'].'>';

  $headers = 'From: '.$fromaddress.$eol; // de ...
  $headers.= 'Reply-To: '.$fromaddress.$eol; // responder a...
  $headers.= 'Return-Receipt-To: '.$fromaddress.$eol; // responder a...
  $headers.= 'Return-Path: '.$fromaddress.$eol; // responder a...
  $headers.= 'Message-ID: <'.time().' no-reply@'.$_SERVER['SERVER_NAME'].'>'.$eol; // anti-spam
  $headers.= 'X-Mailer: MyMailer v0.001'.$eol;  // info
  $headers.= 'Content-Type: multipart/alternative; boundary="'.$sIP.'"'.$eol.$eol;  // anti-spam
  // En caso de que no podamos leer html \\
  $msg  = '--'.$sIP.$eol;
  $msg .= 'Content-Type: text/plain; charset=iso-8859-1'.$eol;
  $msg .= 'Content-Transfer-Encoding: 7bit'.$eol.$eol;
  $msg .= 'Este e-mail requiere que active HTML.'.$eol;
  $msg .= 'Si usted esta leyendo esto, por favor actualice su cliente de correo.'.$eol;
  $msg .= 'Acentos y tildes omitidos con intencion.'.$eol;
  $msg .= '------- Mensaje cortado -------'.$eol.$eol;

  // Lo "normal", que podamos leer html \\
  $msg .= '--'.$sIP.$eol;
  $msg .= 'Content-Type: text/html; charset=iso-8859-1'.$eol;
  $msg .= 'Content-Transfer-Encoding: 7bit'.$eol.$eol;

  $msg .= $mensaje.$eol.$eol;

  ini_set('sendmail_from',$fromaddress); // anti-spam
  if (mail($hacia, $subject, wordwrap($msg,70,$eol), $headers)) {
    ini_restore('sendmail_from');
    return TRUE;
  }
  else {
    ini_restore('sendmail_from');
    return FALSE;
  }
}

header("Location: http://cygnusmedia.cl/prueba_1/index.html");
die();

?>
