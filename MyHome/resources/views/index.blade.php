<!DOCTYPE html>
<html lang="en">
<head>

	<script language="javascript">
        function search_service() {
                let input = document.getElementById('searchbar').value;
            if(input == "Cell"){
                window.location.href = "../MyHome/searchHub.php";
            }

        }
    </script>

	<title>MyHome - Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>
	<script>var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {  return new bootstrap.Tooltip(tooltipTriggerEl)})</script>
</head>

<body style="margin-top: 12px; background-image:url({{url('images/wood.jpeg')}})">
<div class="container-fluid">
<?php 
if (session()->missing('firstname'))
{
	include(app_path().'/includes/headerLoggedOut.php');
}
else
{
	include(app_path().'/includes/headerLoggedIn.php');
}
    ?>
	<div class = "container-fluid" style="padding:15px 25px;">
	<div class = "row" style=" background-color: white; border-radius:15px; padding: 15px 10px; border-style: solid; border-color: black">
		<div class = "col" align="center">
			<h1 style = ""> Welcome to MyHome! </h1>
			<h4 style = "color: dark grey"> The one stop shop to find the best utilities for you </h4>
			<br>
			<div class = "row">
			<div class = "col">
				<h3> What we do </h3>
			</div>
			<div class = "col">
				<h3>  </h3>
			</div>
			<div class = "col">
				<h3> How to get started </h3>
			</div>
			</div>
			<br>
			<div class = "row">
			<div class = "col">
				<p> Here at MyHome, we want you to be getting the deals and packages on your home utilities that are the best fit for you. By inputting your home information as well as what your current utilities are and their prices, our handy service and affordability calculators will communicate with vendors to locate and create utility packages that best fit your needs as well as your budget. If you happen to be one of these vendors looking to use this tool, all you need to do to start is head to the <u>Vendor Hub</u> page located at the top of the screen. We hope that this website will help each and every user save money, as well as time finding that perfect utility package.</p>
			</div>
			<div class = "col" style="background-image:url({{url('images/wood.jpeg')}}); border-radius: 10px; border-style:solid;">
				<div style="padding: 10px 10px;"> <<img src="{{URL::asset('images/house.png')}}" alt="A house" style="height: 100%; width: 90%; padding:35px 0px;"> </div>
			</div>
			<div class = "col">
				<p> If you have never used MyHome before, you will need to create an account first by heading to the <u>Sign Up</u> page at the top of the screen. Once you create your account you will be redirected to our <u>Update Information</u> page. This page will have you input your home information (such as number of floors and bathrooms), your current utility prices and providers, your total monthly income from all sources and the cost of any additional monthly expenses your household may have. Once this is done head to the <u>User Hub</u> tab. This page will allow you to pick which utilities you would like to change as well as connect with vendors who can help you make those changes.</p>
			</div>
			</div>
			<br>
   			<div class = "row">
			<div class = "col">
				<h3> . </h3>
			</div>
			<div class = "col">
				<h3> . </h3>
			</div>
			<div class = "col">
				<h3> . </h3>
			</div>
			</div>
			
		</div>
	</div>
</div>
</body>
</html>