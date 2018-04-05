<?php
session_start();
if(!isset($_SESSION['admin_id'])){
	header('Location: login.php');
}
?>

<a href="php/logout.php">Log Out</a>