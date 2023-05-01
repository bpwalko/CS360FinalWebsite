<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Session;

function displayFunctionCS()
{
	$userID = getUserID();
	$infoColumns = getInfoColumns();
	$numFamily = getVarFromUser($userID, 'numFamily');
	$serviceColumns = getServiceColumns(getVendType());
	$max_index = count($serviceColumns);

	$sugHotSpot='NO';
	if ($numFamily > 2)
	{
		$sugHotSpot='YES';
	}

	$sugRoaming=$numFamily * 2;
	$sugPrice = $numFamily * 15 + 5;

	$roaming = $serviceColumns[4];
	$hotspot = $serviceColumns[5];
	$textnTalk = $serviceColumns[6];
	$price = $serviceColumns[7];
	$provider = $serviceColumns[2];

	echo "<p style = 'font-size: 16px'> Recommended Values: <br>HotSpot: $sugHotSpot; Roaming Data >= $sugRoaming Gigs;" . "<br>" . "text_n_talk = Unlimited; Price <= $$sugPrice </p> <br>";
	$sqlRec = "SELECT * FROM cell_services WHERE roamingData >= '" . $sugRoaming . "' AND price <= '" . $sugPrice . "' AND text_n_talk='unlimited' AND hotspot='" . $sugHotSpot . "'";

	$resultRec = DB::select($sqlRec);
	echo "<table border='2'  margin-left='1px 1px' align=center style='padding-right:20px; border-style:solid; font-size:13px;'>";
	echo "<p style = 'font-size: 16px'> Plans Matching Recommended Values: </p>";
	echo "<tr> <th style='padding:5px'>Business</th><th style='padding:5px'>Roaming Data</th><th style='padding:5px'>Hot Spot</th><th style='padding:5px'>Price</th><th style='padding:5px'>Text & Talk</th><th style='padding:5px'>Details</th></tr>";
	foreach($resultRec as $row)
	{
		echo "<tr>";
		for ($i=2; $i < $max_index - 1; $i++)
		{
			if($i != 3)
			{
				echo "<td>";
				$temp = $serviceColumns[$i];
				echo $row->$temp . " ";
				echo "</td>";
			}
		}
		echo "<td data-bs-toggle='modal' data-bs-target='#userModal'> ";
		echo "<p style='text-decoration:none; color:#e1ad01; font-size: 10px;'> <br>More<br>Details </p>";
		echo "<div class='modal fade' id='userModal'>";
		echo "<div class='modal-dialog'>";
			echo "<div class='modal-content'>";
				// Modal Header
				echo "<div class='modal-header'>";
					echo "<h4 style='text-align:center; color:black;' class='modal-title'>" . $row->$provider . "'s Plan </h4>";
					echo "<button type='button' class='btn-close' data-bs-dismiss='modal'></button>";
				echo "</div>";
				// Modal body 
					echo "<div class='modal-body'>";
					echo "<p style='font-size:16px; color:black;'> Gigabytes of Roaming Data: " . $row->$roaming . " </p>";
				echo "<p style='font-size:16px; color:black;'> Does this plan come with a mobile hotspot? " . $row->$hotspot . " </p>";
				echo "<p style='font-size:16px; color:black;'> Gigabytes of Text and Talk Data: " . $row->$textnTalk . " </p>";
				echo "<p style='font-size:16px; color:black;'> Price per month: " . $row->$price . " </p>";
				echo "<a href='addService.php?id=" . $row->csID . "&user=" . getUserID() . "&vend=" . getVendType() ."' style='text-decoration:none; color:#e1ad01;'>Remove</a>";
					echo "</div>";
				echo "</div>";
				echo "</div>";
		echo "</td>";
		echo "</tr>";
	} 

	//}
	echo "</table>";
}

