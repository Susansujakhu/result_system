<?php 
include 'valuesForResult.php';

//session_start();
$teacher_id = $_SESSION['teacher_id'];
$sql_subject = "SELECT * FROM `subject_details` WHERE `teacher_id`=$teacher_id";
$subject_result = $con -> query($sql_subject);
if ($subject_result) {
	//echo 'success';
	$subject_count = mysqli_num_rows($subject_result);
	while ($subject_row = $subject_result->fetch_array(MYSQLI_ASSOC)) {
		//$sub_code[] = $subject_row['subject_code'];
		//$sub_name[] = $subject_row['subject_name'];
		$sub_class[] = $subject_row['class'];
		$batch[] = date("Y")-$subject_row['class'];
	}

}
else {
	echo 'failed';
}
?>

<form class="row g-3" action="" method="post">

	<div class="col-md-3">
		<label for="batch">Batch:</label>
		<select class="form-control" id="batch" name="batch" required>
			<?php 
			foreach ($batch as $batch_value) {
				echo "<option>".$batch_value."</option>";
			}
			?>
		</select>
	</div>

	<div class="col-md-3">
		<label for="batch">Exam:</label>
	s	<select class="form-control" id="exam" name="exam">
			
			<?php 
			for ($i = 0; $i < $exam_count; $i++) {
				echo "<option value=".$examType_value[$i]." >".$examType[$i]."</option>";
			}
			?>


		</select>
	</div>

	<button class="btn btn-success" name="publish_result">Check Details</button>
</form>




<?php 

if (isset($_POST['publish_result'])) {
	//$year = $_POST['year'];
	$batch = $_POST['batch'];

	$exam_type = $_POST['exam'];
	//$studentId = $_POST['studentId'];
	$class = date('Y')-$batch;

	$selected_subject = $con -> query("SELECT `subject_code`,`subject_name` FROM `subject_details` WHERE `class` = $class AND `teacher_id`=$teacher_id");
	while ($row = $selected_subject -> fetch_array(MYSQLI_ASSOC)) {
		$subject_code = $row['subject_code'];
		$subject_name = $row['subject_name'];

	}

//******************************Obtained marks
	$marks_sql = $con -> query("SELECT * FROM `class_result` WHERE `batch` = $batch AND `type` = $exam_type");
	if ($marks_sql) {
		//echo $subject_code;
		while ($rows = $marks_sql -> fetch_array(MYSQLI_ASSOC)) {
			//echo $rows[$subject_code];
			$sn[] = $rows['sn'];
			$studentId[] = $rows['student_id'];
			//********internal marks
			$idd = $rows['student_id'];
			$internal_marks_sql = $con -> query("SELECT * FROM `internal_marks` WHERE `student_id` = $idd AND `type` = $exam_type");
			$internal_rows = $internal_marks_sql ->fetch_array(MYSQLI_ASSOC);
			$internal[] = $internal_rows[$subject_code];
			//**********Practical Marks
			$practical_marks_sql = $con -> query("SELECT * FROM `practical_marks` WHERE `student_id` = $idd AND `type` = $exam_type");
			$practical_rows = $practical_marks_sql ->fetch_array(MYSQLI_ASSOC);
			$practical[] = $practical_rows[$subject_code];
			//***************
			if ($rows[$subject_code] == NULL) {
				$marks[] = NULL;

			}
			else {
				$marks[] = $rows[$subject_code];	
				
			}
		}	
		$student_count = count($studentId);
		//echo $student_count;
	}
	else {
		echo 'Failed';
	}
//*****************************Internal Marks

	if ($marks_sql) {
		//echo $subject_code;
		while ($rows = $marks_sql -> fetch_array(MYSQLI_ASSOC)) {
			//echo $rows[$subject_code];
			$sn[] = $rows['sn'];
			$studentId[] = $rows['student_id'];
			if ($rows[$subject_code] == NULL) {
				$marks[] = NULL;

			}
			else {
				$marks[] = $rows[$subject_code];	
				
			}
		}	
		$student_count = count($studentId);
		//echo $student_count;
	}
	else {
		echo 'Failed';
	}


	echo "<form action='' method='post'>";
	echo "<table>
	<tr>
	<th>SN</th>
	<th>Student ID</th>
	<th>Student Name</th>
	
	<th>".$subject_name."</th>
	<th>Internal</th>
	<th>Practical</th>
	</tr>";
	$count = 0;
	for ($a = 0; $a < $student_count; $a++) {
		$student_sql = $con -> query("SELECT `sn`, `student_id`, `student_name` FROM `student_details` WHERE `student_id` = $studentId[$a]");
		
		echo "<input type='hidden' name='code' value=".$subject_code.">";
		while ($row = $student_sql -> fetch_array(MYSQLI_ASSOC)) {
			$count++;

			echo "<input type='hidden' name='sn[]' value=".$sn[$a].">";
			echo "
			<tr>
			<td>".$count."</td>
			<td><input type='text' name='id[]' value=".$row['student_id']." disabled></td>
			<td><input type='text' name='student_name[]' value=\"{$row['student_name']}\" disabled></td>
			";
			
			echo "<td><input type='text' name='marks[]' value=".$marks[$a]."></td>";
			echo "<td><input type='text' name='internal[]' value=".$internal[$a]."></td>";
			echo "<td><input type='text' name='practical[]' value=".$practical[$a]."></td>";
		}	
	}

	echo "<button class='btn btn-success mt-4 mb-4' name='save'>Save</button>";
	echo '</table></form>';
	


}

if (isset($_POST['save'])) {
	$year = date("Y");
	$subject_code = $_POST['code'];
	
	$count=count($_POST["sn"]);


	for($i=0;$i<$count;$i++){
		echo $_POST['sn'][$i];
		$sql_result = $con -> query("UPDATE `class_result` SET `year` = '".$year."',`$subject_code` = '".$_POST['marks'][$i]."' WHERE `class_result`.`sn` = '".$_POST['sn'][$i]."'");
		
		$sql_internal = $con ->query("UPDATE `internal_marks` SET `year` = '".$year."',`$subject_code` = '".$_POST['internal'][$i]."' WHERE `internal_marks`.`sn` = '".$_POST['sn'][$i]."'");

		$sql_practical = $con ->query("UPDATE `practical_marks` SET `year` = '".$year."',`$subject_code` = '".$_POST['practical'][$i]."' WHERE `practical_marks`.`sn` = '".$_POST['sn'][$i]."'");
		
		if ($sql_result) {
			echo "success";
		}
		else {
			echo 'faill';
		}
	}
	
}
?>