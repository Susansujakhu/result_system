<?php
$database = 'school_management_system';
$con=new mysqli('localhost','root','',$database);
if($con -> connect_errno){
	die("Could not connect to database ".$con -> connect_error);
	exit();
}

?>