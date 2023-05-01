<?php
//include auth_session.php file on all user panel pages
//include("auth_session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>MyHome - Update Information</title>
	<script language="javascript">
		function search_service() {
    			let input = document.getElementById('searchbar').value;
			if(input == "Cell"){
				window.location.href = "../MyHome/searchHub.php";
			}
			
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
p {
  font-size: 18px;
}
input[type=text]:focus {
  border-color: #8c5020;
}
input[type=password]:focus {
  border-color: #8c5020;
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
.form-control {
padding: 5px; 
border-style:solid; 
border-color:black;
border-width: 3px;
}

</style>
<body style="margin-top: 12px; background-image:url({{url('images/wood.jpeg')}})">

<?php
    
    if (isset($_REQUEST['address'])) {

		if (session()->missing('firstname'))
		{
			header("Location: login");
		}

		//echo "wow";

		$sqlID = "SELECT userID FROM users WHERE firstname='" . session('firstname') . "'";
		$resultID = DB::select($sqlID);
		foreach($resultID as $row)
		{
			//echo $row['userID']. "<br>";
			$userID = $row ->userID;
		} 
		$address = stripslashes($_REQUEST['address']);
        //$address    = mysqli_real_escape_string($con, $address);
		$numBedrooms = stripslashes($_REQUEST['numBedrooms']);
        //$numBedrooms    = mysqli_real_escape_string($con, $numBedrooms);
		$numBathrooms = stripslashes($_REQUEST['numBathrooms']);
        //$numBathrooms    = mysqli_real_escape_string($con, $numBathrooms);
		$numFloors = stripslashes($_REQUEST['numFloors']);
        //$numFloors = mysqli_real_escape_string($con, $numFloors);
		$squareFootage = stripslashes($_REQUEST['squareFootage']);
        //$squareFootage = mysqli_real_escape_string($con, $squareFootage);
		$age = stripslashes($_REQUEST['age']);
        //$constType = mysqli_real_escape_string($con, $constType);
		$lawnFootage = stripslashes($_REQUEST['lawnFootage']);
        //$lawnFootage = mysqli_real_escape_string($con, $lawnFootage);
		$state = stripslashes($_REQUEST['state']);
        //$foundType = mysqli_real_escape_string($con, $foundType);
		$numFamily = stripslashes($_REQUEST['numFamily']);
        //$numFamily = mysqli_real_escape_string($con, $numFamily);	
		$monIncome = stripslashes($_REQUEST['monIncome']);
		$mortgage = stripslashes($_REQUEST['mortgage']);
		$numCellDevices = stripslashes($_REQUEST['numCellDevices']);
		$numMinutes = stripslashes($_REQUEST['numMinutes']);
		$hotspot = stripslashes($_REQUEST['hotspot']);
		$intCalling = stripslashes($_REQUEST['intCalling']);	
		$specialists = stripslashes($_REQUEST['specialists']);
		$careProvNotInNet = stripslashes($_REQUEST['careProvNotInNet']);
		$freqCosts = stripslashes($_REQUEST['freqCosts']);
		$genHealthy = stripslashes($_REQUEST['genHealthy']);
		$emergencyOnly = stripslashes($_REQUEST['emergencyOnly']);
		$floods = stripslashes($_REQUEST['floods']);
		$earthquakes = stripslashes($_REQUEST['earthquakes']);
		$hurricanes = stripslashes($_REQUEST['hurricanes']);
		$liabilityOnly = stripslashes($_REQUEST['liabilityOnly']);
		$remoteArea = stripslashes($_REQUEST['remoteArea']);
		$speedVAff = stripslashes($_REQUEST['speedVAff']);
		$simulInt = stripslashes($_REQUEST['simulInt']);
		$videoGaming = stripslashes($_REQUEST['videoGaming']);
		$onlyMowed = stripslashes($_REQUEST['onlyMowed']);
		$aerate = stripslashes($_REQUEST['aerate']);
		$weeded = stripslashes($_REQUEST['weeded']);
		$deadGrass = stripslashes($_REQUEST['deadGrass']);
		$pool = stripslashes($_REQUEST['pool']);
		$pests = stripslashes($_REQUEST['pests']);
		$meals = stripslashes($_REQUEST['meals']);
		$windowPolish = stripslashes($_REQUEST['windowPolish']);
		$laundry = stripslashes($_REQUEST['laundry']);
		$deepClean = stripslashes($_REQUEST['deepClean']);
		$replaceCar = stripslashes($_REQUEST['replaceCar']);


        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `userInfo` (userID, address, numBedrooms, numBathrooms, numFloors, squareFootage, age, lawnFootage, state, numFamily, monIncome, mortgage, numCellDevices, numMinutes, hotspot, intCalling, specialists, careProvNotInNet, freqCosts, genHealthy, emergencyOnly, floods, earthquakes, hurricanes, liabilityOnly, remoteArea, speedVAff, simulInt, videoGaming, onlyMowed, aerate, weeded, deadGrass, pool, pests, meals, windowPolish, laundry, deepClean, replaceCar, create_datetime)
                     	VALUES ('$userID', '$address', '$numBedrooms', '$numBathrooms', '$numFloors', '$squareFootage', '$age', '$lawnFootage', '$state', '$numFamily', '$monIncome', '$mortgage', '$numCellDevices', '$numMinutes', '$hotspot', '$intCalling', '$specialists', '$careProvNotInNet', '$freqCosts', '$genHealthy', '$emergencyOnly', '$floods', '$earthquakes', '$hurricanes', '$liabilityOnly', '$remoteArea', '$speedVAff', '$simulInt', '$videoGaming', '$onlyMowed', '$aerate', '$weeded', '$deadGrass', '$pool', '$pests', '$meals', '$windowPolish', '$laundry', '$deepClean', '$replaceCar', '$create_datetime')";
		//echo $query;
		DB::delete("DELETE FROM userinfo WHERE userID=$userID");
		$result = DB::insert($query);
	if ($result) {
		header("Location: update.php");
        	//echo "<div class='container-fluid form' style='width:98%, height:50%'>
             	//<h3>Success!</h3><br/>
                //<p class='link'>Click <a href='update.php'>here</a> to continue</p>
                //</div>";
        } else {
            	echo "<div class='container fluid'>
                  <h3>Required fields are missing. Asterisk Denotes Required Fields</h3><br/>
                  </div>";
        }
    } 	
    else {
}?>
<div class="container-fluid">
<?php
if (session()->missing('firstname'))
{
	return redirect()->route('login');
    //header("Location: login");
}
else
{
	include(app_path().'/includes/headerLoggedIn.php');
}
?>
		<div class = "container-fluid" style="">
		<div class = "row" style="margin: 15px auto; border-radius:15px; padding: 15px 10px; border-style: solid; border-color: black; text-align:center; background-color:white;">
		<h3>Complete this form to update your home information:</h3>
		</div>
		<form method="post" name="update">
		@csrf
		<?php
		
			$sqlID = "SELECT userID FROM users WHERE firstname='" . session('firstname') . "'";
			//echo $sqlID;
			$sqlInfo = "";
			$resultID = DB::select($sqlID);
			foreach($resultID as $row)
			{
				//echo $row->userID . "<br>";
				$userID = $row->userID;
				$sqlInfo = "SELECT * FROM UserInfo WHERE userID = '" . $row->userID . "'";
			}
			//echo $sqlInfo;
			if ($sqlInfo != "")
			{
				//echo $sqlInfo;
				$resultInfo = DB::select($sqlInfo);
			}
			if ($sqlInfo != "" && $resultInfo != NULL) {
  			// output data of each row
  			foreach($resultInfo as $row) {
			echo "<div class = 'row' style=''>";
			echo "<div class = 'col form' style='margin:0px 10px'>";
			echo "<p style = 'font-size: 1.7vw;'><b>Home Information:</b></p>";	
			echo "<div class = 'row' style=''>";
			echo "<div class = 'col' style='margin:0px 10px'>";
				echo "<div class='form-group'>";
        				echo "<p style = 'font-size: 1.5vw;'> Home Address: </p>";
        				echo "<input type='text' class='form-control' required style='font-size:1vw;' name='address' placeholder='" . $row->address . "' autofocus='true'/><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Number of Bedrooms: </p>";
        				echo "<input type='number' min='1' max='20' required class='form-control' style='font-size:1vw;' name='numBedrooms' placeholder='" . $row->numBedrooms . "'/><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Number of Bathrooms: </p>";
        				echo "<input type='number' min='1' max='20' required class='form-control' style='font-size:1vw;' name='numBathrooms' placeholder='" . $row->numBathrooms . "'/><br>";
				echo "</div>";
			echo "</div>";
			echo "<div class = 'col' style='margin:0px 10px'>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Number of Floors: </p>";
        				echo "<input type='number' min='1' max='10' required class='form-control' style='font-size:1vw;' name='numFloors' placeholder='" . $row->numFloors . "'/><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Square Footage: </p>";
        				echo "<input type='number' min='1' max='100000' required class='form-control' style='font-size:1vw;' name='squareFootage' placeholder='" . $row->squareFootage . "'/><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Your Age: </p>";
					echo "<input type='number' min='18' max = '30' class='form-control' required style='font-size:1vw;' name='age' placeholder='" . $row->age . "'/><br>";
				echo "</div>";
			echo "</div>";
			echo "<div class = 'col' style='margin:0px 10px'>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Lawn Footage: </p>";
					echo "<input type='number' min='1' max='100000' required class='form-control' style='font-size:1vw;' name='lawnFootage' placeholder='" . $row->lawnFootage . "'/><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> State of Residence: </p>";
					echo "<input type='text' class='form-control' required style='font-size:1vw;' name='state' placeholder='" . $row->state . "'/><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Number of Residents: </p>";
        				echo "<input type='number' min='1' max='30' required class='form-control' style='font-size:1vw;' name='numFamily' placeholder='" . $row->numFamily . "'/><br>";
				echo "</div>";
			echo "</div>";
			echo "<div class = 'col' style='margin:0px 10px'>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Monthy Family Income: </p>";
					echo "<input type='number' min='1' max='10000000' required class='form-control' style='font-size:1vw;' name='monIncome' placeholder='" . $row->monIncome . "'/><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Monthly Mortgage: </p>";
        				echo "<input type='number' min='1' max='100000' required class='form-control' style='font-size:1vw;' name='mortgage' placeholder='" . $row->mortgage . "'/><br>";
				echo "</div>";
				echo "<div>";
				echo "<br>";
				echo "<br>";
				echo "<h4 style = 'font-size: 19px;'> (This Form Continues Below) </h4>";
				echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "<br>";
			echo "<div class = 'row' style=''>";
			echo "<div class = 'col form' style='margin:0px 10px'>";
			echo "<p style = 'font-size: 1.7vw;'><b>Cellular Device Information:</b></p>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Number of Devices Using Data: </p>";
        				echo "<input type='number' min='1' max='20' class='form-control' required style='font-size:1vw;' name='numCellDevices' placeholder='" . $row->numCellDevices . "' autofocus='true'/><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Number of Minutes Desired: </p>";
        				echo "<input type='text' class='form-control' required style='font-size:1vw;' name='numMinutes' placeholder='" . $row->numMinutes . "' autofocus='true'/><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Would you like a Hotspot? </p>";
        				echo "<input type='text' class='form-control' required style='font-size:1vw;' name='hotspot' placeholder='" . $row->hotspot . "' autofocus='true'/><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Will You be Calling Internationally? </p>";
        				echo "<input type='text' class='form-control' required style='font-size:1vw;' name='intCalling' placeholder='" . $row->intCalling . "' autofocus='true'/><br>";
				echo "</div>";
			echo "</div>";
			echo "<div class = 'col form' style='margin:0px 10px'>";
        		echo "<p style = 'font-size: 1.7vw;'><b>Health Insurance Information:</b></p>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Require the Freedom to Choose Specialists Without a Referral? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='specialists' id='specialists' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Require the Ability to View Care Providers not Included in Your Provider's Network?: </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='careProvNotInNet' id='careProvNotInNet' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Would you Like Insurance That Will Cover You Only in an Emergency? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='emergencyOnly' id='emergencyOnly' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Do You Have a Condition or Illness that has Frequent Recurring Costs? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='freqCosts' id='freqCosts' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>"; 
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Are you Generally Healthy? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='genHealthy' id='genHealthy' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
  			echo "</div>";	
			echo "<div class = 'col form' style='margin:0px 10px'>";
        		echo "<p style = 'font-size: 1.7vw;'><b>Homeowner's Insurance:</b></p>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Do you live somewhere floods may occur? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='floods' id='floods' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Do you live somewhere earthquakes may occur? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='earthquakes' id='earthquakes' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Do you live somewhere hurricanes may occur? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='hurricanes' id='hurricanes' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Would You Prefer Home Replacement or Liability Only? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='liabilityOnly' id='liabilityOnly' autofocus='true'/>";
					echo "<option value='Replacement'>Replacement</option><option value='Liability'>Liability</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
  			echo "</div>";	
			echo "</div>";
			echo "<br>";
			echo "<div class = 'row' style=''>";
			echo "<div class = 'col form' style='margin:0px 10px'>";
			echo "<p style = 'font-size: 1.7vw;'><b>Internet Service Information:</b></p>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Do You Live in a Remote Area With no Cable or Fiber Optic Internet? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='remoteArea' id='remoteArea' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Is Speed or Affordability Your Main Concern? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='speedVAff' id='speedVAff' autofocus='true'/>";
					echo "<option value='Speed'>Speed</option><option value='Affordability'>Affordability</option>";
					echo "</select>";
					echo"<br><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> How Many Devices Will be Using The Internet Simultaneously? </p>";
					echo "<input type='text' class='form-control' required style='font-size:1vw;' name='simulInt' placeholder='" . $row->simulInt . "' autofocus='true'/><br><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Will You Be Streaming Video and/or Gaming? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='videoGaming' id='videoGaming' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
				echo "</div>";
			echo "</div>";
			echo "<div class = 'col form' style='margin:0px 10px'>";
        		echo "<p style = 'font-size: 1.7vw;'><b>Lawncare Information:</b></p>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Do You Need Your Lawn Mowed and Nothing Else? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='onlyMowed' id='onlyMowed' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Will You Aerate Your Lawn?: </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='aerate' id='aerate' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Do You Have a Garden That Will Need to be Weeded? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='weeded' id='weeded' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Does Your Lawn Have Numerous Patches of Dead or Missing Grass? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='deadGrass' id='deadGrass' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>"; 
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Do You Own a Pool? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='pool' id='pool' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Are You Plagued by Pests? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='pests' id='pests' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
  			echo "</div>";	
			echo "<div class = 'col form' style='margin:0px 10px'>";
        		echo "<p style = 'font-size: 1.7vw;'><b>Housekeeping Information:</b></p>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Will You Expect Your Housekeeper to Prepare Meals? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='meals' id='meals' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br><br><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Do You Expect Interior Windows to be Polished? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='windowPolish' id='windowPolish' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br><br><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Will You Expect Your Housekeeper to do Laundry and Ironing? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='laundry' id='laundry' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br><br><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Does Your House Need Deep Cleaning? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='deepClean' id='deepClean' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
  			echo "</div>";	
			echo "</div>";
			echo "<br>";
			echo "<div class = 'row' style='margin: 10px auto;'>";
			echo "<div class = 'col' style='margin:0px 10px'>";
			echo "</div>";
			echo "<div class = 'col form' style='margin:0px 10px'>";
        		echo "<p style = 'font-size: 1.7vw;'><b>Auto Insurance Information:</b></p>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Do You Own a Vehicle That Would be Expensive to Replace? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='replaceCar' id='replaceCar' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br><br>";
				echo "</div>";
				echo "<input type='submit' style='padding: 5px 10px; color: white; background-color:#8c5020; border-radius:10px; border-style:solid; border-color:black;' value='Confirm All Entries'  class='btn login-button' value='Confirm New Entries' name='submit'/><br><br>";
			echo "</div>";
			echo "<div class = 'col' style='margin:0px 10px'>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
		break;
		}
		} 
		else{ 
			echo "<div class = 'row' style=''>";
			echo "<div class = 'col form' style='margin:0px 10px'>";
			echo "<p style = 'font-size: 1.7vw;'><b>Home Information:</b></p>";	
			echo "<div class = 'row' style=''>";
			echo "<div class = 'col' style='margin:0px 10px'>";
				echo "<div class='form-group'>";
        				echo "<p style = 'font-size: 1.5vw;'> Home Address: </p>";
        				echo "<input type='text' class='form-control' required style='font-size:1vw;' name='address' placeholder='Address' autofocus='true'/><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Number of Bedrooms: </p>";
        				echo "<input type='number' min='1' max='20' required class='form-control' style='font-size:1vw;' name='numBedrooms' placeholder='Bedrooms (Max 20)'/><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Number of Bathrooms: </p>";
        				echo "<input type='number' min='1' max='20' required class='form-control' style='font-size:1vw;' name='numBathrooms' placeholder='Bathrooms (Max 20)'/><br>";
				echo "</div>";
			echo "</div>";
			echo "<div class = 'col' style='margin:0px 10px'>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Number of Floors: </p>";
        				echo "<input type='number' min='1' max='10' required class='form-control' style='font-size:1vw;' name='numFloors' placeholder='Floors (Max 10)'/><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Square Footage: </p>";
        				echo "<input type='number' min='1' max='100000' required class='form-control' style='font-size:1vw;' name='squareFootage' placeholder='Square Feet (Max 10000)'/><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Your Age: </p>";
					echo "<input type='number' min = '1' max = '110' class='form-control' required style='font-size:1vw;' name='age' placeholder='Your Age (Max 110)'/><br>";
				echo "</div>";
			echo "</div>";
			echo "<div class = 'col' style='margin:0px 10px'>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Lawn Footage: </p>";
					echo "<input type='number' min='1' max='100000' required class='form-control' style='font-size:1vw;' name='lawnFootage' placeholder='Lawn Footage (Max 10000)'/><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> State of Residence: </p>";
					echo "<input type='text' class='form-control' required style='font-size:1vw;' name='state' placeholder='Your State of Residence'/><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Number of Residents: </p>";
        				echo "<input type='number' min='1' max='30' required class='form-control' style='font-size:1vw;' name='numFamily' placeholder='Residents (Max 30)'/><br>";
				echo "</div>";
			echo "</div>";
			echo "<div class = 'col' style='margin:0px 10px'>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Monthy Family Income: </p>";
					echo "<input type='number' min='1' max='10000000' required class='form-control' style='font-size:1vw;' name='monIncome' placeholder='Monthly Income (Max 10000000)'/><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Monthly Mortgage: </p>";
        				echo "<input type='number' min='1' max='10000000' required class='form-control' style='font-size:1vw;' name='mortgage' placeholder='Mortgage (Max 10000000)'/><br>";
				echo "</div>";
				echo "<div>";
				echo "<br>";
				echo "<br>";
				echo "<h4 style = 'font-size: 19px;'> (This Form Continues Below) </h4>";
				echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "<br>";
			echo "<div class = 'row' style=''>";
			echo "<div class = 'col form' style='margin:0px 10px'>";
			echo "<p style = 'font-size: 1.7vw;'><b>Cellular Device Information:</b></p>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Number of Devices Using Data: </p>";
        				echo "<input type='number' min='1' max='20' class='form-control' required style='font-size:1vw;' name='numCellDevices' placeholder='Cellular Devices (Max 20)' autofocus='true'/><br><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Number of Minutes Desired: </p>";
        				echo "<input type='text'  class='form-control' required style='font-size:1vw;' name='numMinutes' placeholder='Number of Minutes' autofocus='true'/><br><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Would you like a Hotspot? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='hotspot' id='hotspot' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Will You be Calling Internationally? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='intCalling' id='intCalling' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
				echo "</div>";
			echo "</div>";
			echo "<div class = 'col form' style='margin:0px 10px'>";
        		echo "<p style = 'font-size: 1.7vw;'><b>Health Insurance Information:</b></p>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Require the Freedom to Choose Specialists Without a Referral? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='specialists' id='specialists' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Require the Ability to View Care Providers not Included in Your Provider's Network?: </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='careProvNotInNet' id='careProvNotInNet' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Would you Like Insurance That Will Cover You Only in an Emergency? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='emergencyOnly' id='emergencyOnly' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Do You Have a Condition or Illness that has Frequent Recurring Costs? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='freqCosts' id='freqCosts' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>"; 
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Are you Generally Healthy? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='genHealthy' id='genHealthy' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
  			echo "</div>";	
			echo "<div class = 'col form' style='margin:0px 10px'>";
        		echo "<p style = 'font-size: 1.7vw;'><b>Homeowner's Insurance:</b></p>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Do you live somewhere floods may occur? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='floods' id='floods' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Do you live somewhere earthquakes may occur? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='earthquakes' id='earthquakes' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Do you live somewhere hurricanes may occur? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='hurricanes' id='hurricanes' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Would You Prefer Home Replacement or Liability Only? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='liabilityOnly' id='liabilityOnly' autofocus='true'/>";
					echo "<option value='Replacement'>Replacement</option><option value='Liability'>Liability</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
  			echo "</div>";	
			echo "</div>";
			echo "<br>";
			echo "<div class = 'row' style=''>";
			echo "<div class = 'col form' style='margin:0px 10px'>";
			echo "<p style = 'font-size: 1.7vw;'><b>Internet Service Information:</b></p>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Do You Live in a Remote Area With no Cable or Fiber Optic Internet? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='remoteArea' id='remoteArea' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Is Speed or Affordability Your Main Concern? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='speedVAff' id='speedVAff' autofocus='true'/>";
						echo "<option value='Speed'>Speed</option><option value='Affordability'>Affordability</option>";
					echo "</select>";
					echo"<br><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> How Many Devices Will be Using The Internet Simultaneously? </p>";
					echo "<input type='number' min='1' max='50' required class='form-control' style='font-size:1vw;' name='simulInt' placeholder='Devices Connected (Max 50)' autofocus='true'/><br><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.5vw;'> Will You Be Streaming Video and/or Gaming? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='videoGaming' id='videoGaming' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
				echo "</div>";
			echo "</div>";
			echo "<div class = 'col form' style='margin:0px 10px'>";
        		echo "<p style = 'font-size: 1.7vw;'><b>Lawncare Information:</b></p>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Do You Need Your Lawn Mowed and Nothing Else? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='onlyMowed' id='onlyMowed' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Will You Aerate Your Lawn?: </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='aerate' id='aerate' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Do You Have a Garden That Will Need to be Weeded? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='weeded' id='weeded' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Does Your Lawn Have Numerous Patches of Dead or Missing Grass? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='deadGrass' id='deadGrass' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>"; 
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Do You Own a Pool? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='pool' id='pool' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.2vw;'> Are You Plagued by Pests? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='pests' id='pests' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
  			echo "</div>";	
			echo "<div class = 'col form' style='margin:0px 10px'>";
        		echo "<p style = 'font-size: 1.7vw;'><b>Housekeeping Information:</b></p>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Will You Expect Your Housekeeper to Prepare Meals? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='meals' id='meals' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br><br><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Do You Expect Interior Windows to be Polished? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='windowPolish' id='windowPolish' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br><br><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Will You Expect Your Housekeeper to do Laundry and Ironing? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='laundry' id='laundry' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br><br><br>";
				echo "</div>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Does Your House Need Deep Cleaning? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='deepClean' id='deepClean' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br>";
				echo "</div>";
  			echo "</div>";	
			echo "</div>";
			echo "<br>";
			echo "<div class = 'row' style='margin: 10px auto;'>";
			echo "<div class = 'col' style='margin:0px 10px'>";
			//echo "<img src=' . {{ asset('images/house.png') }} . ' alt='A house' style='height: 100%; width: 90%; padding:35px 0px;'>";
			echo "</div>";
			echo "<div class = 'col form' style='margin:0px 10px'>";
        		echo "<p style = 'font-size: 1.7vw;'><b>Auto Insurance Information:</b></p>";
				echo "<div class='form-group'>";
					echo "<p style = 'font-size: 1.3vw;'> Do You Own a Vehicle That Would be Expensive to Replace? </p>";
        				echo "<select class='form-control' required style='font-size:1vw;' name='replaceCar' id='replaceCar' autofocus='true'/>";
					echo "<option value='Yes'>Yes</option><option value='No'>No</option>";
					echo "</select>";
					echo"<br><br>";
				echo "</div>";
				echo "<input type='submit' style='padding: 5px 10px; color: white; background-color:#8c5020; border-radius:10px; border-style:solid; border-color:black;' value='Confirm All Entries'  class='btn login-button' value='Confirm New Entries' name='submit'/><br><br>";
			echo "</div>";
			echo "<div class = 'col' style='margin:0px 10px'>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			
		}
		?>
		</div>	
		</div>
		</form>
</body>
</html>