<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


				function sendData()
				{
				
				$sql = "SELECT vendID, vendtype FROM vendors WHERE vendName='" . session('vendName') . "'";
				$result = DB::select($sql);
				
					foreach($result as $row)
					{
						$vendID = $row->vendID;
						$vendtype = $row->vendtype;
					}
				
				$columns = array();
				$sql2 = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='myhome' AND `TABLE_NAME`='$vendtype'";
				$result2 = DB::select($sql2);
					foreach($result2 as $row)
					{
						array_push($columns, $row->COLUMN_NAME);
					}

					$sql = "SELECT vendID, vendtype FROM vendors WHERE vendName='" . session('vendName') . "'";
					$result = DB::select($sql);
				
					foreach($result as $row)
					{
						$vendID = $row->vendID;
						$vendtype = $row->vendtype;
					} 
					$querystring2 = "'" . $vendID . "', '" . session('vendName') . "', '" . $vendtype . "',";
					$querystring1 = "vendID, vendName, vendtype,";
					$querystring1 = "vendID, vendName, vendtype,";
						for($i=4; $i < count($columns) - 1; $i++)
						{
							$data = stripslashes($_REQUEST[$columns[$i]]);
							$querystring2 =  $querystring2 . " '" . $data . "',";
							$querystring1 = $querystring1 . " " . $columns[$i] . ",";
						}
						$create_datetime = date("Y-m-d H:i:s");
						$querystring2 = " (" . $querystring2 . " '" . $create_datetime . "')";
						$querystring1 = " (" . $querystring1 . " create_datetime)";
						$query    = "INSERT into $vendtype $querystring1  VALUES $querystring2";
						$result3 = DB::select($query);
				}
?>
<!DOCTYPE html>
<html lang="en">
<head>


	<title>MyHome - Vendor Hub</title>
	<script language="javascript">
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
<body style="margin-top: 12px; background-image: url('wood.jpeg');">
<div class="container-fluid">
<?php 
if (session()->missing('vendName'))
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
		<h3>Welcome to MyHome, {{ session('firstname')}}! What would you like to do?</h3>
		</div>
		<div class = "row" style="">
		<div class = "col form" style="margin:0px 10px;">
			<p style="">Your Current Plans:</p><br>
			
			<?php


			    //require('db.php');
				function prepareDataSet(){
					global $con;
						$sql = "SELECT vendID, vendtype FROM vendors WHERE vendName='" . session('vendName') . "'";
					$result = DB::select($sql);
					
						foreach($result as $row)
						{
							//echo $row['vendID']. "<br>";
							$vendID = $row->vendID;
							$vendtype = $row->vendtype;
						}
					$columns3 = array();
					$sql3 = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='myhome' AND `TABLE_NAME`='$vendtype'";
					$result3 = DB::select($sql3);
						// output data of each row
						foreach($result3 as $row)
						{
							//echo $row->COLUMN_NAME. "<br>";
							array_push($columns3, $row->COLUMN_NAME);
						}
					$max_index = count($columns3);
					//echo $max_index;
					$numVendID = (int)$vendID;
					
					$sql = "SELECT * FROM $vendtype WHERE vendID=$numVendID";
					//echo $sql;
					$result = DB::select($sql);
					foreach($result as $row)
					{
						for ($i=0; $i < $max_index; $i++)
						{
							echo $columns3[$i] . " : ";
							$temp = $columns3[$i];
							echo $row->$temp . ", ";
						}
						echo "<br><br>";
					}

				}
				$sql = "SELECT vendID, vendtype FROM vendors WHERE vendName='" . session('vendName') . "'";
				$result = DB::select($sql);
					foreach($result as $row)
					{
						$vendID = $row->vendID;
						$vendtype = $row->vendtype;
					}
				$columns = array();
				$sql2 = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='myhome' AND `TABLE_NAME`='$vendtype'";
				$result2 = DB::select($sql2);
					// output data of each row
					foreach($result2 as $row)
					{
						array_push($columns, $row->COLUMN_NAME);
					}
				if (isset($_REQUEST[$columns[4]]))
				{
					sendData();
				}
				prepareDataSet();
			?>
			<table style="text-align:left; width: 100%;">
  			<tr style="text-align:left;">
  			</tr>
			</table>
		</div> 
		<div class = "col form" style="text-align: center; margin:0px 10px" id="super">
		<form method="post" name="vendorCreatePlan" id="createAPLan">
		@csrf
			<p style="text-align:center;">Create a Plan:</p><br>
			 <?php

				$sql = "SELECT vendID, vendtype FROM vendors WHERE vendName='" . session('vendName') . "'";
				$result = DB::select($sql);
				
					foreach($result as $row)
					{
						$vendID = $row->vendID;
						$vendtype = $row->vendtype;
					}

				$i = 0;
				$columns = array();
				$sql2 = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='myhome' AND `TABLE_NAME`='$vendtype'";
				$result2 = DB::select($sql2);
					// output data of each row
					foreach($result2 as $row)
					{
						array_push($columns, $row->COLUMN_NAME);
						$i++;
					}

					$max_index = $i - 1;
				for($i=4; $i < $max_index; $i++)
				{
					echo "<input type='text' class='form-control' style='font-size:1vw;' name='". $columns[$i] ."' placeholder='" . $columns[$i] . "' autofocus='true'/><br>";
				}
				?>


			<input type="submit" style="padding: 5px 10px; color: white; background-color:#8c5020; border-radius:10px; border-style:solid; border-color:black;" value="Submit" name="submit" class="login-button"/><br><br>
			<div class="row" style="margin: 0px 15px;">
			</div>
		</form>
		</div>
		<div class = "col form" style="margin:0px 10px">
			<p style="">Current Subscribers:</p><br>
			<table style="text-align:left; width: 100%;">
  			<tr style="text-align:left;">
   			 	<th>Last Name</th>
    				<th>Plan ID</th>
				<th>Bill</th>
				
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
			<tr>
    				<td>#</td>
    				<td>#</td> 
    				<td>#</td>
  			</tr>
    				<td>#</td>
    				<td>#</td> 
    				<td>#</td>
  			</tr>
			<tr>

			</tr>
			</table>
  		</div>	
		
		</div>
		</div>
		</div>	

		
</body>
</html>