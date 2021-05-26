
<?php  
function check_student($studentId, $studentPassword)
{
	include 'connect.php';
	$checkStudentId = $con -> query("SELECT * FROM `student_details`");
	$student_num = mysqli_num_rows($checkStudentId);
	for ($i = $student_num; $i >= 0; $i--) {

		if ($i>0) {
			$StudentRow = $checkStudentId -> fetch_array(MYSQLI_ASSOC);
			$db_studentId = $StudentRow['student_id'];
			$db_password = $StudentRow['password'];
			global $student_class;
			if ($db_studentId == $studentId) {
          //echo 'Matched';  
        	//echo 'Matched cannot create student with similar id';
				if ($studentPassword == '') {
					$student_class = $StudentRow['class'];
					return "true";
				}
				else {
					$student_class = $StudentRow['class'];
					return "$db_password";
				}
				break;
			}


		}
		elseif($i==0) {
        //echo 'New Id';
			return "false";
		}
	}	
}

?>