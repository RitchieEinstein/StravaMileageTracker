<?php

	$clientid = '';			// Your Client ID Here
	$redirectDomain = '';		// Domain in your app's validate.php file is hosted to which Strava needs to redirect after premission processing
?>

<html>

<a href="https://www.strava.com/oauth/authorize?client_id=<?php echo $clientid;?>&response_type=code&redirect_uri=<?php echo $redirectURL; ?>/validate.php&scope=write&state=mystate&approval_prompt=force"><img src="https://strava.github.io/api/images/LogInWithStrava@2x.png" /></a>

</html>
