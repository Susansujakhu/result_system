<?php 
session_start();
if ($_SESSION['studentId'] != '') {
  $studentId = $_SESSION['studentId'];
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
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

  <title>Result</title>
</head>
<body>
<form action="" method="post" class="d-flex">
        <button class="btn btn-dark" type="submit" name="logout">Logout</button>
      </form>
  <?php include 'logout.php'?>
  



  <h1>Results</h1>
  <?php 
  function obtained_marks($table_name, $subject_count, $subject_code, $student_id, $exam_type){
    include 'connect.php';

    $result_sql = "SELECT * FROM `$table_name` WHERE `student_id`= $student_id AND `type` = $exam_type" ;
    $result = $con -> query($result_sql);
    if ($result) {
      $row=$result -> fetch_array(MYSQLI_ASSOC);
    //$result_id = $row['result_id'];
    //$student_id = $row['student_id'];
      for ($i = 0; $i < $subject_count; $i++) {
      //echo $subject_count;
        $subject_marks[] = $row[$subject_code[$i]];
      }
      return $subject_marks;
    }
    else {
      echo 'failed'.$table_name;
    } 
  }
  ?>


  <?php 
  include 'connect.php';
  $check_sql = $con -> query("SELECT DISTINCT `type` FROM `class_result` WHERE `student_id` = $studentId");
  $a = 0;
  while ($fetched_type = $check_sql -> fetch_array(MYSQLI_ASSOC)) {
    $exam_type[] = $fetched_type['type'];

    $examType_sql = $con -> query("SELECT * FROM `exam_type` WHERE `value` = $exam_type[$a]");
    if ($examType_sql) {
      $exam_count = mysqli_num_rows($examType_sql);
      while ($examType_row = $examType_sql -> fetch_array(MYSQLI_ASSOC)) {
        $examType[] = $examType_row['type'];
      
      }
    }

    echo "<h2>".$examType[$a]."</h2>";
    include 'result_table.php'; 
  }
  

  ?>

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