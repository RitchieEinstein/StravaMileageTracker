<?php
	session_start();
	error_reporting(0);
	require_once("dbconnect.php");
	if(!isset($_POST['op'])){
		echo "OP Code not Valid";
		exit();
	}
	$op = $_POST['op'];
	switch($op){
		case '1':
			$access_token = $_SESSION['TOKEN'];
			$uname = $_SESSION['uname'];
			$fname = $_SESSION['fname'];
			$lname = $_SESSION['lname'];
			$uid = $_SESSION['uid'];
			$kms = $_POST['kms'];
			$sql = "INSERT INTO TEMPB VALUES ('$access_token',$uid,'$uname','$fname','$lname',0,$kms,0)";
			if(!mysqli_query($conn,$sql)){
				Die(mysqli_error($conn));
				exit();
			}
			echo "Account Created Successfully";
			exit();
	}

?>