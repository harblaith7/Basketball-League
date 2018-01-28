<?php 
include "Mail.php";
$data = json_decode(file_get_contents("php://input"));
if (count($data) == 1) {
	$name = $data->name;
	$email = $data->email;
	$message = $data->message;
	if ($name === null || $message === null) {
		die("Name and message cannot be empty");
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		die("Email must be valid");
	}
	$reply = $email;
    $subject = "Contact form submission";
	$from = "Anklebreaker <contact@anklebreaker.ca>";
    $to = "< contact@anklebreaker.ca >";
    $mailer = 'PHP/' . phpversion();
      
	$host = "ssl://anklebreaker.ca";
	$port = "465";
	$username = "contact@anklebreaker.ca";
	$password = "kBeD3s;Z&gVU";
	$headers = array (
		'From' => $from,
		'Reply-To' => $reply,
		'MIME-Version' => "1.0",
		'To' => $to,
		'Subject' => $subject,
		'Content-type' => 'text/html; charset=iso-8859-1',
	);
	$smtp = Mail::factory('smtp',
						  array ('host' => $host,
								 'port' => $port,
								 'auth' => true,
								 'username' => $username,
								 'password' => $password)
						 );
	$mail = $smtp->send($email, $headers, $message);
	if (PEAR::isError($mail)) {
		echo("<p>" . $mail->getMessage() . "</p>");
	} else {
		echo"success";
	}
}
?>