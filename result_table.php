<?php 
$student_id = $studentId;
include 'connect.php';


$class = $_SESSION['studentClass'];
//******Fetch subject code *******
$class_sql = $con -> query("SELECT * FROM `subject_details` WHERE `class`='$class'");
if ($class_sql) {
	$class_row_num = mysqli_num_rows($class_sql);

    //echo $class_row_num;
    for ($i = $class_row_num-1; $i >= 0; $i--) {
    	$class_row = $class_sql -> fetch_array(MYSQLI_ASSOC);
    	$subject_code[] = $class_row['subject_code'];
    }
}
else {
	echo 'Subject code fetch failed';
}
//*****Fetch Subject name from subject code***
for ($i = 0; $i < $class_row_num; $i++) {
	//$subject_code[] = $subject_code[$i];
	//echo $subject_code[$i-3];
	$subject_sql = $con -> query("SELECT * FROM `subject_details` WHERE `subject_code`='$subject_code[$i]'");
	if ($subject_sql) {
		$subject_row = $subject_sql -> fetch_array(MYSQLI_ASSOC);
		$subject_name[] = $subject_row['subject_name'];	
		$full_marks[] = $subject_row['full_marks'];
		$pass_marks[] = $subject_row['pass_marks'];
		$internal_marks[] = $subject_row['internal_marks'];
		$practical_marks[] = $subject_row['practical_marks'];
	}
	else {
		echo 'Subject name fetch failed';
	}
}


$subject_count = $class_row_num;


//****Fetch Theoritical Result data****

// global $subject_marks;
// $subject_marks = [];

$subject_marks = obtained_marks('class_result',$subject_count, $subject_code, $student_id,$exam_type[$a]);
$practical_marks = obtained_marks('practical_marks',$subject_count, $subject_code, $student_id,$exam_type[$a]);
$internal_marks = obtained_marks('internal_marks',$subject_count, $subject_code, $student_id,$exam_type[$a]);

$a++;
//*****Table Started*****
echo "<table class='table table-bordered'>
<tr>
<th rowspan='2'>Subject Code</th>
<th rowspan='2'>Subject Name</th>
<th rowspan='2'>Pass Marks</th>
<th rowspan='2'>Full Marks</th>
<th colspan='3'>Marks Obtained</th>
<th rowspan='2'>Total</th>
<th rowspan='2'>Remarks</th>
</tr>
<tr>
<td>Theory</td>
<td>Practical</td>
<td>Internal</td>
</tr>
";
$total_subject_marks = $total_full_marks = $total_pass_marks = $total_obtained_marks = $total_practical_marks = $total_internal_marks = $final_total_marks = 0;
for ($i = 0; $i < $subject_count; $i++) {
	if($subject_marks[$i] >= 35){
		$remarks = "Pass";
	}
	else{
		$remarks = "Fail";
	}
	$total_subject_marks = (int)$subject_marks[$i] + (int)$practical_marks[$i] + (int)$internal_marks[$i];
	$total_full_marks = $total_full_marks + (int)$full_marks[$i];
	$total_pass_marks = $total_pass_marks + (int)$pass_marks[$i];
	$total_obtained_marks = $total_obtained_marks + (int)$subject_marks[$i];
	$total_practical_marks = $total_practical_marks + (int)$practical_marks[$i];
	$total_internal_marks = $total_internal_marks + (int)$internal_marks[$i];
	$final_total_marks = $total_obtained_marks + $total_internal_marks + $total_practical_marks;

	$inPercent = round(((float)$final_total_marks/(float)$total_full_marks)*100,2);
	if ($inPercent >= 80.0) {
		$division = 'Distinction';
	}
	elseif ($inPercent >= 60.0) {
		$division = 'First Division';
	}
	elseif ($inPercent >= 50) {
		$division = 'Second Division';
	}
	elseif($inPercent >= 35) {
		$division = 'Third Division';
	}
	else {
		$division = 'Fail';
	}
	echo "<tr>
	<td>$subject_code[$i]</td>
	<td>$subject_name[$i]</td>
	<td>$pass_marks[$i]</td>
	<td>$full_marks[$i]</td>
	<td>$subject_marks[$i]</td>
	<td>$practical_marks[$i]</td>
	<td>$internal_marks[$i]</td>
	<td>$total_subject_marks</td>
	<td>$remarks</td>
	</tr>";
}

echo "<tr>

<td>Percentage: $inPercent%</td>
<td>Total</td>
<td>$total_pass_marks</td>
<td>$total_full_marks</td>
<td>$total_obtained_marks</td>
<td>$total_practical_marks</td>
<td>$total_internal_marks</td>
<td>$final_total_marks</td>
<td>$division</td>
</tr>
";

echo "</table>";



?>



