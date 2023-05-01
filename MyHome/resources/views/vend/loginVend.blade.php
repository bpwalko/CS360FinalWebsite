<!DOCTYPE html>
<html lang="en">
<head>
	<title>MyHome - Login</title>
	<script language="javascript">
		function SelectRedirectUser(){
			window.location.href = "../login";
		}
		function SelectRedirectVend(){
			window.location.href = "../loginVend";
		}
	</script>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
	<script>var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {  return new bootstrap.Tooltip(tooltipTriggerEl)})</script>
</head>
<style>
input[type=text]:focus {
  border-color: #8c5020;
}
input[type=password]:focus {
  border-color: #8c5020;
}
.form { margin: 50px auto;
    text-align: center;
    width: 400px;
    padding: 70px 40px;
    background: white;
    border-style: solid; 
    border-radius: 15px; 
    border-color: black;
}
.form-control {
padding: 5px; 
border-style:solid; 
border-color:black;
border-width: 3px;
}
</style>
<body style="margin-top: 12px; background-image:url({{url('images/wood.jpeg')}})">
<?php
    //require('db.php');
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['vendName'])) {
        $vendName = stripslashes($_REQUEST['vendName']);
		$username    = stripslashes($_REQUEST['username']);
        $password = stripslashes($_REQUEST['password']);

        $query    = "SELECT * FROM `vendors` WHERE vendName='$vendName'
		    AND username='$username'
            AND password='" . md5($password) . "'";

        $result = DB::select($query);
        if ($result != NULL) {
            //$_SESSION['vendName'] = $vendName;
            // Redirect to user dashboard page
            //header("Location: vendorHub");
        } else {
            echo "<div class='form'>
                  <h3>Incorrect Business Name/Username/Password.</h3><br/>
                  <p class='link'>Click here to <a href='loginVend'>Login</a> again.</p>
                  </div>";
        }
    } else {
}?>
<div class="container-fluid">
<?php 
if (session()->missing('firstname'))
{
    header("Location: login");
	include(app_path().'/includes/headerLoggedOut.php');
}
else
{
	include(app_path().'/includes/headerLoggedIn.php');
}
?>
		<div class = "container-fluid" style="padding:10px 15px;">
		<div class = "row" style="">
			<div class = "col" style="margin-top: 70px; margin-left:125px;">
		 	<div class="form" method="post" name="loginType">
			<p class="login-title" style="color:black;"><b> Would you like to login as a User or a Vendor? </b></p><br>
				<input type="radio" style="color:white;" onClick ="SelectRedirectUser();" value="User">
				<label for="User"> User</label><br>
				<input type="radio" onClick ="SelectRedirectVend();" value="Vendor">
				<label for="Vendor"> Vendor</label><br><br>
			<p class="link" style="color:#8c5020;"><a style="color:#8c5020;" href='vendorRegistration'>New Registration</a></p>
  			</div>
			</div>
			<div class = "col" style = "margin-right:125px;">
			@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
		 	<form class="form" method="post" name="login" action="{{ route('loginVend.post') }}">
			@csrf
        		<h1 class="login-title" style="color:black;">Vendor Login</h1><br>
        		<input type="text" style="padding: 5px; border-style:solid;" name="vendName" placeholder="Business Name" autofocus="true"/><br><br>
			<input type="text" style="padding: 5px; border-style:solid;" name="username" placeholder="Username" autofocus="true"/><br><br>
        		<input type="password" style="padding: 5px; border-style:solid;" name="password" placeholder="Password"/><br><br>
        		<input type="submit" style="padding: 5px 10px; color: white; background-color:#8c5020; border-radius:10px; border-style:solid; border-color:black;" value="Login" name="submit" class="login-button"/><br><br>
			</div>
		</div>
		</div>
</body>
</html>