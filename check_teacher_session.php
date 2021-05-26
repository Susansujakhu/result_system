 <?php 
session_start();

if (isset($_SESSION['teacher_id'])) {
  $teacher_id = $_SESSION['teacher_id'];
  include 'connect.php';
  $fetch_teacher_details = $con -> query("SELECT * FROM `teacher_details` WHERE `teacher_id` = $teacher_id");
  while ($details_result = $fetch_teacher_details -> fetch_array(MYSQLI_ASSOC)) {
    $profile__img = "img/".'person.jpg';
    $db_teacher_name = $details_result['teacher_name'];
    $db_teacher_role = $details_result['role'];
  }
}
else {
    //echo 'notttt';
  header("location:./");
}
include 'logout.php';
?>