function displayFunctionIS()
{
	$userID = getUserID();
	$infoColumns = getInfoColumns();

	$remote = getVarFromUser($userID, 'remoteArea');
	$deviceNum = getVarFromUser($userID, 'simulInt');
	$speedVAff = getVarFromUser($userID, 'speedVAff');
	$intense = getVarFromUser($userID, 'videoGaming');

	if($remote='Yes')
	{
		$ISPType='Satellite';
		$priceMod = 1.7;
		$speedMod = .5;
	}
	else if($speedVAff='Spe')
	{
		$ISPType='Fiber';
		$priceMod = 1.25;
		$speedMod = 3;
	}
	else
	{
		$ISPType='Cable';
		$priceMod = 1;
		$speedMod = 1;
	}

	if($intense='Yes')
	{
		$intenseMod = 1;
	}
	else
	{
		$intenseMod = .3;
	}

	$download=$deviceNum * 30 * $intenseMod * $speedMod;
	$upload=$deviceNum * 5 * $intenseMod * $speedMod;

	$price=(51 * $intenseMod * $priceMod) + (3 * $deviceNum * $intenseMod);

	$table = getVendType();
	$serviceColumns = getServiceColumns(getVendType());
	$max_index = count($serviceColumns);


	$roaming = $serviceColumns[4];
	$hotspot = $serviceColumns[5];
	$textnTalk = $serviceColumns[6];
	$price2 = $serviceColumns[7];
	$provider = $serviceColumns[2];



	echo "<p style = 'font-size: 16px'> Recommended Values: <br>Download >= $download mbps; Upload >= $upload mbps;" . "<br>" . "Price <= $$price; Type = $ISPType</p> <br>";
	$sqlRec = "SELECT * FROM $table WHERE downloadSpeed >= '" . $download . "' AND price <= '" . $price . "' AND type='" . $ISPType . "' AND uploadSpeed='" . $upload . "'";

	$resultRec = DB::select($sqlRec);
	echo "<table border='2'  margin-left='1px 1px' align=center style='padding-right:20px; border-style:solid; font-size:13px;'>";
	echo "<p style = 'font-size: 16px'> Plans Matching Recommended Values: </p>";
	echo "<tr> <th style='padding:5px'>Type</th><th style='padding:5px'>Download</th><th style='padding:5px'>Upload</th><th style='padding:5px'>Price</th></th><th style='padding:5px'>Details</th></tr>";
	foreach($resultRec as $row)
	{
		echo "<tr>";
		for ($i=2; $i < $max_index - 1; $i++)
		{
			if($i != 3)
			{
				echo "<td>";
				$temp = $serviceColumns[$i];
				echo $row->$temp . " ";
				echo "</td>";
			}
		}
		echo "<td data-bs-toggle='modal' data-bs-target='#userModal'> ";
		echo "<p style='text-decoration:none; color:#e1ad01; font-size: 10px;'> <br>More<br>Details </p>";
		echo "<div class='modal fade' id='userModal'>";
		echo "<div class='modal-dialog'>";
			echo "<div class='modal-content'>";
				// Modal Header
				echo "<div class='modal-header'>";
					echo "<h4 style='text-align:center; color:black;' class='modal-title'>" . $row->$provider . "'s Plan </h4>";
					echo "<button type='button' class='btn-close' data-bs-dismiss='modal'></button>";
				echo "</div>";
				// Modal body 
					echo "<div class='modal-body'>";
					echo "<p style='font-size:16px; color:black;'> Gigabytes of Roaming Data: " . $row->$roaming . " </p>";
				echo "<p style='font-size:16px; color:black;'> Does this plan come with a mobile hotspot? " . $row->$hotspot . " </p>";
				echo "<p style='font-size:16px; color:black;'> Gigabytes of Text and Talk Data: " . $row->$textnTalk . " </p>";
				echo "<p style='font-size:16px; color:black;'> Price per month: " . $row->$price2 . " </p>";
				echo "<a href='addService.php?id=" . $row->csID . "&user=" . getUserID() . "&vend=" . getVendType() ."' style='text-decoration:none; color:#e1ad01;'>Remove</a>";
					echo "</div>";
				echo "</div>";
				echo "</div>";
		echo "</td>";
		echo "</tr>";
	} 

	//}
	echo "</table>";
}

