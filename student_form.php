
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
		<button type="submit" class="btn btn-success" name="add_student">Add Student</button>
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