<?php 

$teacherId = $_SESSION['teacher_id'];

//SUBJECT CODE FETCH
$subject_sql = $con -> query("SELECT * FROM `subject_details` WHERE `teacher_id`='$teacherId'");
if ($subject_sql) {
	$subject_row_num = mysqli_num_rows($subject_sql);

    //echo $subject_row_num;
	for ($i = $subject_row_num-1; $i >= 0; $i--) {
		$subject_row = $subject_sql -> fetch_array(MYSQLI_ASSOC);
		$subject_code[] = $subject_row['subject_code'];
		$subject_name[] = $subject_row['subject_name'];	
		$full_marks[] = $subject_row['full_marks'];
		$pass_marks[] = $subject_row['pass_marks'];
		$internal_marks[] = $subject_row['internal_marks'];
		$practical_marks[] = $subject_row['practical_marks'];
		echo $subject_row['subject_name']."</br>";
	}
}
else {
	echo 'Subject code fetch failed';
}

 ?>