function getVarFromUser($userID, $var)
{
	$sqlVar = "SELECT " . $var . " FROM userInfo WHERE userID='" . $userID . "'";
	$result2 = DB::select($sqlVar);
	foreach($result2 as $row)
	{
		$resultVar = $row->$var;
	}
	return $resultVar;
}

function getInfoColumns()
{
	$columns = array();
	$sql2 = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='myhome' AND `TABLE_NAME`='userInfo'";
	$result2 = DB::select($sql2);
	foreach($result2 as $row)
	{
		array_push($columns, $row->COLUMN_NAME);
	}
	return $columns;
}

function getServiceColumns($vendtype)
{
	$columns = array();
	$sql2 = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='myhome' AND `TABLE_NAME`='$vendtype'";
	$result2 = DB::select($sql2);
	foreach($result2 as $row)
	{
		array_push($columns, $row->COLUMN_NAME);
	}
	return $columns;
}

function getUserID()
	{
		$sqlID = "SELECT userID FROM users WHERE firstname='" . session('firstname') . "'";
		$resultID = DB::select($sqlID);
		foreach($resultID as $row)
		{
			//echo $row->userID . "<br>";
			$userID = $row->userID;
		} 
		return $userID;
	}


function getVendType()
{
	$searchFor = $_GET['searchFor'];
	if($searchFor=='CS')
	{
		return 'cell_services';
	}
	if($searchFor=='IS')
	{
		return 'internet_services';
	}
}

