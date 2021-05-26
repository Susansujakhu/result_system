
<form class="row g-3" action="" method="post">
	<div class="col-md-6">
		<label for="studentName" class="form-label">Full Name</label>
		<input type="text" class="form-control" id="studentName" name="studentName" value="" required>
	</div>
	<div class="col-md-6">
		<label for="studentId" class="form-label">Student ID</label>
		<input type="text" class="form-control" id="studentId" name="studentId" value="" required="">
	</div>

	<div class="col-12">
		<label for="studentAddress" class="form-label">Address</label>
		<input type="text" class="form-control" id="studentAddress" placeholder="1234 Main St" name="studentAddress" value="" required="">
	</div>

	<div class="col-md-6">
		<label for="sutdentContact" class="form-label">Contact Number</label>
		<input type="text" class="form-control" id="sutdentContact" name="sutdentContact" value="">
	</div>
	<div class="col-md-2">
		<label for="studentClass" class="form-label">Class</label>
		<input type="text" class="form-control" id="studentClass" name="studentClass" value="" required>
	</div>
	<div class="col-md-4">
		<label for="studentSection" class="form-label">Section</label>
		<input type="text" class="form-control" id="studentSection" name="studentSection" value="">
	</div>
	<div class="col-md-6">
		<label for="studentEmail" class="form-label">Email</label>
		<input type="Email" class="form-control" id="studentEmail" placeholder="abc@gmail.com" name="studentEmail" value="">
	</div>

	<div class="form-group col-md-2">
		<label for="studentStatus">Status:</label>
		<select class="form-control" id="studentStatus" name="studentStatus">
			<option>In</option>
			<option>Out</option>

		</select>
	</div>
	<div class="form-group col-md-4">
		<label for="studentImage" class="form-label">Image</label>
		<input type="file" class="form-control" id="studentImage" name="studentImage">
	</div>

	<div class="col-md-6">
		<label for="studentPassword" class="form-label">Password</label>
		<input type="text" class="form-control" id="studentPassword" name="studentPassword" value="" required>
	</div>
	<div class="col-6">
		<div class="form-check">
			<br>
			<input class="form-check-input" type="checkbox" id="gridCheck" name="checkbox" value="true" onclick="generatePassword()">
			<label class="form-check-label" for="gridCheck">
				Auto Generate Password
			</label>
		</div>
	</div>
	<div class="col-12">
		<button type="submit" class="btn btn-success mt-4" name="add_student">Add Student</button>
	</div>
</form>




<script type="text/javascript">
	

	function generatePassword() {
		var decider = document.getElementById('gridCheck');


		if(decider.checked){

			var id = document.getElementById('studentId').value;

			var studentClass = document.getElementById('studentClass').value;
			var studentSection = document.getElementById('studentSection').value;
			var seperator = "-";
			if (studentSection == "") {
				var password = id+seperator+studentClass;
			}
			else{
				var password = id+seperator+studentClass+seperator+studentSection;
			}
			document.getElementById('studentPassword').value = password;
		} 
		else {
			document.getElementById('studentPassword').value = "";
		}
	}
</script>


<?php 

include 'connect.php';
if (isset($_POST['add_student'])) {
	$studentName = $_POST['studentName'];
	$studentId = $_POST['studentId'];
	$studentAddress = $_POST['studentAddress'];
	$studentEmail = $_POST['studentEmail'];
	$sutdentContact = $_POST['sutdentContact'];
	$studentClass = $_POST['studentClass'];
	$studentSection = $_POST['studentSection'];
	$studentPassword = $_POST['studentPassword'];
	$studentStatus = $_POST['studentStatus'];
	$createdDate = date("Y/m/d");
	$batch = date("Y")-$studentClass;
	// if ($checkbox == 'true') {
	// 	$rand = rand(10,100);
	// 	$studentPassword = $studentId . $rand;
	// 	echo "<script>
	// 	document.getElementbyId('studentPassword').value = ".$studentPassword.";
	// 	</script>";
	// }
	
	include 'check_student_table.php';
	$studentCheck = check_student($studentId, '');
	$teacher_id = $_SESSION['teacher_id'];
	if ($studentCheck == 'false') {
		$insert = $con -> query("INSERT INTO `student_details` VALUES ('sn', '$studentId', '$studentName', '$batch', '$studentClass', '$studentSection' ,'$studentAddress', '$sutdentContact', '$studentEmail', '$studentPassword','$studentStatus', '$teacher_id' ,'$createdDate')");
		//*****************************************************************
		
		//insert student to result table
		

		if ($insert) {
			$check_result_table = $con ->query("SELECT * FROM `class_result`");
			$num = mysqli_num_fields($check_result_table);
			$exam_sql = $con -> query("SELECT * FROM `exam_type`");
			while ($row = $exam_sql->fetch_array(MYSQLI_ASSOC)) {
				$exam_type_value[] = $row['value'];
			//echo $row['value'];
			}

			foreach ($exam_type_value as $value) {
				$sql = "INSERT INTO `class_result` VALUES ('sn', '$studentId', '$batch', '$value'";
				$sql1 = "INSERT INTO `internal_marks` VALUES ('sn', '$studentId', '$value'";
				$sql2 = "INSERT INTO `practical_marks` VALUES ('sn', '$studentId', '$value'";
				for ($k = 0; $k < $num-4; $k++) {
					$sql = $sql." ,NULL";
					$sql1 = $sql1." ,NULL";
					$sql2 = $sql2." ,NULL";
				}
				$sql = $sql. ")";
				$sql1 = $sql1. ")";
				$sql2 = $sql2. ")";
		//echo $sql;
				$query = $con -> query($sql);
				$query1 = $con -> query($sql1);
				$query2 = $con -> query($sql2);
			}
			echo "
			<script>alert('Student Added Successfully');</script>
			";
		}
		else {
			echo $con->error;
			echo "<script>alert('failed to add student');</script>";
		}
	}
	else {
		echo "<script>alert('Cannot create student with same student ID');</script>";
	}
	
}
?>