<?php
	$clientID = '';			//The Client ID provided by Strava
	$clientSecret = '';		//The Client Secret provided by Strava
	session_start();
	error_reporting(0);
	require_once("dbconnect.php");
	if(!isset($_GET['code'])){
		Die("Error. No Code");
	}
	$ch = curl_init();
	$fields = array(
		'client_id' => urlencode($clientID),
		'client_secret' => urlencode($clientSecret),
		'code' => urlencode($_GET['code'])
	);
	foreach($fields as $key=>$value){
		$fields_string .= $key.'='.$value.'&'; 
	}
	rtrim($fields_string, '&');
	curl_setopt($ch,CURLOPT_URL,'https://www.strava.com/oauth/token');
	curl_setopt($ch,CURLOPT_POST, count($fields));
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	$res = json_decode($result,true,10);
	$access_token = $res[access_token];
	$uname = $res[athlete][username];
	$fname = $res[athlete][firstname];
	$lname = $res[athlete][lastname];
	$uid = $res[athlete][id];
	$sql = "SELECT * FROM TEMPB WHERE USERID = $uid";
	if(!$ans1 = mysqli_query($conn,$sql)){
		echo mysqli_error($conn);
	}
	$count = mysqli_num_rows($ans1);
	if($count > 0){
		echo "User Already Exists";
		exit();
	}
	if($access_token != ''){
		$_SESSION['TOKEN'] = $access_token;
	}
	else{
		echo "Token Creation Error";
	}
	$_SESSION['uname'] = $uname;
	$_SESSION['fname'] = $fname;
	$_SESSION['lname'] = $lname;
	$_SESSION['uid'] = $uid;
	
?>


<html lang=en>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<meta name="description" content="Rider ID Generator">
    	<meta name="author" content="Ritchie">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
		
		<title>BRM BIB Generator</title>
		<style type="text/css">
			body {
			  padding-top: 50px;
			  background-image: url(https://images7.alphacoders.com/345/345366.jpg);
			}
			html { 
			  background: url(https://images7.alphacoders.com/345/345366.jpg) no-repeat center center fixed; 
			  -webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover;
			}
			.template {
			  padding: 40px 15px;
			  text-align: center;
			}
			.container{

			}
		</style>
		<script>
			$(document).ready(function(){
				$('#subform').submit(function(e){
					e.preventDefault();
					var kms = $('#sel').val();
					if(kms != '---'){
						$.post("qengine.php",
						{
							op: 1,
							kms: kms
						},
						function(data){
							alert(data);
							if(data == 'Account Created Successfully'){
								window.location.href = "view.php";
							}
						});
					}
					else{
						alert("Please select one of the Values");
					}
				});
			});
		</script>
	</head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">WCCG EVENT TITLE</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <!--<ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>-->
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container"><br><Br>
    	<div class="col-sm-8 col-sm-offset-2">
    		<div class="panel panel-default">
    			<div class="panel-heading"><h3>Thank you for Registering</h3></div>
    			<div class="panel-body">
    				<p><strong>Please select the Distance you want to participate:</strong></p>
    				<form role="form" class="form-horizontal" id="subform" method="POST" target="_blank">
    					<div class="form-group">
    						<label class="control-label col-sm-3" for="rider_no">Distance : </label>
    						<div class="col-sm-7">
    							<!--<input type="text" class="form-control" id="rider_no" name="rider_no" required="true">-->
    							<select class="form-control" id="sel">
    								<option value="---">---</option>
    								<option value="750">750 kms</option>
    								<option value="1000">1000 kms</option>
    								<option value="1250">1250 kms</option>
    								<option value="1500">1500 kms</option>
    							</select>
    						</div>
    					</div>
    					
    					<div class="row"><br>
    						<button type="submit" name="submit" class="btn btn-primary col-sm-offset-5">Apply</button>
    					</div>
    				</form>
    			</div>
			</div>
    	
    	</div>

    </div>
	</body>
</html>
