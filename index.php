<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="index.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Login</title>
</head>
<body>

    <div class="col-md-6 mx-auto p-0">
        <div class="card">
            <div class="login-box d-flex align-items-center">
                <div class="login-snip"> <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Student Login</label> <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab">Teacher Login</label>
                    <div class="login-space">
                        <form action="" method="post">
                            <div class="login">
                                <div class="group"> <label for="studentId" class="label">Student ID</label> <input id="studentId" type="text" class="input" name="studentId" placeholder="Enter your ID"> </div>
                                <div class="group"> <label for="pass" class="label">Password</label> <input id="studentPassword" type="password" class="input" data-type="password" placeholder="Enter your password" name="studentPassword"> </div>

                                <div class="group"> <input type="submit" class="button" name="studentSignin" value="Sign In"> </div>

                            </div>

                            <div class="sign-up-form">
                                <div class="group"> <label for="teacherUsername" class="label">Username</label> <input id="teacherUsername" type="text" class="input" name="teacherUsername" placeholder="Enter your Username"> </div>
                                <div class="group"> <label for="teacherPassword" class="label">Password</label> <input id="teacherPassword" type="password" name="teacherPassword" class="input" data-type="password" placeholder="Password"> </div>

                                <div class="group"> <input type="submit" class="button" name="teacherSignin" value="Sign In"> </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

      header("location:result.php");
  }
  else {
      echo 'Username Password not valid';
  }
}
else {
    echo 'Invalid Id or Password';
}

}

else if (isset($_POST['teacherSignin'])) {
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

              header("location:main_dashboard.php");
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