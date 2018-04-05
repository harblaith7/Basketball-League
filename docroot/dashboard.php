<?php
session_start();
if(!isset($_SESSION['admin_id'])){
	header('Location: login.php');
}
?>

<a href="php/api.php?route=logout">Log Out</a>