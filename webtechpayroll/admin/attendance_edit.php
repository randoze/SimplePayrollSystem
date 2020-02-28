<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$date = $_POST['eddate'];
		$days = $_POST['edit_days'];
		$late = $_POST['late'];
		$absent = $_POST['absent'];
		$halfdays =$_POST['edit_half'];



		$sql = "UPDATE attendance SET date = '$date', num_hr = $days, late = $late,absent = $absent,halfday = $halfdays WHERE id = $id";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Attendance updated successfully';

			

			
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:attendance.php');

?>