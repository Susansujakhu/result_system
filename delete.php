<?php 
function callme($tablename, $id)
{
	include 'connect.php';
	$sql="DELETE FROM `$tablename` WHERE sn=$id";
	if(mysqli_query($con,$sql)){
		echo "delete Success";
		$sql1="ALTER TABLE `$tablename` DROP `sn`";
		mysqli_query($con,$sql1);
		$sql2="ALTER TABLE `$tablename` ADD `sn` INT NOT NULL AUTO_INCREMENT FIRST, ADD PRIMARY KEY (`sn`)";
		mysqli_query($con,$sql2);
	}
	else{
		echo "Delete Failed";

	}
}

callme('class_result',1);
callme('internal_marks',1);
callme('practical_marks',1);
callme('student_details',17)

?>