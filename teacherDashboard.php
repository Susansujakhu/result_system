<?php 
session_start();
if ($_SESSION['teacher_id'] != '') {
  $teacher_id = $_SESSION['teacher_id'];
}
else {
    //echo 'notttt';
  header("location:./");
}
?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500&display=swap" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Source+Serif+Pro:400,600&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <!-- Style -->
  <link rel="stylesheet" href="css/style.css">

  <title>Dashboard</title>
</head>
<body onload="teacher_role();">

  <?php include 'navbar.php'?>

  <div class="site-section">
    <div class="container">


      <?php 
      include 'logout.php';

      $teacherRole = $_SESSION['role'];
      
      ?>
      <script type="text/javascript">
        function teacher_role() {
          var role = '<?php echo $teacherRole; ?>';
          if ( role == 'classTeacher') {
            
            document.getElementById('add-teacher-tab').classList.add('disabled');
            document.getElementById('edit-teacher-tab').classList.add('disabled');
          }
          else if( role == 'Teacher'){
            console.log('teacher');
            document.getElementById('add-teacher-tab').classList.add('disabled');
            document.getElementById('add-student-tab').classList.add('disabled');
            document.getElementById('edit-student-tab').classList.add('disabled');
            document.getElementById('edit-teacher-tab').classList.add('disabled');
          }}
        </script>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
         <li class="nav-item" role="presentation">
          <a class="nav-link enabled active" id="crete-subject-tab" data-bs-toggle="pill" href="#crete-subject" role="tab" aria-controls="crete-subject" aria-selected="false">Create Subject</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link enabled" id="add-student-tab" data-bs-toggle="pill" href="#add-student" role="tab" aria-controls="add-student" aria-selected="true">Add Student</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link enabled" id="add-teacher-tab" data-bs-toggle="pill" href="#add-teacher" role="tab" aria-controls="add-teacher" aria-selected="false">Add Teacher</a>
        </li>
        
        <li class="nav-item" role="presentation">
          <a class="nav-link enabled" id="edit-student-tab" data-bs-toggle="pill" href="#edit-student" role="tab" aria-controls="edit-student" aria-selected="false">Edit Student</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link enabled" id="edit-subject-tab" data-bs-toggle="pill" href="#edit-subject" role="tab" aria-controls="edit-subject" aria-selected="false">Edit Subject</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link enabled" id="edit-teacher-tab" data-bs-toggle="pill" href="#edit-teacher" role="tab" aria-controls="edit-teacher" aria-selected="false">Edit Teacher</a>
        </li>
        <li class="nav-item" role="presentation">
          <a class="nav-link enabled" id="check-result-tab" data-bs-toggle="pill" href="#check-result" role="tab" aria-controls="check-result" aria-selected="false">Check Result</a>
        </li>
        
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="crete-subject" role="tabpanel" aria-labelledby="crete-subject-tab"><?php include 'add_subject.php';?></div>
        <div class="tab-pane fade" id="add-student" role="tabpanel" aria-labelledby="add-student-tab"><?php include 'add_student.php';?></div>
        <div class="tab-pane fade" id="add-teacher" role="tabpanel" aria-labelledby="add-teacher-tab"><?php include 'add_teacher.php';?></div>
        
        <div class="tab-pane fade" id="edit-student" role="tabpanel" aria-labelledby="edit-student-tab"><?php include 'edit_student_form.php';?></div>
        <div class="tab-pane fade" id="edit-subject" role="tabpanel" aria-labelledby="edit-subject-tab"><?php include 'edit_subject.php';?></div>
        <div class="tab-pane fade" id="edit-teacher" role="tabpanel" aria-labelledby="edit-teacher-tab"><?php include 'edit_teacher.php';?></div>
        <div class="tab-pane fade" id="check-result" role="tabpanel" aria-labelledby="check-result-tab"><?php include 'check_result_teacher.php';?></div>
        
      </div>

      



    </div>
  </div>
  

  
  

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>

