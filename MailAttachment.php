<?php
if($_FILES["file"]["name"]!='') {
move_uploaded_file($_FILES["file"]["tmp_name"],"mails/" . $_FILES["file"]["name"]);
}

$fileatt = "mails/" . $_FILES["file"]["name"]; // Path to the file
$fileatt_type = $_FILES["file"]["type"]; // File Type
$fileatt_name = $_FILES["file"]["name"]; // Filename that will be used for the file as the attachment

$email_from = "test@crb.com"; // Who the email is from
$email_subject = "Testing PDF Mail Attachment"; // The Subject of the email
$email_message = "Greetings from CRB Innovative Solutions!<br /><br />";

$email_to = "testcrb@gmail.com"; // Who the email is to

$headers = "From: CRB <$email_from>";

$file = fopen($fileatt,'rb');
$data = fread($file,filesize($fileatt));
fclose($file);

$semi_rand = md5(time());
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

$headers .= "\nMIME-Version: 1.0\n" .
"Content-Type: multipart/mixed;\n" .
" boundary=\"{$mime_boundary}\"";

$email_message .= "This is a multi-part message in MIME format.\n\n" .
"--{$mime_boundary}\n" .
"Content-Type:text/html; charset=\"iso-8859-1\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" .
$email_message .= "\n\n";

$data = chunk_split(base64_encode($data));

$email_message .= "--{$mime_boundary}\n" .
"Content-Type: {$fileatt_type};\n" .
" name=\"{$fileatt_name}\"\n" .
//"Content-Disposition: attachment;\n" .
//" filename=\"{$fileatt_name}\"\n" .
"Content-Transfer-Encoding: base64\n\n" .
$data .= "\n\n" .
"--{$mime_boundary}--\n";

mail($email_to, $email_subject, $email_message, $headers);

unlink("mails/" . $_FILES["file"]["name"]);
?>