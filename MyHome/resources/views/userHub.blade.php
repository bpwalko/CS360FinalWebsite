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

	$ID = $serviceColumns[0];
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
	echo "<tr> <th style='padding:5px'>ID</th><th style='padding:5px'>Business</th><th style='padding:5px'>Roaming Data</th><th style='padding:5px'>Hot Spot</th><th style='padding:5px'>Price</th><th style='padding:5px'>Text & Talk</th><th style='padding:5px'>Details</th></tr>";
	foreach($resultRec as $row)
	{
		echo "<tr>";
		for ($i=0; $i < $max_index - 1; $i++)
		{
			if($i != 3 && $i !=1)
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
				echo "<form method = 'post'>";
				?>
					@csrf
				<?php
					echo "<input type='submit' value='Add Service' name='button1' style='text-decoration:none; color:#e1ad01;'></button>";
				echo "</form>";
					echo "</div>";
				echo "</div>";
				echo "</div>";
		echo "</td>";
		echo "</tr>";
	} 

	//}
	echo "</table>";
	echo  '<form name="serviceForm" method="post">';
	?>
		@csrf
	<?php 
	echo '<label for="serviceIDLabel">Enter Service ID to add:</label><br>
	<input type="text" id="serviceInput" name="fname"><br>
	<input type="submit" value="Submit" name="serviceInput">
  </form> ';
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


	$type = $serviceColumns[7];
	$downloadSpeed = $serviceColumns[5];
	$uploadSpeed = $serviceColumns[4];
	$price2 = $serviceColumns[6];
	$provider = $serviceColumns[2];



	echo "<p style = 'font-size: 16px'> Recommended Values: <br>Download >= $download mbps; Upload >= $upload mbps;" . "<br>" . "Price <= $$price; Type = $ISPType</p> <br>";
	$sqlRec = "SELECT * FROM $table WHERE downloadSpeed >= '" . $download . "' AND price <= '" . $price . "' AND type='" . $ISPType . "' AND uploadSpeed>='" . $upload . "'";
	//echo $sqlRec;
	$resultRec = DB::select($sqlRec);
	echo "<table border='2'  margin-left='1px 1px' align=center style='padding-right:20px; border-style:solid; font-size:13px;'>";
	echo "<p style = 'font-size: 16px'> Plans Matching Recommended Values: </p>";
	echo "<tr><th style='padding:5px'>ID</th><th style='padding:5px'>Business</th><th style='padding:5px'>Upload</th><th style='padding:5px'>Download</th><th style='padding:5px'>Price</th></th><th style='padding:5px'>Type</th><th style='padding:5px'>Details</th></tr>";
	foreach($resultRec as $row)
	{
		echo "<tr>";
		for ($i=0; $i < $max_index - 1; $i++)
		{
			if($i != 3 && $i !=1)
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
					echo "<p style='font-size:16px; color:black;'> Type of Internet: " . $row->$type . " </p>";
				echo "<p style='font-size:16px; color:black;'> DownloadSpeed " . $row->$downloadSpeed . " mbps </p>";
				echo "<p style='font-size:16px; color:black;'> Upload Speed: " . $row->$uploadSpeed . " mbps </p>";
				echo "<p style='font-size:16px; color:black;'> Price per month: $" . $row->$price2 . " </p>";
				echo "<a href='addService.php?id=" . $row->isID . "&user=" . getUserID() . "&vend=" . getVendType() ."' style='text-decoration:none; color:#e1ad01;'>Remove</a>";
					echo "</div>";
				echo "</div>";
				echo "</div>";
		echo "</td>";
		echo "</tr>";
	} 

	//}
	echo "</table>";
	echo  '<form name="serviceForm" method="post">';
	?>
		@csrf
	<?php 
	echo '<label for="serviceIDLabel">Enter Service ID to add:</label><br>
	<input type="text" id="serviceInput" name="fname"><br>
	<input type="submit" value="Submit" name="serviceInput">
  </form> ';
}

function displayFunctionHI()
{
	$userID = getUserID();
	$infoColumns = getInfoColumns();

	$specialists = getVarFromUser($userID, 'specialists');
	$outOfNet = getVarFromUser($userID, 'careProvNotInNet');
	$emOnly = getVarFromUser($userID, 'emergencyOnly');
	$freqCost = getVarFromUser($userID, 'freqCosts');
	$genHealth = getVarFromUser($userID, 'genHealthy');
	$age = getVarFromUser($userID, 'age');
	$state = getVarFromUser($userID, 'state');
	$ageMod = getAgeModHI($userID);
	$statePrice = getStateModHI($userID);

	if($emOnly=='Yes')
	{
		$PType='Catastrophic';
		$priceMod = .6;
	}
	else if($specialists=='No')
	{
		$PType='HMO';
		$priceMod = 1;
	}
	else if($outOfNet=='Yes')
	{
		$PType='PPO';
		$priceMod = 1.2;
	}
	else
	{
		$PType=='EPO';
		$priceMod = 1.06;
	}

	if($freqCost=='Yes')
	{
		$planLevel = 'Gold';
		$planMod = 1.26;
	}
	else if($genHealth ='Yes')
	{
		$planLevel = 'Bronze';
		$planMod = .92;
	}
	else
	{
		$planLevel = 'Silver';
		$planMod = 1;
	}

	$price=$statePrice * $ageMod * $priceMod * $planMod;

	$table = getVendType();
	$serviceColumns = getServiceColumns(getVendType());
	$max_index = count($serviceColumns);


	$type = $serviceColumns[4];
	$downloadSpeed = $serviceColumns[5];
	$price2 = $serviceColumns[6];
	$provider = $serviceColumns[2];



	echo "<p style = 'font-size: 16px'> Recommended Values: <br>Type = $PType; Plan Level = $planLevel;" . "<br>" . "Price <= $$price;</p> <br>";
	$sqlRec = "SELECT * FROM $table WHERE Type = '" . $PType . "' AND price <= '" . $price . "' AND PlanLevel='" . $planLevel . "'";
	//echo $sqlRec;
	$resultRec = DB::select($sqlRec);
	echo "<table border='2'  margin-left='1px 1px' align=center style='padding-right:20px; border-style:solid; font-size:13px;'>";
	echo "<p style = 'font-size: 16px'> Plans Matching Recommended Values: </p>";
	echo "<tr><th style='padding:5px'>ID</th><th style='padding:5px'>Business</th><th style='padding:5px'>Type</th><th style='padding:5px'>Plan Level</th><th style='padding:5px'>Price</th><th style='padding:5px'>Details</th></tr>";
	foreach($resultRec as $row)
	{
		echo "<tr>";
		for ($i=0; $i < $max_index - 1; $i++)
		{
			if($i != 3 && $i !=1)
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
					echo "<p style='font-size:16px; color:black;'> Type of Coverage: " . $row->$type . " </p>";
				echo "<p style='font-size:16px; color:black;'> Plan Level " . $row->$downloadSpeed . " mbps </p>";
				echo "<p style='font-size:16px; color:black;'> Price per month: $" . $row->$price2 . " </p>";
				echo "<a href='addService.php?id=" . $row->hiID . "&user=" . getUserID() . "&vend=" . getVendType() ."' style='text-decoration:none; color:#e1ad01;'>Remove</a>";
					echo "</div>";
				echo "</div>";
				echo "</div>";
		echo "</td>";
		echo "</tr>";
	} 

	//}
	echo "</table>";
	echo  '<form name="serviceForm" method="post">';
	?>
		@csrf
	<?php 
	echo '<label for="serviceIDLabel">Enter Service ID to add:</label><br>
	<input type="text" id="serviceInput" name="fname"><br>
	<input type="submit" value="Submit" name="serviceInput">
  </form> ';
}

function displayFunctionAI()
{
	$userID = getUserID();
	$infoColumns = getInfoColumns();

	$replaceCar = getVarFromUser($userID, 'replaceCar');
	$age = getVarFromUser($userID, 'age');
	$state = getVarFromUser($userID, 'state');
	$ageMod = getAgeModAI($userID);
	$stateFull = getStateFullAI($userID);
	$stateLi = getStateLiAI($userID);

	if($replaceCar=='Yes')
	{
		$PType='Liability';
		$price = $stateLi * $ageMod;
	}
	else 
	{
		$PType='Full';
		$price = $stateFull * $ageMod;
	}

	$table = getVendType();
	$serviceColumns = getServiceColumns(getVendType());
	$max_index = count($serviceColumns);


	$type = $serviceColumns[4];
	$price2 = $serviceColumns[5];
	$provider = $serviceColumns[2];



	echo "<p style = 'font-size: 16px'> Recommended Values: <br>Type = $PType; Price <= $$price;</p> <br>";
	$sqlRec = "SELECT * FROM $table WHERE coverageType = '" . $PType . "' AND price <= '" . $price . "'";
	//echo $sqlRec;
	$resultRec = DB::select($sqlRec);
	echo "<table border='2'  margin-left='1px 1px' align=center style='padding-right:20px; border-style:solid; font-size:13px;'>";
	echo "<p style = 'font-size: 16px'> Plans Matching Recommended Values: </p>";
	echo "<tr><th style='padding:5px'>ID</th><th style='padding:5px'>Business</th><th style='padding:5px'>Type</th><th style='padding:5px'>Price</th><th style='padding:5px'>Details</th></tr>";
	foreach($resultRec as $row)
	{
		echo "<tr>";
		for ($i=0; $i < $max_index - 1; $i++)
		{
			if($i != 3 && $i !=1)
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
					echo "<p style='font-size:16px; color:black;'> Type of Coverage: " . $row->$type . " </p>";
				echo "<p style='font-size:16px; color:black;'> Price per month: $" . $row->$price2 . " </p>";
				echo "<a href='addService.php?id=" . $row->aiID . "&user=" . getUserID() . "&vend=" . getVendType() ."' style='text-decoration:none; color:#e1ad01;'>Remove</a>";
					echo "</div>";
				echo "</div>";
				echo "</div>";
		echo "</td>";
		echo "</tr>";
	} 

	//}
	echo "</table>";
	echo  '<form name="serviceForm" method="post">';
	?>
		@csrf
	<?php 
	echo '<label for="serviceIDLabel">Enter Service ID to add:</label><br>
	<input type="text" id="serviceInput" name="fname"><br>
	<input type="submit" value="Submit" name="serviceInput">
  </form> ';
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

function getStateModHI($userID)
{
	$sqlVar = "SELECT state FROM userInfo WHERE userID='" . $userID . "'";
	$result2 = DB::select($sqlVar);
	foreach($result2 as $row)
	{
		$resultVar = $row->state;
	}
	$sqlMod = "SELECT health FROM states WHERE state='" . $resultVar . "'";
	$resultMod = DB::select($sqlMod);
	foreach($resultMod as $row)
	{
		$healthPrice = $row->health;
	}
	return $healthPrice;
}

function getStateFullAI($userID)
{
	$sqlVar = "SELECT state FROM userInfo WHERE userID='" . $userID . "'";
	$result2 = DB::select($sqlVar);
	foreach($result2 as $row)
	{
		$resultVar = $row->state;
	}
	$sqlMod = "SELECT car_full FROM states WHERE state='" . $resultVar . "'";
	$resultMod = DB::select($sqlMod);
	foreach($resultMod as $row)
	{
		$healthPrice = $row->car_full;
	}
	return $healthPrice;
}

function getStateLiAI($userID)
{
	$sqlVar = "SELECT state FROM userInfo WHERE userID='" . $userID . "'";
	$result2 = DB::select($sqlVar);
	foreach($result2 as $row)
	{
		$resultVar = $row->state;
	}
	$sqlMod = "SELECT car_liability FROM states WHERE state='" . $resultVar . "'";
	$resultMod = DB::select($sqlMod);
	foreach($resultMod as $row)
	{
		$healthPrice = $row->car_liability;
	}
	return $healthPrice;
}

function getAgeModHI($userID)
{
	$sqlVar = "SELECT age FROM userInfo WHERE userID='" . $userID . "'";
	$result2 = DB::select($sqlVar);
	foreach($result2 as $row)
	{
		$resultVar = $row->age;
	}
	$sqlAge = "SELECT max(age) FROM age WHERE age<='" . $resultVar . "'";
	$result = DB::select($sqlAge);
	foreach($result as $row)
	{
		//echo $row . "<br><br>";
		$age = $row->{'max(age)'};
	}
	$sqlMod = "SELECT healthMod FROM age WHERE age='" . $age . "'";
	$resultMod = DB::select($sqlMod);
	foreach($resultMod as $row)
	{
		$healthMod = $row->healthMod;
	}
	return $healthMod;
}

function getAgeModAI($userID)
{
	$sqlVar = "SELECT age FROM userInfo WHERE userID='" . $userID . "'";
	$result2 = DB::select($sqlVar);
	foreach($result2 as $row)
	{
		$resultVar = $row->age;
	}
	$sqlAge = "SELECT max(age) FROM age WHERE age<='" . $resultVar . "'";
	$result = DB::select($sqlAge);
	foreach($result as $row)
	{
		//echo $row . "<br><br>";
		$age = $row->{'max(age)'};
	}
	$sqlMod = "SELECT carMod FROM age WHERE age='" . $age . "'";
	$resultMod = DB::select($sqlMod);
	foreach($resultMod as $row)
	{
		$healthMod = $row->carMod;
	}
	return $healthMod;
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
	if(isset($_GET['searchFor']))
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
		if($searchFor=='HI')
		{
			return 'health_insurance';
		}
		if($searchFor=='AI')
		{
			return 'auto';
		}
	}
	return 'cell_services';
}

function addService($serviceID)
	{
			
		$userID = getUserID();
		$vendType = getVendType();
		$vendBiz = getServiceIDName($vendType);
		$columns = getServiceColumns($vendType);
				
		$values = "'" . $vendBiz . "', '" . $userID . "', '" . $vendType . "', '" . $serviceID . "',";
		$create_datetime = date("Y-m-d H:i:s");
		$values = " (" . $values . " '" . $create_datetime . "')";
		$fields = "(vendName, userID, vendType, serviceID, create_datetime)";
		DB::delete("DELETE FROM services WHERE userID=$userID AND vendType='$vendType'");
		$query = "INSERT into services $fields  VALUES $values";
		$resultService   = DB::select($query);
	}

function getServiceIDName($vendType)
{
	switch ($vendType) {
    	case 'cell_services':
        	return 'csID';
		break;
    	case 'health_insurance':
       	 	return 'hiID';
		break;
    	case 'home_insurance':
       	 	return 'hoiID';
		break;
	case 'auto_insurance':
       	 	return 'aiID';
		break;
	case 'internet_services':
       	 	return 'isID';
		break;
	case 'lawncare':
       	 	return 'lcID';
		break;
	case 'housekeeping':
       	 	return 'hsID';
		break;
	}
}

	/*function addService()
	{
		$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		if (strpos($url,'searchFor=CS') !== false) {
		
		$userID = getUserID();
		$serviceColumns = getServiceColumns(getVendType());
		$numFamily = getVarFromUser($userID, 'numFamily');
		$userID = getUserID();
		$vendType = getVendType();
		$sugRoaming=$numFamily * 2;
		$sugPrice = $numFamily * 15 + 5;
		$sugHotSpot='NO';
		if ($numFamily > 2)
		{
		$sugHotSpot='YES';
		}

		$serviceName = $serviceColumns[0];
		$bName = $serviceColumns[2];
		$roaming = $serviceColumns[4];
		$hotspot = $serviceColumns[5];
		$textnTalk = $serviceColumns[6];
		$price = $serviceColumns[7];
		$provider = $serviceColumns[2];
		$sqlRec = "SELECT * FROM " . $vendType . " WHERE roamingData >= '" . $sugRoaming . "' AND price <= '" . $sugPrice . "' AND text_n_talk='unlimited' AND hotspot='" . $sugHotSpot . "'";

		$resultRec = DB::select($sqlRec);
		foreach($resultRec as $row)
		{
		
		$serviceID = $row -> $serviceName;
		$vendName = $row -> $bName;	
		$create_datetime = date("Y-m-d H:i:s");

		$query    = "INSERT into services (vendName, userID, vendType, serviceID, create_datetime) VALUES ('$vendName', '$userID', '$vendType', '$serviceID', '$create_datetime')";
		$resultService   = DB::insert($query);
		}
		}
		else if(strpos($url,'searchFor=LC') !== false){
			$userID = getUserID();
			$vendType = getVendType();
			$infoColumns = getInfoColumns();
			$lawnFootage = getVarFromUser($userID, 'lawnFootage');
			$onlyMowed = getVarFromUser($userID, 'onlyMowed');
			$needAerate = 'No';
			$needWeed = 'No';
			$needCleanPool = 'No';
			$needPestsGone = 'No';
			$aerate = getVarFromUser($userID, 'aerate');
			$weeded = getVarFromUser($userID, 'weeded');	
			$deadGrass = getVarFromUser($userID, 'deadGrass');
			$pool = getVarFromUser($userID, 'pool');
			$pests = getVarFromUser($userID, 'pests');
			$serviceColumns = getServiceColumns(getVendType());
			$max_index = count($serviceColumns);
			$priceMod = 1.0;

			if ($onlyMowed == 'Yes')
			{
				if ($deadGrass == 'No'){
					$sugPrice = 0.03 * $lawnFootage;
				}
				else{
					$sugPrice = 0.06 * $lawnFootage;
				}
			}
			else
			{
				if($aerate == 'Yes')
				{
				$priceMod = priceMod + 0.05;
				$needAerate = 'Yes';
				}
				if($weeded == 'Yes')
				{
					$priceMod = priceMod + 0.02;
					$needWeed = 'Yes';
				}
				if($pool == 'Yes')
				{
					$priceMod = priceMod + 0.03;
					$needCleanPool = 'Yes';
				}	
				if($pests == 'Yes')
				{
					$priceMod = priceMod + 0.06;
					$needPestsGone = 'Yes';
				}
				if ($deadGrass == 'No'){
					$priceMod = priceMod + 0.03;
				}
				else{
					$priceMod = priceMod + 0.06;
				}
				$sugPrice=((lawnFootage * $priceMod));
			}

			$table = getVendType();
			$serviceColumns = getServiceColumns(getVendType());
			$max_index = count($serviceColumns);

			$serviceName = $serviceColumns[0];
			$bName = $serviceColumns[2];
			$willAerate = $serviceColumns[4];
			$willWeed = $serviceColumns[5];
			$willCleanPool = $serviceColumns[6];
			$willKillPests = $serviceColumns[7];
			$price = $serviceColumns[8];
			$provider = $serviceColumns[2];

			$sqlRec = "SELECT * FROM $table WHERE willAerate = '" . $needAerate ."' AND willWeed = '" . $needWeed ."' AND willCleanPool = '" . $needCleanPool ."' AND willKillPests = '" . $needPestsGone ."' AND price <= '" . $sugPrice . "'";

			$resultRec = DB::select($sqlRec);
			foreach($resultRec as $row)
			{
				$serviceID = $row -> $serviceName;
				$vendName = $row -> $bName;	
				$create_datetime = date("Y-m-d H:i:s");


				DB::delete("DELETE FROM services WHERE userID=$userID AND vendType=$vendType AND serviceID=$serviceID");
				$query    = "INSERT into services (vendName, userID, vendType, serviceID, create_datetime) VALUES ('$vendName', '$userID', '$vendType', '$serviceID', '$create_datetime')";
				$resultService   = DB::insert($query);
			}
		}
	}*/
	

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
<body style="margin-top: 12px; background-image:url({{url('images/wood.jpeg')}})">
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
			<?php
			//echo "terrible";
			if(isset($_POST['serviceInput'])) {
				//echo "insane";
				//echo $_POST['fname'];
          		addService($_POST['fname']);
   			}	
			$columns = array();
			$columnsName = array();
			$sql2 = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='myhome' AND `TABLE_NAME`='services'";
			$result2 = DB::select($sql2);
			foreach($result2 as $row)
			{
				array_push($columns, $row->COLUMN_NAME);	
				
			}
			$sqlRec = "SELECT * FROM services WHERE userID >= " . getUserID() . "";
			$resultRec = DB::select($sqlRec);
			$vendType = getVendType();
			$vendBiz = getServiceIDName($vendType);
			echo "<table border='2'  margin-left='1px 1px' style='border-style:solid; font-size:11px; width:100%;'>";
			echo "<tr> <th style='padding:5px'>Company Name</th><th style='padding:5px'>Type</th><th style='padding:5px'>Service ID:</th><tr>";
			foreach($resultRec as $row)
			{
				echo "<tr>";
				for ($i=0; $i < 4; $i++)
				{
					if($i !== 1)
					{
						echo "<td>";
						$temp = $columns[$i];
						echo $row->$temp . " ";
						echo "</td>";
					}
				}
					
				echo "</td>";
			}
			echo "</tr>";
			echo "</table>";
			?>
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
				if($searchFor=='HI')
				{
					displayFunctionHI();
				}
				if($searchFor=='AI')
				{
					displayFunctionAI();
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