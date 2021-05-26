<?php 
include 'check_teacher_session.php';
if ($db_teacher_role != 'Principle' || $db_teacher_role != 'classTeacher') {
	echo "<script>location='main_dashboard.php'</script>";
}
?>