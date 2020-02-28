<?php
	include 'includes/session.php';
    include 'includes/conn.php';
	if(isset($_POST['add'])){
		$employee = $_POST['employee'];
		$date = $_POST['date'];
		
		$dayspresent  =  $_POST['days'];
		$minuteslate = $_POST['late'];
		$halfdays = $_POST['half'];
		$noOfabsent = $_POST['absent'];
        
      
				
				//$scherow = $squery->fetch_assoc();
				//$logstatus = ($time_in > $scherow['time_in']) ? 0 : 1;
				//
				$query = " INSERT INTO attendance (employee_id, date,num_hr,late,absent,halfday) VALUES ('$employee', '$date',$dayspresent, $minuteslate,$noOfabsent,$halfdays)";
				if($conn->query($query)){
						$_SESSION['success'] = 'Attendance added successfully';
				}else{
						$_SESSION['error'] = 'Fill up add form first';
				}
				
			}header('location: attendance.php');
			/*if($conn->query($sql)){
				
				}else{
			
				}*/
					/*$id = $conn->insert_id;

					$sql = "SELECT * FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id WHERE employees.id = '$emp'";
					$query = $conn->query($sql);
					$srow = $query->fetch_assoc();

					if($srow['time_in'] > $time_in){
						$time_in = $srow['time_in'];
					}

					if($srow['time_out'] < $time_out){
						$time_out = $srow['time_out'];
					}

					$time_in = new DateTime($time_in);
					$time_out = new DateTime($time_out);
					$interval = $time_in->diff($time_out);
					$hrs = $interval->format('%h');
					$mins = $interval->format('%i');
					$mins = $mins/60;
					$int = $hrs + $mins;
					if($int > 4){
						$int = $int - 1;
					}

					$sql = "UPDATE attendance SET num_hr = '$int' WHERE id = '$id'";
					$conn->query($sql);

				}
				else{
					$_SESSION['error'] = $conn->error;
				}*/
			
		
	
	
	
//	

?>