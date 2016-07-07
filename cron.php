<?php
	error_reporting(E_ERROR);

	require_once("dbconnect.php");
	$curtime = time();
	$curtime = 1467311400; // epoch time from which you like to start the mileage counter
	$sql = "SELECT * FROM TEMPB";
	$res = mysqli_query($conn,$sql);
	while($row = mysqli_fetch_assoc($res)){
		$token = $row['TOKEN'];
		//echo $token . " " . $row['FNAME'] . " <br>";
		$ch = curl_init();
		$authorization = "Authorization: Bearer " . $token;
		$url = 'https://www.strava.com/api/v3/activities?after=' . $curtime;
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
    		curl_close($ch);
    		$ans = json_decode($result,true,10);
    		//print_r($ans);
    		if(empty($ans)){
    			echo "No activity <br>";
    			continue;
    		}
    		//$dis = $row['DISTANCE'];
    		$dis = 0;
    		//echo $dis . "   ";
    		foreach($ans as $key){
    			//echo "<br>" . $key[distance] . "<br>";
    			$dis = $dis + ($key[distance] / 1000);
    		}
    		$comp = ($dis * 100) / $row['MILEAGE'];
    		//echo $dis . "   ";
    		$sql1 = "UPDATE TEMPB SET DISTANCE = $dis, COMPLETED = $comp WHERE TOKEN = '$token'";
    		//echo "<br>".$sql1."<br>";
    		if(!mysqli_query($conn,$sql1)){
    			echo mysqli_error($conn);
    		}
    		//echo "<br>" . $result . "<br><br>";
	}

?>
