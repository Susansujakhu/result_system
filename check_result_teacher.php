
	<?php 
	include 'valuesForResult.php';
	?>
	<form class="row g-3" action="" method="post">
		<div class="col-md-3">
			<label for="year">Year:</label>
			<select class="form-control" id="year" name="year" required>
				<?php 
					foreach ($years as $year_value) {
						echo "<option>".$year_value."</option>";
					}
				 ?>
				
				
			</select>
		</div>
		<div class="col-md-3">
			<label for="batch">Batch:</label>
			<select class="form-control" id="batch" name="batch" required>
				<?php 
				foreach ($fetched_batch as $batch_value) {
					echo "<option>".$batch_value."</option>";
				}
				 ?>
				
				
			</select>
		</div>

		<div class="col-md-3">
			<label for="batch">Exam:</label>
			<select class="form-control" id="exam" name="exam">
				<option value="0" selected>Select Exam Type</option>
				<?php 
				for ($i = 0; $i < $exam_count; $i++) {
					echo "<option value=".$examType_value[$i]." >".$examType[$i]."</option>";
				}
				 ?>
				
				
			</select>
		</div>
		<div class="col-md-3">
			<label for="studentId">Student ID:</label>
			<select class="form-control" id="studentId" name="studentId">
				<option value="0" selected>Select ID</option>
				<?php 
				foreach ($fetched_id as $id_value) {
					echo "<option >".$id_value."</option>";	
				}
				 ?>
				
				
			</select>
		</div>
		<button class="btn btn-success rounded-1" name="check_result">Show</button>
	</form>


<?php 
include 'connect.php';
if (isset($_POST['check_result'])) {
	$year = $_POST['year'];
	$batch = $_POST['batch'];
	$exam_type = $_POST['exam'];
	$studentId = $_POST['studentId'];
	$class = date('Y')-$batch;

	$_SESSION['studentClass'] = $class;
	$sql1 = "SELECT * FROM `class_result` WHERE `year` = '$year' AND `batch` = '$batch' ";

	if ($exam_type!=0 AND $studentId==0) {
		$var = " `type` = '".$exam_type."'";
		$sql1 = $sql1." AND ".$var;

	}
	elseif ($exam_type==0 AND $studentId!=0) {
		$var = " `student_id` = '".$studentId."'";
		$sql1 = $sql1." AND ".$var;
	}
	elseif($exam_type!=0 AND $studentId!=0) {
		$var1 = " `type` = '".$exam_type."'";
		$var2 = " `student_id` = '".$studentId."'";
		$sql1 = $sql1." AND ".$var1." AND ".$var2;
	}
	else {
		$sql1 = $sql1;
	}
	$sql1 = $sql1." ORDER BY `type`";

	$result = $con -> query($sql1);
	if ($result) {
		//echo 'success';
		$row_num = mysqli_num_rows($result);
		//echo $row_num;
		$count = 0;
		$head1 = $head2 = $head3 = 0;

		for ($j = 0; $j < $row_num; $j++) {
			include 'teacherResult.php';

		}

	}
	else {
		echo 'failed';
	}
}
?>