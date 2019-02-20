<?php
$name = $_POST['name'];
$email = $_POST['email'];
$msg = $_POST['msg'];

$to      = 'bartlomiej.walasik@miggroup.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: bartekwalasik@gmail.com' . "\r\n" .
    'Reply-To: bartekwalasik@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

?>