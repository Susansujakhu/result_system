<form action="" method="post">
  <div class="row mb-3">
    <label for="teacherUsername" class="col-sm-2 col-form-label">Username</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="teacherUsername" name="teacherUsername">
    </div>
  </div>
  <div class="row mb-3">
    <label for="teacherPassword" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="teacherPassword" name="teacherPassword">
    </div>
  </div>
  <button type="submit" class="btn btn-primary" name="teacherSignin">Sign in</button>
</form>

<?php 
include 'connect.php';
if (isset($_POST['teacherSignin'])) {
  $teacherUsername = $_POST['teacherUsername'];
  $teacherPassword = $_POST['teacherPassword'];
  


  $teacherLogin = $con -> query("SELECT * FROM `teacher_details`");
  if ($teacherLogin) {
    $teacher_num = mysqli_num_rows($teacherLogin);

    
    for ($i = $teacher_num; $i >= 0; $i--) {

      if ($i>0) {
        $teacherRow = $teacherLogin -> fetch_array(MYSQLI_ASSOC);
        $teacherStatus = $teacherRow['status'];

        $db_teacherUsername = $teacherRow['username'];
        
        if ($db_teacherUsername == $teacherUsername) {
          //echo 'Matched';  
          $db_password = $teacherRow['password'];
          if ($db_password == $teacherPassword) {
            
            if ($teacherStatus == 'out') {
              echo "<script>alert('You cannot Login as you are not teaching in this school')</script>";
              break;
            }
            else {
              echo 'Login Success';
              session_start();
              $_SESSION['teacher_id']=$teacherRow['teacher_id'];
              $_SESSION['username']=$teacherUsername;
              $_SESSION['role']=$teacherRow['role'];
      
              header("location:add_subject.php");
              break;
            }
            
          }
          else {

            echo 'Username Password not valid';

            break;
          }  
        }
        
        

        
      }
      elseif($i==0) {
        echo 'Invalid Id';
      }
    }
  }
  else {
    echo "Failed to fetch student details";
  }
}
?>