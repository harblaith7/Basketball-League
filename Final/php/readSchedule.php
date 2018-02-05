<?php 
include "connect.php";
$data = json_decode(file_get_contents("php://input"));
if(count($data) > 0){
	$sql = "SELECT * FROM schedule";
	$result = mysqli_query($connect, $sql);
	$count = mysqli_num_rows($result);
	if($count > 0){
		$output = [];
		while($row = mysqli_fetch_array($result)){
			$output[] = $row;
		}
		echo json_encode($output);
	}
}
?>