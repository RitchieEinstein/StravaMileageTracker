<?php

	error_reporting(0);
	require_once("dbconnect.php");
	$sql = "SELECT * FROM TEMPB ORDER BY MILEAGE DESC";
	$res = mysqli_query($conn,$sql);

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
		
		<title>WCCG Leaderboard</title>
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
    			<div class="panel-heading"><h3>Completion Table</h3></div>
    			<div class="panel-body">
    				<table class="table table-striped table-hover">
    					<tr>
    						<th>First Name</th>
    						<th>Last Name</th>
    						<th>Tracker</th>
    						<th>ID</th>
    						<th>Completed</th>
    						<th>Challenge</th>
    						<th>Percentage</th>
    					</tr>
    					<?php
    					while($row = mysqli_fetch_assoc($res)){
    						if($row[COMPLETED] >= 99.99){
    							$color = "success";
    						}
    						else{
    							$color = "warning";
    						}
    						echo "<tr class='$color'><td>$row[FNAME]</td><td>$row[LNAME]</td><td>STRAVA</td><td>$row[USERID]</td><td>$row[DISTANCE]</td><td>$row[MILEAGE]</td><td>$row[COMPLETED]</td></tr>";
    					}
    					?>
    				</table>
    			</div>
			</div>
    	
    	</div>

    </div>
	</body>
</html>