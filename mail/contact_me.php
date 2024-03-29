<?php
// Check for empty fields
if(empty($_POST['name'])
  || empty($_POST['email'])
  || empty($_POST['phone'])
  || empty($_POST['message'])
  || !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
  echo "No arguments Provided!";
  return FALSE;
}

$name = $_POST['name'];
$email_address = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$honeypot = $_POST['adress'];
	
// Create the email and send the message
$to = 'mendez.sylvain@wanadoo.fr';
$email_subject = "AVSTB:  $name";
$email_body = "Nom: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
$headers = "From: noreply@avs-taxi-brignoles.fr\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";

if (!empty($honeypot)) {
    header('HTTP/1.1 500 Internal Server error');
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(['message' => 'ERROR', 'code' => 1337]));
}
else {
    mail($to,$email_subject,$email_body,$headers);
}

return TRUE;
?>
