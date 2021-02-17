
<form class="row g-3" action="" method="post">
	<div class="col-md-6">
		<label for="teacherName" class="form-label">Full Name</label>
		<input type="text" class="form-control" id="teacherName" name="teacherName" value="" required>
	</div>
	<div class="col-md-4">
		<label for="teacherId" class="form-label">Teacher ID</label>
		<input type="text" class="form-control" id="teacherId" name="teacherId" value="" required="">
	</div>
	<div class="col-md-2">
		<label for="teacherClass" class="form-label">Class</label>
		<input type="text" class="form-control" id="teacherClass" name="teacherClass" value="" required>
	</div>
	<div class="col-md-6">
		<label for="teacherAddress" class="form-label">Address</label>
		<input type="text" class="form-control" id="teacherAddress" placeholder="1234 Main St" name="teacherAddress" value="" required="">
	</div>

	<div class="col-md-6">
		<label for="teacherContact" class="form-label">Contact Number</label>
		<input type="text" class="form-control" id="teacherContact" name="teacherContact" value="">
	</div>

	<div class="col-md-4">
		<label for="teacherUsername" class="form-label">Username</label>
		<input type="text" class="form-control" id="teacherUsername" name="teacherUsername" value="">
	</div>
	<div class="col-md-4">
		<label for="teacherPassword" class="form-label">Password</label>
		<input type="text" class="form-control" id="teacherPassword" name="teacherPassword" value="" required>
	</div>
	<div class="col-md-4">
		<div class="form-check">

			<input class="form-check-input" type="checkbox" id="gridCheck" name="checkbox" value="true" onclick="generatePassword()">
			<label class="form-check-label" for="gridCheck">
				Auto Generate Password
			</label>
		</div>
	</div>
	<div class="col-md-4">
		<label for="teacherEmail" class="form-label">Email</label>
		<input type="Email" class="form-control" id="teacherEmail" placeholder="abc@gmail.com" name="teacherEmail" value="">
	</div>

	<div class="form-group col-md-2">
		<label for="teacherStatus">Status:</label>
		<select class="form-control" id="teacherStatus" name="teacherStatus">
			<option selected>full</option>
			<option>part</option>
			<option>out</option>

		</select>
	</div>


	<div class="form-group col-md-2">
		<label for="teacherRole">Role:</label>
		<select class="form-control" id="teacherRole" name="teacherRole">
			<option value="Teacher" selected>Teacher</option>
			<option value="classTeacher">Class Teacher</option>
			<option value="part">Part Time</option>

		</select>
	</div>
	<div class="form-group col-md-4">
		<label for="teacherImage" class="form-label">Image</label>
		<input type="file" class="form-control" id="teacherImage" name="teacherImage">
	</div>
	<div class="col-12">
		<button type="submit" class="btn btn-success" name="add_teacher">Add Teacher</button>
	</div>
</form>

<script type="text/javascript">
	

	function generatePassword() {
		var decider = document.getElementById('gridCheck');


		if(decider.checked){

			var id = document.getElementById('teacherId').value;

			var teacherClass = document.getElementById('teacherClass').value;
			var teacherUsername = document.getElementById('teacherUsername').value;
			var seperator = "-";
			if (teacherClass == "") {
				var password = id+seperator+teacherUsername;
			}
			else{
				var password = id+seperator+teacherUsername+seperator+teacherClass;
			}
			document.getElementById('teacherPassword').value = password;
		} 
		else {
			document.getElementById('teacherPassword').value = "";
		}
	}
</script>


<?php 

include 'connect.php';
if (isset($_POST['add_teacher'])) {
	$teacherId = $_POST['teacherId'];
	$teacherName = $_POST['teacherName'];
	$teacherAddress = $_POST['teacherAddress'];
	$teacherEmail = $_POST['teacherEmail'];
	$teacherContact = $_POST['teacherContact'];
	$teacherClass = $_POST['teacherClass'];
	$teacherUsername = $_POST['teacherUsername'];
	$teacherPassword = $_POST['teacherPassword'];
	$teacherStatus = $_POST['teacherStatus'];
	$teacherRole = $_POST['teacherRole'];
	$createdDate = date("Y/m/d");
	// if ($checkbox == 'true') {
	// 	$rand = rand(10,100);
	// 	$studentPassword = $studentId . $rand;
	// 	echo "<script>
	// 	document.getElementbyId('studentPassword').value = ".$studentPassword.";
	// 	</script>";
	// }
	
	include 'check_teacher_table.php';

	$teacher_id = $_SESSION['teacher_id'];
	if ($checkId == 'false') {
		$insert = $con -> query("INSERT INTO `teacher_details` VALUES ('sn', '$teacherId', '$teacherName', '$teacherAddress', '$teacherContact' ,'$teacherEmail', '$teacherUsername', '$teacherPassword', '$teacherClass','$teacherRole', '$teacherStatus' ,'$createdDate')");
		if ($insert) {
			echo "
			<script>alert('Teacher Added Successfully');</script>
			";
		}
		else {
			echo "<script>alert('failed to add Teacher');</script>";
		}
	}
	else {
		echo "<script>alert('Cannot create teacher with same teacher ID');</script>";
	}
	
}
?>