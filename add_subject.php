
	<form class="row g-3" action="" method="post">
		<div class="col-md-4">
			<label for="subjectCode" class="form-label">Subject Code</label>
			<input type="text" class="form-control" id="subjectCode" name="subjectCode" value="" required>
		</div>
		<div class="col-md-4">
			<label for="subjectName" class="form-label">Subject Name</label>
			<input type="text" class="form-control" id="subjectName" name="subjectName" value="" required="">
		</div>

		<div class="col-4">
			<label for="subjectClass" class="form-label">Class</label>
			<input type="text" class="form-control" id="subjectClass" name="subjectClass" value="" required="">
		</div>

		<div class="col-md-3">
			<label for="full_marks" class="form-label">Full Marks</label>
			<input type="number" class="form-control" id="full_marks" name="full_marks" value="" required>
		</div>
		<div class="col-md-3">
			<label for="pass_marks" class="form-label">Pass Marks</label>
			<input type="number" class="form-control" id="pass_marks" name="pass_marks" value="" required>
		</div>
		<div class="col-md-3">
			<label for="internal" class="form-label">Internal</label>
			<input type="number" class="form-control" id="internal" name="internal" value="">
		</div>
		<div class="col-md-3">
			<label for="practical" class="form-label">Practical</label>
			<input type="number" class="form-control" id="practical" name="practical" value="">
		</div>

		<div class="col-12">
			<button type="submit" class="btn btn-success mt-4" name="add_subject">Add Subject</button>
		</div>
	</form>








<?php 
$teacher_id = $_SESSION['teacher_id'];
include 'connect.php';
if (isset($_POST['add_subject'])) {
	$subjectCode = $_POST['subjectCode'];
	$subjectName = $_POST['subjectName'];
	$subjectClass = $_POST['subjectClass'];
	$full_marks = $_POST['full_marks'];
	$pass_marks = $_POST['pass_marks'];
	$internal = $_POST['internal'];
	$practical = $_POST['practical'];

	$subject_insert = $con -> query("INSERT INTO `subject_details` (`sn`, `subject_code`, `subject_name`, `class`, `pass_marks`, `full_marks`, `internal_marks`, `practical_marks`, `teacher_id`) VALUES (NULL, '$subjectCode', '$subjectName', '$subjectClass', '$full_marks', '$pass_marks', '$internal', '$practical', '$teacher_id');");
	
	if ($subject_insert) {
		$add_to_result = $con-> query("ALTER TABLE `class_result` ADD `$subjectCode` VARCHAR(50) NULL");
		
		$add_to_internal = $con-> query("ALTER TABLE `internal_marks` ADD `$subjectCode` VARCHAR(50) NULL");
		$add_to_practical = $con-> query("ALTER TABLE `practical_marks` ADD `$subjectCode` VARCHAR(50) NULL");
		echo "<script>alert('Subject Added Successfully')</script>";
	}
	else {
		$error = mysqli_error($con);
		//echo $error;
		echo "<script>alert('Subject Added Failed... Dubplicate Subject Code')</script>";
	}
}
?>