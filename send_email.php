<?php
if(isset($_POST['email-input'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = "logistica@multienvase.com.py";
    $email_subject = "Comentario desde Pagina Web Multienvase";
 
    function died($error) {
        // your error code can go here
        echo "Lo sentimos pero hay un(os) error(es) en el correo que intento enviar. ";
        echo "Los errores son los siguientes.<br /><br />";
        echo $error."<br /><br />";
        echo "Por favor vuelva atras y corrija los mismos.<br /><br />";
        die();
    }
 
    // validation expected data exists
    if(!isset($_POST['nombre-input']) ||
        !isset($_POST['email-input']) ||
        !isset($_POST['opinion-input'])) {
        died('Lo sentimos, pero hay un error con los datos que intenta enviar.');       
    }
 
     
    $nombre = $_POST['nombre-input']; // required
    $email = $_POST['email-input']; // required
    $comentario = $_POST['opinion-input']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
	if(!preg_match($email_exp,$email)) {
		$error_message .= 'La direccion de correo que especifico no es valida.<br />';
	}
 
	if(strlen($comentario) < 2) {
		$error_message .= 'El comentario que realizo no es valido.<br />';
	}
 
	if(strlen($error_message) > 0) {
		died($error_message);
	}
 
    $email_message = "Este correo fue escrito por un usuario de la pagina web.\n\n";
  
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
  
    $email_message .= "Nombre: ".clean_string($nombre)."\n";
    $email_message .= "Email: ".clean_string($email)."\n";
    $email_message .= "Comentario: ".clean_string($comentario)."\n";
 
	// create email headers
	$headers = 'From: '.$email."\r\n".'Reply-To: '.$email."\r\n" .'X-Mailer: PHP/' . phpversion();
	@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<html>
	<head>
		<title>A web page that points a browser to a different page after 2 seconds</title>
		<meta http-equiv="refresh" content="2; URL=http://multienvase.com.py/contacts.html">
		<meta name="keywords" content="automatic redirection">
	</head>
	<body>
		Si tu navegador no te redirige automaticamente en unos segundos haz click <a href="http://multienvase.com.py/contacts.html">aqui</a>.
	</body>
</html>
 
<?php
 
}
?>