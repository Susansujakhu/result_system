<?php 
include 'connect.php';
//SUBJECT CODE FETCH
$class_sql = $con -> query("SELECT * FROM `subject_details` WHERE `class`='$class'");
if ($class_sql) {
	$class_row_num = mysqli_num_rows($class_sql);

    //echo $class_row_num;
	for ($i = $class_row_num-1; $i >= 0; $i--) {
		$class_row = $class_sql -> fetch_array(MYSQLI_ASSOC);
		$subject_code[] = $class_row['subject_code'];
		$subject_name[] = $class_row['subject_name'];	
		$full_marks[] = $class_row['full_marks'];
		$pass_marks[] = $class_row['pass_marks'];
		$internal_marks[] = $class_row['internal_marks'];
		$practical_marks[] = $class_row['practical_marks'];
		
	}
}
else {
	echo 'Subject code fetch failed';
}


// Fetch Result Data


$row=$result -> fetch_array(MYSQLI_ASSOC);

if ($studentId == 0) {
	$studentIdd[] = $row['student_id'];		
}
else {
	$studentIdd[] = $studentId;
}

$exam[] = $row['type'];
for ($i = 0; $i < $class_row_num; $i++) {
			//echo $subject_count;
	$subject_marks[$j][] = $row[$subject_code[$i]];
}

$student_details = $con -> query("SELECT * FROM `student_details` WHERE `student_id`='$studentIdd[$j]'");
while ($student_row = $student_details -> fetch_array(MYSQLI_ASSOC)) {
	$student_name = $student_row['student_name'];

}

if ($exam[$j] == 1) {
	$exam[$j] = "First Terminal";
	$head1++;
}
if ($exam[$j] == 2) {
	$exam[$j] = "Second Terminal";
	$head2++;
}
if ($exam[$j] == 3) {
	$exam[$j] = "Final Terminal";
	$head3++;
}

if ($head1 == 1 OR $head2 == 1 OR $head3 == 1) {
	echo "<table class='table table-bordered'>
	<tr>
	<th>SN</th>
	<th>ID</th>
	<th>Name</th>
	<th>Exam-Type</th>
	";
	for ($i = 0; $i < $class_row_num; $i++) {
		echo "<th>".$subject_name[$i]."</th>";
	}
	echo "
	<th>Total</th>
	<th>Remarks</th>
	</tr>
	";
}





//UI START

$count = $count + 1;
echo "<tr>
<td>".$count."</td>
<td>".$studentIdd[$j]."</td>
<td>".$student_name."</td>
<td>".$exam[$j]."</td>
";
for ($i = 0; $i < $class_row_num; $i++) {
	echo "<th>".$subject_marks[$j][$i]."</th>";
}
echo "
<td>Total</td>

<td>Remarks</td>
</tr>";

?>
