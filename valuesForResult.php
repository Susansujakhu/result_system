
 <?php 
include 'connect.php';
$batch_sql = $con -> query("SELECT DISTINCT `batch` FROM `student_details`");
if ($batch_sql) {
	while ($fetched_row = $batch_sql -> fetch_array(MYSQLI_ASSOC)) {
	     $fetched_batch[] = $fetched_row['batch'];
	 } 
}
$id_sql = $con -> query("SELECT `student_id` FROM `student_details`");
if ($id_sql) {
	while ($id_row = $id_sql -> fetch_array(MYSQLI_ASSOC)) {
	    $fetched_id[] = $id_row['student_id'];
	}
}
$examType_sql = $con -> query("SELECT * FROM `exam_type`");
if ($examType_sql) {
	$exam_count = mysqli_num_rows($examType_sql);
	while ($examType_row = $examType_sql -> fetch_array(MYSQLI_ASSOC)) {
	    $examType[] = $examType_row['type'];
	    $examType_value[] = $examType_row['value'];
	}
}

$current_year = date("Y");
for ($i = 0; $i <= 10; $i++) {
	$years[] = $current_year-$i;
}
 ?>