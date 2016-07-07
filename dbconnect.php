<?php

$host = "";			//Hostname of the Database Server(Not the database name); eg. Localhost
$username = "";		//Database Username
$password = "";		//Database Password
$databaseName ="";	//The Actual Database Name

$conn = mysqli_connect($host,$username,$password,$databaseName);
if(!$conn){
	Die(mysqli_error());
	exit();
}

?>
