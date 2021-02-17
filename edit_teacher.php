  <form action="" method="post">
    <table class="table table-bordered">
      <tr>
       <th>SN</th>
       <th>ID</th>
       <th>Name</th>
       <th>Address</th>
       <th>Contact</th>
       <th>Email</th>
       <th>Username</th>
       <th>Password</th>
       <th>Class</th>
       <th>Role</th>  
       <th>Status</th>

     </tr>

     <?php 
     $count = 0;
     include 'connect.php';
   //for ($i = 0; $i < $class_num; $i++) {
    //$current_class = $class[$i];
  //echo $current_class;
     $checkId = $con -> query("SELECT * FROM `teacher_details`");

     if ($checkId) {
      $total_num = mysqli_num_rows($checkId);
      //echo 'success'.$total_num;
      while ($row = $checkId -> fetch_assoc()) {
        //echo $row['student_id'];
        $count = $count + 1;
        global $status,$role;
        $status = [];
        $role = [];
        if ($row['status']=="full") {
          $status[0] = "part";
          $status[1] = "out";
        }
        else if($row['status']=="part"){
          $status[0] = "full";
          $status[1] = "out";
        }
        else {
          $status[0] = "full";
          $status[1] = "part"; 
        }

        if ($row['role']=="classTeacher") {
          $role[0] = "Teacher";
          $role[1] = "Principle";
        }
        else if($row['role']=="Teacher"){
          $role[0] = "Principle";
          $role[1] = "classTeacher";
        }
        else {
          $role[0] = "classTeacher";
          $role[1] = "Teacher"; 
        }
        echo "<input type='hidden' name='sn[]' value=".$row['sn'].">";
        echo "
        <tr>
        <td>".$count."</td>
        <td><input type='text' class='form-control' style='width:100px' name='teacher_id[]' value=".$row['teacher_id']."></td>
        <td><input type='text' class='form-control' style='width:auto' name='teacher_name[]' value=\"{$row['teacher_name']}\"></td>
        <td><input type='text' class='form-control' style='width:auto' name='address[]' value=\"{$row['address']}\"></td>
        <td><input type='text' class='form-control' style='width:auto' name='contact[]' value=".$row['contact']."></td>
        <td><input type='text' class='form-control' style='width:auto' name='email[]' value=".$row['email']."></td>
        <td><input type='text' class='form-control' style='width:auto' name='username[]' value=".$row['username']."></td>
        <td><input type='text' class='form-control' style='width:auto' name='password[]' value=".$row['password']."></td>
        <td><input type='text' class='form-control' style='width:50px' name='class[]' value=".$row['class']."></td>
        <td>
        <select class='form-control' style='width:150px' id='db_role' name='role[]'>
        <option value=".$row['role']." selected>".$row['role']."</option>
        <option value=".$role[0].">".$role[0]."</option>
        <option value=".$role[1].">".$role[1]."</option>
        </select>
        </td>
        <td>
        <select class='form-control' style='width:100px' id='db_status' name='status[]'>
        <option value=".$row['status']." selected>".$row['status']."</option>
        <option value=".$status[0].">".$status[0]."</option>
        <option value=".$status[1].">".$status[1]."</option>
        </select>
        </td>

        </tr>
        ";


      }
    }
    else {
      echo 'failed';
    }
 // }
    ?>
  </table>
  <button type='submit' name='edit_teacher_Submit'>Save</button>
</form>



<?php 

if (isset($_POST['edit_teacher_Submit'])) {
  $teacher_id = $_SESSION['teacher_id'];
  $count=count($_POST["sn"]);
  
  for($i=0;$i<$count;$i++){

    $update = $con -> query("UPDATE `teacher_details` SET `teacher_id` = '".$_POST['teacher_id'][$i]."', `teacher_name` = '".$_POST['teacher_name'][$i]."', `address` = '".$_POST['address'][$i]."', `contact` = '".$_POST['contact'][$i]."', `email` = '".$_POST['email'][$i]."', `username` = '".$_POST['username'][$i]."', `password` = '".$_POST['password'][$i]."', `role` = '".$_POST['role'][$i]."', `class` = '".$_POST['class'][$i]."', `status` = '".$_POST['status'][$i]."' WHERE `teacher_details`.`sn` = '".$_POST['sn'][$i]."'");
    
  }
  if ($update) {
    echo "<script>alert('Edit Successfully');</script>";
  }
  else {
    echo 'faill';
  }
}
?>