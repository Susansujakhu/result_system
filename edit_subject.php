<?php include 'connect.php'; ?>

<form action="" method="post">
  <table class="table table-bordered">
    <tr>
     <th>SN</th>
     <th>Subject Code</th>
     <th>Subject Name</th>
     <th>Class</th>
     <th>Full Marks</th>
     <th>Pass Marks</th>
     <th>Internal</th>
     <th>Practical</th>
     <th>Teacher ID</th>
   </tr>
   <?php 
   $count = 0;
   $teacher_id = $_SESSION['teacher_id'];
   //for ($i = 0; $i < $class_num; $i++) {
   // $current_class = $class[$i];
  //echo $current_class;
   $role = $_SESSION['role'];
   if ($role == "Principle") {
     $sql = "SELECT * FROM `subject_details`";
     
   }
   else {
     $sql = "SELECT * FROM `subject_details` WHERE `teacher_id`=$teacher_id";

   }
   $checkId = $con -> query($sql);

   if ($checkId) {
    $total_num = mysqli_num_rows($checkId);
      //echo 'success'.$total_num;
    while ($row = $checkId -> fetch_assoc()) {
        //echo $row['student_id'];
      $count = $count + 1;

      echo "<input type='hidden' class='form-control' name='sn[]' value=".$row['sn'].">";
      echo "
      <tr>
      <td>".$count."</td>
      <td><input type='text' class='form-control' style='width:100px' name='subject_code[]' value=".$row['subject_code']."></td>
      <td><input type='text' class='form-control' style='width:auto' name='subject_name[]' value=".$row['subject_name']."></td>
      <td><input type='text' class='form-control' style='width:50px' name='class[]' value=".$row['class']."></td>
      <td><input type='text' class='form-control' style='width:50px' name='full_marks[]' value=".$row['full_marks']."></td>
      <td><input type='text' class='form-control' style='width:50px' name='pass_marks[]' value=".$row['pass_marks']."></td>
      <td><input type='text' class='form-control' style='width:50px' name='internal_marks[]' value=".$row['internal_marks']."></td>
      <td><input type='text' class='form-control' style='width:50px' name='practical_marks[]' value=".$row['practical_marks']."></td>
      <td><input type='text' class='form-control' style='width:100px' name='teacher_id[]' value=".$row['teacher_id']." disabled></td>
      </tr>
      ";


    }
  }
  else {
    echo 'failed';
  }
  //}
  ?>
</table>
<button type='submit' name='Submit'>Save</button>
</form>

<?php 

if (isset($_POST['Submit'])) {
  $count=count($_POST["sn"]);
  
  for($i=0;$i<$count;$i++){

    $update = $con -> query("UPDATE `subject_details` SET `subject_code` = '".$_POST['subject_code'][$i]."', `subject_name` = '".$_POST['subject_name'][$i]."', `class` = '".$_POST['class'][$i]."', `full_marks` = '".$_POST['full_marks'][$i]."', `pass_marks` = '".$_POST['pass_marks'][$i]."', `internal_marks` = '".$_POST['internal_marks'][$i]."', `practical_marks` = '".$_POST['practical_marks'][$i]."' WHERE `subject_details`.`sn` = '".$_POST['sn'][$i]."'");
    
  }
  if ($update) {
    echo "<script>alert('Edit Success')</script>";
  }
  else {
    echo 'faill';
  }
}
?>