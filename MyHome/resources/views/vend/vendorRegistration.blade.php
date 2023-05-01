<!DOCTYPE html>
<html lang="en">
<head>
	<title>MyHome - Update Information</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
	<script>var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {  return new bootstrap.Tooltip(tooltipTriggerEl)})</script>
</head>
<style>
p {
  font-size: 21px;
  font-weight: bold;
}
input[type=text]:focus {
  border-color: #8c5020;
}
input[type=password]:focus {
  border-color: #8c5020;
}
input[type=radio] {
  font-size: 20px;
}
label {
  font-size: 18px;
  padding: 7px 0;
}
.form { margin: 50px auto;
    width: 100px;
    text-align: center;
    padding: 55px 40px;
    background: white;
    border-style: solid; 
    border-radius: 15px; 
    border-color: black;
}
</style>
<body style="margin-top: 12px; background-image:url({{url('images/wood.jpeg')}})">
<?php
    //require('db.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['vendName'])) {
        // removes backslashes
        $vendName = stripslashes($_REQUEST['vendName']);
        //escapes special characters in a string
        $vendName = mysqli_real_escape_string($con, $vendName);
	$address    = stripslashes($_REQUEST['address']);
        $address    = mysqli_real_escape_string($con, $address);
        $username    = stripslashes($_REQUEST['username']);
        $username    = mysqli_real_escape_string($con, $username);
	$vendtype = stripslashes($_REQUEST['vendtype']);
        $vendtype = mysqli_real_escape_string($con, $vendtype);
		echo $vendtype;
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `vendors` (vendName, address, username, vendtype, password, create_datetime)
                     	VALUES ('$vendName', '$address', '$username', '$vendtype', '" . md5($password) . "', '$create_datetime')";
	$result   = mysqli_query($con, $query);
	if ($result) {
		header("Location: vendorHub.php");
        } else {
            	echo "<div class='container fluid'>
                  <h3>Required fields are missing.</h3><br/>
                  </div>";
        }
    } 	
    else {
}
?>
<div class="container-fluid">
<?php
if (session()->missing('firstname'))
{
    //header("Location: login");
	include(app_path().'/includes/headerLoggedOut.php');
}
else
{
	include(app_path().'/includes/headerLoggedIn.php');
}?>
		<div class = "container-fluid" style="">
		<div class = "row" style="margin: 15px auto; border-radius:15px; padding: 15px 10px; border-style: solid; border-color: black; text-align:center; background-color:white;">
		<h3>Enter the information of your service:</h3>
		</div>
		<form method="post" name="vendorRegistration" action="{{ route('vendorRegister.post') }}">
		@csrf
		<div class = "row" style="">
		<div class = "col form" style="margin:0px 10px;">
			<p style="text-align:center;">Your Business:</p><br>
			<p style="font-weight: normal; font-size: 18px;"> Business Name: </p>
        		<input type="text" style="padding: 5px; border-style:solid;" name="vendName" placeholder="Business Name" autofocus="true"/><br><br>
			<p style="font-weight: normal; font-size: 18px;"> Headquarters Address: </p>
        		<input type="text" style="padding: 5px; border-style:solid;" name="address" placeholder="Address" autofocus="true"/><br><br>
		</div>
		<div class = "col form" style="text-align: left; margin:0px 10px">
			<p style="text-align:center;">Type of Utility:</p>
        		<input type="radio" id="healthVendor" name="vendType" value="health_insurance">
			<label for="healthVendor"> Health Insurance</label><br>
			<input type="radio" id="homeVendor" name="vendType" value="home_insurance">
			<label for="homeVendor"> Homeowner's Insurance</label><br>
			<input type="radio" id="autoVendor" name="vendType" value="auto">
			<label for="autoVendor"> Automobile Insurance</label><br>
			<input type="radio" id="intVendor" name="vendType" value="internet_services">
			<label for="intVendor"> Internet Service</label><br>
			<input type="radio" id="cellVendor" name="vendType" value="cell_services">
			<label for="cellVendor"> Cell Service</label><br>
			<input type="radio" id="lawnVendor" name="vendType" value="Lawncare">
			<label for="lawnVendor"> Lawncare</label><br>
			<input type="radio" id="houseVendor" name="vendType" value="Housekeeping">
			<label for="houseVendor"> Housekeeping</label><br>
		</div>
		<div class = "col form" style="margin:0px 10px">
			<p style="text-align:center;">Account Creation:</p><br>
			<p style="font-weight: normal; font-size: 18px;"> Username: </p>
        		<input type="text" style="padding: 5px; border-style:solid;" name="username" placeholder="Username" autofocus="true"/><br><br>
			<p style="font-weight: normal; font-size: 18px;"> Password: </p>
        		<input type="password" style="padding: 5px; border-style:solid;" name="password" placeholder="Password" autofocus="true"/><br><br>
  		</div>	
		</div>
		</div>	
		<div class = "row" style="float:center; margin: 10px auto; width: 99%;">
			<input type="submit" style="margin:5px 0px; padding: 5px 10px; color: black; border-color: black; background-color:white; border-radius:10px; border-style:solid; border-width:3px;" value="Confirm New Entries" name="submit" class="login-button"/><br><br>
		</div>
		</div>
		</form>
</body>
</html>