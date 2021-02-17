<?php 

$class_from_teacherId = $con -> query("SELECT `class` FROM `teacher_details` WHERE `teacher_id` = '$teacher_id' AND `role`= 'classTeacher' AND `status` = 'full'");
global $class_num;
$class_num = mysqli_num_rows($class_from_teacherId);
if ($class_from_teacherId AND $class_num !=0) {
 
    $class_row = $class_from_teacherId -> fetch_array(MYSQLI_ASSOC);

    
    $selectedClass = $class_row['class'];
    	//echo $selectedClass;
}
else {
  //echo 'Nooooo';
  $selectedClass = 0;
}


?>
