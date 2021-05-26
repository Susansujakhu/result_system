<form action="" method="post">
  <div class="row mb-3">
    <label for="studentId" class="col-sm-2 col-form-label">Student Id</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="studentId" name="studentId">
    </div>
  </div>
  <div class="row mb-3">
    <label for="studentPassword" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="studentPassword" name="studentPassword">
    </div>
  </div>
  <button type="submit" class="btn btn-primary" name="studentSignin">Sign in</button>
</form>

<?php 
include 'connect.php';
if (isset($_POST['studentSignin'])) {
  $studentId = $_POST['studentId'];
  $studentPassword = $_POST['studentPassword'];
  include 'check_student_table.php';
  $studentCheck = check_student($studentId,$studentPassword);
  //echo $studentCheck;
  if ($studentCheck != 'false') {
    $db_password = $studentCheck;
    if ($db_password == $studentPassword) {
      echo 'Login Success';
      session_start();
      $_SESSION['studentId']=$studentId;
      $_SESSION['studentClass'] = $student_class;

      header("location:student_dashboard_ui.php");
    }
    else {
      echo 'Username Password not valid';
    }
  }
  else {
    echo 'Invalid Id or Password';
  }

}
?>