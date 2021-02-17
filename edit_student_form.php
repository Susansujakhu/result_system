  <form action="" method="post" enctype="multipart/form-data">
    <table class="table table-bordered">
      <tr>
       <th>SN</th>
       <th>ID</th>
       <th>Name</th>
       <th>Class</th>
       <th>Section</th>
       <th>Address</th>
       <th>Contact</th>
       <th>Email</th>
       <th>Password</th>
       <th>Image</th>
       <th>Status</th>



       <?php 
       $count = 0;
   //for ($i = 0; $i < $class_num; $i++) {
    //$current_class = $class[$i];
  //echo $current_class;
       include 'connect.php';
       $teacher_id = $_SESSION['teacher_id'];
       $checkRole = $con -> query("SELECT `role` FROM `teacher_details` WHERE `teacher_id`=$teacher_id");
       if ($checkRole) {
        while ($rows = $checkRole -> fetch_array(MYSQLI_ASSOC)) {
          $role = $rows['role'];
          if ($role == 'Principle') {
            $checkId = $con -> query("SELECT * FROM `student_details`");
            echo "<th>Teacher ID</th></tr>";
            break;
          }
          else {
            include 'fetch_class.php';
            $checkId = $con -> query("SELECT * FROM `student_details` WHERE `class`=$selectedClass");
            $teacher_id = $_SESSION['teacher_id'];
            break;
          }
        }
      }



      if ($checkId) {
        $total_num = mysqli_num_rows($checkId);
      //echo 'success'.$total_num;
        while ($row = $checkId -> fetch_assoc()) {
        //echo $row['student_id'];
          $count = $count + 1;

          if ($row['status']=="In") {
            $status = "Out";
          }
          else {
            $status = "In";
          }
          echo "<input type='hidden' name='sn[]' value=".$row['sn'].">";
          echo "
          <tr>
          <td>".$count."</td>
          <td><input type='text' class='form-control' style='width:100px' name='id[]' value=".$row['student_id']."></td>
          <td><input type='text' class='form-control' style='width:auto' name='student_name[]' value=\"{$row['student_name']}\"></td>
          <td><input type='text' class='form-control' style='width:50px' name='class[]' value=".$row['class']."></td>
          <td><input type='text' class='form-control' style='width:auto' name='section[]' value=".$row['section']."></td>
          <td><input type='text' class='form-control' style='width:auto' name='address[]' value=\"{$row['address']}\"></td>
          <td><input type='text' class='form-control' style='width:auto' name='mobile_number[]' value=".$row['mobile_number']."></td>
          <td><input type='text' class='form-control' style='width:auto' name='email[]' value=".$row['email']."></td>
          <td><input type='text' class='form-control' style='width:auto' name='password[]' value=".$row['password']."></td>
          <td><input type='file' class='form-control' style='width:auto' name='image[]' ></td>
          <td>
          <select class='form-control' style='width:70px' id='db_status' name='status[]'>
          <option selected>".$row['status']."</option>
          <option>".$status."</option>
          </select>
          </td>
          ";
          if ($role == 'Principle') {
            $teacher_id = $row['teacher_id'];
            echo "<td><input type='text' class='form-control' style='width:100px' name='teacher_id[]' value=".$teacher_id."></td>";
          }
          echo '</tr>';
        }
      }
      else {
        echo 'failed';
      }
 // }
      ?>
    </table>
    <button type='submit' name='edit_student'>Save</button>
  </form>


<?php 

if (isset($_POST['edit_student'])) {


  $count=count($_POST["sn"]);
  
  for($i=0;$i<$count;$i++){

    if ($role =='Principle') {
      $teacher_id = $_POST['teacher_id'][$i];
    }

    $update = $con -> query("UPDATE `student_details` SET `student_id` = '".$_POST['id'][$i]."', `student_name` = '".$_POST['student_name'][$i]."', `batch` = '".date("Y")-$_POST['class'][$i]."', `class` = '".$_POST['class'][$i]."', `section` = '".$_POST['section'][$i]."', `address` = '".$_POST['address'][$i]."', `mobile_number` = '".$_POST['mobile_number'][$i]."', `email` = '".$_POST['email'][$i]."', `password` = '".$_POST['password'][$i]."', `status` = '".$_POST['status'][$i]."', `teacher_id` = '".$teacher_id."' WHERE `student_details`.`sn` = '".$_POST['sn'][$i]."'");
    if (mysqli_error($con)) {
      echo "<script>alert('Cant edit due to duplicate student ID');</script>";
    }
  }
  if ($update) {
    echo "<script>alert('Edit Successfully');</script>";
  }
  else {
    echo 'faill';
  }
}
?>