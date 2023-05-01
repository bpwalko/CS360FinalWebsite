<!DOCTYPE html>
<html lang="en">
<head ">
	<title>MyHome - Sign Up</title>
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
.form { margin: 10px auto;
    text-align: center;
    width: 600px;
    padding: 30px 30px;
    background: white;
    border-style: solid; 
    border-radius: 15px; 
    border-color: black;
}
</style>
<body style="margin-top: 12px; background-image:url({{url('images/wood.jpeg')}})">

<div class="container-fluid">
<?php include(app_path().'/includes/headerLoggedOut.php');?>
		<div class = "container-fluid" style="padding:0px 0px;">
		<div class = "row" style="">
		@if(Session::has('success'))
        <div class="alert alert-success">
        {{ Session::get('success') }}
        @php
        Session::forget('success');
        @endphp
        </div>
        @endif
		 	<form class="form" action="{{ route('register.post') }}" method="POST">
			@csrf
        		<h1 class="login-title" style="color:black;">Create an Account</h1>
			<h4 style="color:black;">Enter your name and choose a password</h4><br><br>
        		<input type="text" style="padding: 5px; border-style:solid;" name="firstname" placeholder="First Name" autofocus="true" required/><br><br>
			<input type="text" style="padding: 5px; border-style:solid;" name="lastname" placeholder="Last Name" autofocus="true" required/><br><br>
			<input type="text" style="padding: 5px; border-style:solid;" name="email" placeholder="Email" required/><br><br>
			<input type="text" style="padding: 5px; border-style:solid;" name="phoneNum" placeholder="Phone Number" required/><br><br>
        		<input type="password" style="padding: 5px; border-style:solid;" name="password" placeholder="Password" required/><br><br>
        		<input type="submit" style="padding: 5px 10px; color: white; background-color:#8c5020; border-radius:10px; border-style:solid; border-color:black;" value="Confirm" name="submit" class="btn login-button" href='update.php'/><br><br>
        		<p class="link" style="color:#8c5020;"><a style="color:#8c5020;" href='login'>Sign In</a></p>
  			</form>
		</div>
		</div>
</body>
</html>