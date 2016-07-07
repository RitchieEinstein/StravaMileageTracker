# StravaMileageTracker


# Installation:

1. Create a MySQL database along with a user and password. (We suggest you to give just the INSERT, SELECT AND UPDATE privileges for the user).

2. Import the file wccgtracker.sql into your database.

3. Open the dbconnect.php file and update the database related fields in their appropriate variables.

4. We believe that by this stage, you might have registered your application with STRAVA developers page. After successful registration you'll be provided with a ClientID and ClientSecret. Open the validate.php file and enter the ClientID and ClientSecret that was provided by the Strava in their appropriate variables.

5. Open apply.php file. Enter the ClientID from the Strava and the URI location of the folder which is currently hosting application. Eg(http://www.mytracker.com/) within the brackets.

6. Now your application should be able to track all the users who have applied and authorized your web application to track them.


# This Application is still under development. Please feel free to notify us in case of any bugs. 
