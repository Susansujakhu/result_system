

<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

	<title>Edit Personal info</title>
</head>
<body>
	<?php include 'navbar.php'; 
	include 'connect.php';
	session_start();
	$id = $_SESSION['teacher_id'];
	$sql = $con -> query("SELECT * FROM `teacher_details` WHERE `teacher_id` = $id");
	if ($sql) {
	//echo "<script>alert('success')</script>";
		while ($row = $sql -> fetch_assoc()) {
			$sn = $row['sn'];
			$teacher_id = $row['teacher_id'];
			$teacher_name = $row['teacher_name'];
			$address = $row['address'];
			$contact = $row['contact'];
			$email = $row['email'];
			$username = $row['username'];
			$password = $row['password'];
			$role = $row['role'];
			$class = $row['class'];
			$status = $row['status'];
			//echo "<input type='text' name='' value=\"{$row['teacher_name']}\">";
		}
		

	}
	else {
		echo "<script>alert('failed')</script>";
	}
	?>

	<form class="row g-3" action="" method="post">
		<div class="col-md-6">
			<label for="teacherName" class="form-label">Full Name</label>
			<input type="text" class="form-control" id="teacherName" name="teacherName" value="<?php echo($teacher_name); ?>" required>
		</div>

		<div class="col-md-6">
			<label for="teacherAddress" class="form-label">Address</label>
			<input type="text" class="form-control" id="teacherAddress" placeholder="1234 Main St" name="teacherAddress" value="<?php echo($address); ?>" required="">
		</div>

		<div class="col-md-6">
			<label for="teacherContact" class="form-label">Contact Number</label>
			<input type="text" class="form-control" id="teacherContact" name="teacherContact" value="<?php echo($contact); ?>">
		</div>

		<div class="col-md-6">
			<label for="teacherEmail" class="form-label">Email</label>
			<input type="Email" class="form-control" id="teacherEmail" placeholder="abc@gmail.com" name="teacherEmail" value="<?php echo($email); ?>">
		</div>

		<div class="col-md-6">
			<label for="teacherUsername" class="form-label">Username</label>
			<input type="text" class="form-control" id="teacherUsername" name="teacherUsername" value="<?php echo($username); ?>" required>
		</div>
		<div class="col-md-6">
			<label for="teacherPassword" class="form-label">Password</label>
			<input type="text" class="form-control" id="teacherPassword" name="teacherPassword" value="<?php echo($password); ?>" required>
		</div>



		<div class="col-12">
			<button type="submit" class="btn btn-success" name="edit_info">Save Details</button>
		</div>
	</form>



	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: Bootstrap Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

	<!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
-->
</body>
</html>

<?php 

include 'connect.php';
if (isset($_POST['edit_info'])) {
	$teacherName = $_POST['teacherName'];
	$teacherAddress = $_POST['teacherAddress'];
	$teacherEmail = $_POST['teacherEmail'];
	$teacherContact = $_POST['teacherContact'];
	$teacherUsername = $_POST['teacherUsername'];
	$teacherPassword = $_POST['teacherPassword'];

	// if ($checkbox == 'true') {
	// 	$rand = rand(10,100);
	// 	$studentPassword = $studentId . $rand;
	// 	echo "<script>
	// 	document.getElementbyId('studentPassword').value = ".$studentPassword.";
	// 	</script>";
	// }
	

	$teacher_id = $_SESSION['teacher_id'];

	$update = $con -> query("UPDATE `teacher_details` SET `teacher_name` = '$teacherName', `address` = '$teacherAddress', `contact` = '$teacherContact', `email` = '$teacherEmail', `username` = '$teacherUsername', `password` = '$teacherPassword' WHERE `teacher_details`.`teacher_id` = '$teacher_id'");
	if ($update) {
		echo "
		<script>alert('Data Changed Successfully');</script>
		";
	}
	else {
		echo "<script>alert('Failed to Save Data');</script>";
	}

	
}
?>