
<?php  
$checkTeacher = $con -> query("SELECT * FROM `teacher_details`");
	$teacher_num = mysqli_num_rows($checkTeacher);
	if ($checkTeacher) {
		for ($i = $teacher_num; $i >= 0; $i--) {

			if ($i>0) {
				$teacherRow = $checkTeacher -> fetch_array(MYSQLI_ASSOC);
				$db_teacherId = $teacherRow['teacher_id'];
				//$db_password = $StudentRow['password'];
				if ($db_teacherId == $teacherId) {
          //echo 'Matched';  
        	//echo 'Matched cannot create student with similar id';
					//if ($studentPassword == '') {
						$checkId = "true";
					//}
					//else {
					//	return "$db_password";
					//}
					break;
				}


			}
			elseif($i==0) {
        //echo 'New Id';
				$checkId = "false";
			}
		}	
	}
	else {
		echo "<alert>Failed to fetch teacher data</alert>";
	}

?>
