<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT attendance.date as attdate,firstname,lastname,late,absent,halfday,num_hr,attendance.id as attid FROM attendance LEFT JOIN employees ON employees.employee_id=attendance.employee_id where attendance.id= '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>