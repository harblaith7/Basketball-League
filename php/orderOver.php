<?php
session_start();
include "functions.php";

if(isset($_GET['cancel'])){
  if(adminDeleteUnpaid($_SESSION['record_id']) === "success"){
    isset($_SESSION['record_id']){
      unset($_SESSION['record_id']);
      header('Location: ../index.php');	
    }
  }
} else {
  processUnpaid($_SESSION['record_id']);
}
