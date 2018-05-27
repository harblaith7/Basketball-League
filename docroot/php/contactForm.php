<?php
$data = json_decode(file_get_contents("php://input"));
if (count($data) == 1) {
	$to = "contact@anklebreaker.ca";
	$name = $data->name;
	$email = $data->email;
	$message = $data->message;
	$body = "<strong>From: </strong>".$name." &lt; <a href='mailto:".$email."'>".$email."</a> &gt; <br/> <strong>Message: </strong>".$message;
	$subject = "Contact form submission";

	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <'.$email.'>' . "\r\n";
  $headers .= 'X-Mailer: PHP/' . phpversion();
	if ($name === null || $message === null) {
		die("Name and message cannot be empty");
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		die("Email must be valid");
	}
	if(mail($to,$subject,$body,$headers)){
		echo "success";
	}
}
?>