function addService()
	{
			
		$userID = getUserID();
		$vendType = getVendType();

		$columns = getServiceColumns($vendtype);
				
		$values = "'" . $userID . "', '" . $vendtype . "', '" . $serviceID . "',";
		$create_datetime = date("Y-m-d H:i:s");
		$values = " (" . $values . " '" . $create_datetime . "')";
		$fields = "(userID, vendType, serviceID, create_datetime)";
		$query    = "INSERT into services $fields  VALUES $values";
		$resultService   = mysqli_query($con, $query);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>MyHome - User Hub</title>
	<script type ="text/javascript">

function search_service() {

let input = document.getElementById('searchbar').value;

if(input == "Cell"){
window.location.href = "../searchHub";
}

}

function SelectRedirectCS()
{
    window.location.href = "../userHub?searchFor=CS";
}

function SelectRedirectIS(){
window.location.href = "../userHub?searchFor=IS";
}

function SelectRedirectHS(){
window.location.href = "../userHub?searchFor=HS";
}

function SelectRedirectAI(){
window.location.href = "../userHub?searchFor=AI";
}

function SelectRedirectHI(){
window.location.href = "../userHub?searchFor=HI";
}

function SelectRedirectHOI(){
window.location.href = "../userHub?searchFor=HOI";
}

function SelectRedirectLC(){
window.location.href = "../userHub?searchFor=LC";
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
  font-size: 21px;
  font-weight: bold;
}
td {
  margin: 0px 5px;
  padding: 0px auto;
}
th {
  margin: 0px 5px;
  padding: 0px auto;
}
input[type=text]:focus {
  border-color: #8c5020;
}
input[type=password]:focus {
  border-color: #8c5020;
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
<?php

	if(isset($_POST['submit']))
	{
		$userID = getUserID();

		$table_choice=$_POST['vendType'];
		$priceFloor=stripslashes($_REQUEST['priceFloor']);
		$priceFloor=mysqli_real_escape_string($con, $priceFloor);
		$priceCeiling=stripslashes($_REQUEST['priceCeiling']);
		$priceCeiling=mysqli_real_escape_string($con, $priceCeiling);
		$create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into needs (userID, service_type, priceFloor, priceCeiling, time_created)
                     	VALUES ('$userID', '$table_choice', '$priceFloor', '$priceCeiling', ' $create_datetime')";
		$resultID   = mysqli_query($con, $query);
	}
    //{{ ucfirst(Auth()-> user()->firstname) }} 
?>
<body style="margin-top: 12px; background-image: url('wood.jpeg');">
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
		<div class = "container-fluid" style="">
		<div class = "row" style="margin: 15px auto; border-radius:15px; padding: 15px 10px; border-style: solid; border-color: black; text-align:center; background-color:white;">
		<h3>Welcome to MyHome 
        {{ session('firstname')}}
		What would you like to do? </h3>
		</div>
		<?php
		//if (session()->missing('users')) {
		//	echo "Oh no";
		//}
		?>
		<div class = "row" style="">
		<div class = "col form" style="margin:0px 10px;">
			<p style="">Your Current Services:</p><br>
			<table style="text-align:left; width: 100%;">
  			<tr style="text-align:left;">
   			 	<th>Company</th>
    				<th>Type</th> 
    				<th>Price</th>
  			</tr>
  			<tr>
    				<td>#</td>
    				<td>#</td> 
    				<td>#</td>
  			</tr>
  			<tr>
    				<td>#</td>
    				<td>#</td> 
    				<td>#</td>
  			</tr>
			</table>
		</div>
		<div class = "col form" style="text-align: left; margin:0px 10px">
		<form method="post" name="vendType">
			<p style="text-align:center;">Request Different Utilities</p>
        	<input type="radio" id="healthVendor" name="vendType" value="Health Insurance" onClick ="SelectRedirectHI();">
            @csrf
			<label for="healthVendor" style = "font-size: 1.1vw;"> Health Insurance</label><br>
			<input type="radio" id="homeVendor" name="vendType" value="Home Insurance" onClick ="SelectRedirectHOI();">
			<label for="homeVendor" style = "font-size: 1.1vw;"> Homeowner's Insurance</label><br>
			<input type="radio" id="autoVendor" name="vendType" value="Auto Insurance" onClick ="SelectRedirectAI();">
			<label for="autoVendor" style = "font-size: 1.1vw;"> Automobile Insurance</label><br>
			<input type="radio" id="intVendor" name="vendType" value="internet_services" onClick ="SelectRedirectIS();">
			<label for="intVendor" style = "font-size: 1.1vw;"> Internet Service</label><br>
			<input type="radio" id="cellVendor" name="vendType" value="cell_services" onClick ="SelectRedirectCS()">
			<label for="cellVendor" style = "font-size: 1.1vw;"> Cell Service</label><br>
			<input type="radio" id="lawnVendor" name="vendType" value="Lawncare" onClick ="SelectRedirectLC();">
			<label for="lawnVendor" style = "font-size: 1.1vw;"> Lawncare</label><br>
			<input type="radio" id="houseVendor" name="vendType" value="Housekeeping" onClick ="SelectRedirectHS();">
			<label for="houseVendor" style = "font-size: 1.1vw;"> Housekeeping</label><br>
			<!--<label for="priceFloor" text="Price Floor"> Price Floor </label><br>
			<input type="text" id="priceFloor" name="priceFloor" placeholder="Price Floor" > <br>
			<label for="priceCeiling" text="Price Ceiling">Price Ceiling </label><br>
			<input type="text" id="priceCeiling" name="priceCeiling" placeholder="Price Ceiling"> <br> <br>-->
			<div class="row" style="margin: 0px 15px;">
			<!--<input type="submit" style="; margin:0px 0px; padding: 5px 10px; color: black; border-color: black; color: white; background-color:#8c5020; border-radius:10px; border-style:solid; border-width:3px;" value="Submit" name="submit" class="login-button" href='userHub.php'/>-->
			</div>
		</form>
		</div>
		<div class = "col form" style="margin:0px 10px">
			<p style="">Recommended Services:</p><br>
			<?php
			if(isset($_GET['searchFor']))
			{
				$searchFor = $_GET['searchFor'];
				if($searchFor=='CS')
				{
					displayFunctionCS();
				}
				if($searchFor=='IS')
				{
					displayFunctionIS();
				}
			}
		
		?>
  		</div>	
		</div>
		</div>	
		</div>
		<!--<div class="row" style="text-align:center; background-color: white; border-radius:10px; border-style:solid; margin: 10px auto; width: 99%;">
			<a style="text-decoration:none; color:black;" href="{{url('logout') }}">Logout</a>
		</div> -->
</body>
</html>