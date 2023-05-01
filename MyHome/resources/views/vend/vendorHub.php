<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script language="javascript">

	var element;
	var form;
	var btn;
	var newline;
	var newline2;

	function createInputForm(){
		element = document.getElementById("super");
		form = document.createElement('form');
		btn = document.createElement("input");
		btn.setAttribute("type", "submit");
		btn.setAttribute("value", "submit");
		btn.setAttribute("name", "submit");
		btn.setAttribute("class", "login-button");
		newline = document.createElement('br');
		newline2 = document.createElement('br');
		form.appendChild(newline);
		form.appendChild(btn);
		form.appendChild(newline2);
	}
</script>

<?php

				function sendData()
				{
				//echo "Here we at y'all <br>";
			    require('db.php');
				
				$sql = "SELECT vendID, vendtype FROM vendors WHERE vendName='" . $_SESSION['vendName'] . "'";
				$result = $con->query($sql);
				
					while($row = $result->fetch_assoc())
					{
						//echo $row['vendID']. "<br>";
						$vendID = $row['vendID'];
						//echo $row['vendtype']. "<br>";
						$vendtype = $row['vendtype'];
						//array_push($columns, $row["COLUMN_NAME"]);
					}
				
				$columns = array();
				$sql2 = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='myhome' AND `TABLE_NAME`='$vendtype'";
				$result2 = $con->query($sql2);
					// output data of each row
					while($row = $result2->fetch_assoc())
					{
						//echo $row["COLUMN_NAME"]. "<br>";
						array_push($columns, $row["COLUMN_NAME"]);
					}

					$sql = "SELECT vendID, vendtype FROM vendors WHERE vendName='" . $_SESSION['vendName'] . "'";
					$result = $con->query($sql);
				
					while($row = $result->fetch_assoc())
					{
						//echo $row['vendID']. "<br>";
						$vendID = $row['vendID'];
						$vendtype= $row['vendtype'];
					} 
					$querystring2 = "'" . $vendID . "', '" . $_SESSION['vendName'] . "', '" . $vendtype . "',";
					$querystring1 = "vendID, vendName, vendtype,";
					$querystring1 = "vendID, vendName, vendtype,";
						for($i=4; $i < count($columns) - 1; $i++)
						{
							// removes backslashes
							$data = stripslashes($_REQUEST[$columns[$i]]);
							//escapes special characters in a string
							//$data = mysqli_real_escape_string($con, $data);
							$querystring2 =  $querystring2 . " '" . $data . "',";
							$querystring1 = $querystring1 . " " . $columns[$i] . ",";
						}
						$create_datetime = date("Y-m-d H:i:s");
						$querystring2 = " (" . $querystring2 . " '" . $create_datetime . "')";
						//echo $querystring2 . "<br>";
						$querystring1 = " (" . $querystring1 . " create_datetime)";
						//echo $querystring1 . "<br>";
						$query    = "INSERT into $vendtype $querystring1  VALUES $querystring2";
						//echo $query;
						//echo $query;
						$result3   = mysqli_query($con, $query);

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
if (session()->missing('firstname'))
{
	include(app_path().'/includes/headerLoggedOut.php');
}
else
{
	include(app_path().'/includes/headerLoggedIn.php');
}
?>
		<div class = "container-fluid" style="">
		<div class = "row" style="margin: 15px auto; border-radius:15px; padding: 15px 10px; border-style: solid; border-color: black; text-align:center; background-color:white;">
		<h3>Welcome to MyHome, <?php echo $_SESSION['vendName']; ?>! What would you like to do?</h3>
		</div>
		<div class = "row" style="">
		<div class = "col form" style="margin:0px 10px;">
			<p style="">Your Current Plans:</p><br>
			
			<?php
			    require('db.php');
				function prepareDataSet(){
					global $con;
						$sql = "SELECT vendID, vendtype FROM vendors WHERE vendName='" . $_SESSION['vendName'] . "'";
					$result = $con->query($sql);
					
						while($row = $result->fetch_assoc())
						{
							//echo $row['vendID']. "<br>";
							$vendID = $row['vendID'];
							$vendtype = $row['vendtype'];
						}
					$columns3 = array();
					$sql3 = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='myhome' AND `TABLE_NAME`='$vendtype'";
					$result3 = $con->query($sql3);
						// output data of each row
						while($row = $result3->fetch_assoc())
						{
							//echo $row["COLUMN_NAME"]. "<br>";
							array_push($columns3, $row["COLUMN_NAME"]);
						}
					$max_index = count($columns3);
					//echo $max_index;
					$numVendID = (int)$vendID;
					
					$sql = "SELECT * FROM $vendtype WHERE vendID=$numVendID";
					//echo $sql;
					$result = $con->query($sql);
					while($row = $result->fetch_assoc())
					{
						for ($i=0; $i < $max_index; $i++)
						{
							echo $columns3[$i] . " : ";
							echo $row[$columns3[$i]] . ", ";
						}
						echo "<br><br>";
					}

				}
				$sql = "SELECT vendID, vendtype FROM vendors WHERE vendName='" . $_SESSION['vendName'] . "'";
				$result = $con->query($sql);
					while($row = $result->fetch_assoc())
					{
						$vendID = $row['vendID'];
						$vendtype = $row['vendtype'];
					}
				$columns = array();
				$sql2 = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='myhome' AND `TABLE_NAME`='$vendtype'";
				$result2 = $con->query($sql2);
					// output data of each row
					while($row = $result2->fetch_assoc())
					{
						array_push($columns, $row["COLUMN_NAME"]);
					}
				if (isset($_REQUEST[$columns[4]]))
				{
					sendData();
				}
				prepareDataSet();
			?>
			<table style="text-align:left; width: 100%;">
  			<tr style="text-align:left;">
   			 	<!--<th style="margin-right:20px;">Price</th>
    				<th>Description</th> 
				<th> </th>
  			</tr>
  			<tr>
    				<td>#</td>
    				<td style="color: #8c5020;" data-bs-toggle="modal" data-bs-target="#planModal">Click
					<div class="modal fade" id="planModal">
			   		<div class="modal-dialog">
			     		<div class="modal-content">
			       		<!-- Modal Header
				 		<div class="modal-header" style="color:black;">
				    		<h4 style="text-align:center; color:black;" class="modal-title">Plan #1</h4>
				    		<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				 		</div>
			       		<!-- Modal body 
			         		<div class="modal-body" style="color:black;">
			           		<p style="font-size:16px;"> This is a test description of a business' utility plan </p>
			         		</div>
			       		</div>
			     		</div>
			   		</div>
				</td>
				<td><a href='remove.php?id=".$row['planID']."' style='text-decoration:none; color:#8c5020;'> &#x2715; </a></td>
  			</tr>
  			<tr>
    				<td>#</td>
    				<td style="color: #8c5020;" data-bs-toggle="modal" data-bs-target="#planModal2">Click
					<div class="modal fade" id="planModal2">
			   		<div class="modal-dialog">
			     		<div class="modal-content">
			       		<!-- Modal Header 
				 		<div class="modal-header" style="color:black;">
				    		<h4 style="text-align:center; color:black;" class="modal-title">Plan #2</h4>
				    		<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				 		</div>-->
			       		<!-- Modal body
			         		<div class="modal-body" style="color:black;">
			           		<p style="font-size:16px;"> This is the second test description of a utility plan </p>
			         		</div>
			       		</div>
			     		</div>
			   		</div>
				</td>
				<td><a href='remove.php?id=".$row['planID']."' style='text-decoration:none; color:#8c5020;'> &#x2715; </a></td>
  			</tr>
			<tr>
    				<td>#</td>
    				<td style="color: #8c5020;" data-bs-toggle="modal" data-bs-target="#planModal3">Click
					<div class="modal fade" id="planModal3">
			   		<div class="modal-dialog">
			     		<div class="modal-content">
			       		<!-- Modal Header
				 		<div class="modal-header" style="color:black;">
				    		<h4 style="text-align:center; color:black;" class="modal-title">Plan #3</h4>
				    		<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				 		</div>
			       		<!-- Modal body
			         		<div class="modal-body" style="color:black;">
			           		<p style="font-size:16px;"> This is the third test description of a utility plan </p>
			         		</div> 
			       		</div>
			     		</div>
			   		</div>
				</td>
				<td><a href='remove.php?id=".$row['planID']."' style='text-decoration:none; color:#8c5020;'> &#x2715; </a></td> -->
  			</tr>
			</table>
		</div> 
		<!-- catch -->
		<div class = "col form" style="text-align: center; margin:0px 10px" id="super">
		<form method="post/get" name="vendorCreatePlan" id="createAPLan">
			<p style="text-align:center;">Create a Plan:</p><br>
			<!-- <p style="font-weight: normal; font-size: 18px;"> Description: </p> -->
			 <?php
			    require('db.php');

				$sql = "SELECT vendID, vendtype FROM vendors WHERE vendName='" . $_SESSION['vendName'] . "'";
				$result = $con->query($sql);
				
					while($row = $result->fetch_assoc())
					{
						$vendID = $row['vendID'];
						$vendtype = $row['vendtype'];
					}


				$columns = array();
				$sql2 = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='myhome' AND `TABLE_NAME`='$vendtype'";
				$result2 = $con->query($sql2);
					// output data of each row
					while($row = $result2->fetch_assoc())
					{
						//echo $row["COLUMN_NAME"]. "<br>";
						array_push($columns, $row["COLUMN_NAME"]);
					}
				//echo $vendtype;
				if (isset($_REQUEST[$columns[4]]))
				{
					//sendData();
					
				}

				//prepareDataSet();
					
				/*<?php echo $_SESSION['vendName']; ?>*/
				?>
			<script language="javascript">
			
			$(document).ready(function() {

				createInputForm();
			
			
			
			var passedArray = <?php echo json_encode($columns);?>;
			for(let i=4; i < Number(<?php echo count($columns);?>) - 1; i++)
			{
				const test = document.createElement("input");
				test.setAttribute("type", "text");
				test.setAttribute("name", passedArray[i]);
				test.setAttribute("placeholder", passedArray[i]);
				test.setAttribute("placeholder", passedArray[i]);
				test.required=true;
				form.appendChild(test);
				form.appendChild(newline);
			}
			element.appendChild(form);
		});
			</script>
			<!--
        		<textarea style="border-color:black; border-width:2px; border-padding: 5px; border-style:solid;" name="planDesc" rows="3" cols="20" autofocus="true";"/></textarea><br><br>
        		<textarea style="border-color:black; border-width:2px; border-padding: 5px; border-style:solid;" name="planDesc" rows="3" cols="20" autofocus="true"/></textarea><br><br>
			<p style="font-weight: normal; font-size: 18px;"> Price: </p>
        		<input type="text" style="padding: 5px; border-style:solid;" name="planPrice" placeholder=<?php echo $need;?> autofocus="true"/><br><br> -->
			<div class="row" style="margin: 0px 15px;">
			<!--<input type="submit" style="; margin:0px 0px; padding: 5px 10px; color: black; border-color: black; color: white; background-color:#8c5020; border-radius:10px; border-style:solid; border-width:3px;" value="Submit" name="submit" class="login-button"/>-->
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
		<div class = "col form" style="margin:0px 10px">
			<p style="">Users in Need of a Plan:</p><br>
			<?php
			
			    require('db.php');

				$sql = "SELECT vendID, vendtype FROM vendors WHERE vendName='" . $_SESSION['vendName'] . "'";
				$result = $con->query($sql);
				
					while($row = $result->fetch_assoc())
					{
						//echo $row['vendID']. "<br>";
						$vendID = $row['vendID'];
						//echo $row['vendtype']. "<br>";
						$vendtype = $row['vendtype'];
						//array_push($columns, $row["COLUMN_NAME"]);
					}
				//echo $vendtype . "<br>";
				//echo $vendID . "<br>";
				//echo $trueVendType;
				

				$columns3 = array();
				$sql3 = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='myhome' AND `TABLE_NAME`='needs'";
				$result3 = $con->query($sql3);
					// output data of each row
					while($row = $result3->fetch_assoc())
					{
						//echo $row["COLUMN_NAME"]. "<br>";
						array_push($columns3, $row["COLUMN_NAME"]);
					}
				$max_index = count($columns3);
				//echo $max_index;
				$sql = "SELECT * FROM needs WHERE service_type='$vendtype'";
				$result = $con->query($sql);
				while($row = $result->fetch_assoc())
				{
					for ($i=0; $i < $max_index; $i++)
					{
						echo $columns3[$i] . " : ";
						echo $row[$columns3[$i]] . ", ";
					}
					echo "<br><br>";
				}
			
			?>
			<table style="text-align:left; width: 100%;">
  			<tr style="text-align:left;">
   			 	<!--<th>Last Name</th>
    				<th>Bill</th>
				<th>About</th>
				<th> </th>
				<th> </th>				
  			</tr>
  			<tr>
    				<td>#</td>
    				<td>#</td> 
    				<td style="color: #8c5020;" data-bs-toggle="modal" data-bs-target="#userModal">Click
					<div class="modal fade" id="userModal">
			   		<div class="modal-dialog">
			     		<div class="modal-content">
			       		<!-- Modal Header
				 		<div class="modal-header">
				    		<h4 style="text-align:center; color:black;" class="modal-title">User #1's request</h4>
				    		<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				 		</div>
			       		<!-- Modal body
			         		<div class="modal-body">
			           		<p style="font-size:16px; color:black;"> This is a test description of a user's need's description </p>
			         		</div>
			       		</div>
			     		</div>
			   		</div>
				</td>
				<td><a href='contact.php?id=".$row['userID']."' style='text-decoration:none; color:#8c5020;'> &#x2713; </a></td>
				<td><a href='remove.php?id=".$row['userID']."' style='text-decoration:none; color:#8c5020;'> &#x2715; </a></td>
  			</tr>
  			<tr>
    				<td>#</td>
    				<td>#</td> 
    				<td style="color: #8c5020;" data-bs-toggle="modal" data-bs-target="#userModal2">Click
					<div class="modal fade" id="userModal2">
			   		<div class="modal-dialog">
			     		<div class="modal-content">
			       		<!-- Modal Header 
				 		<div class="modal-header">
				    		<h4 style="text-align:center; color:black;" class="modal-title">User #2's request</h4>
				    		<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				 		</div>
			       		<!-- Modal body 
			         		<div class="modal-body">
			           		<p style="font-size:16px; color:black;"> This is the second test description of a user's need's description. </p>
			         		</div>
			       		</div>
			     		</div>
			   		</div>
				</td>
				<td><a href='contact.php?id=".$row['userID']."' style='text-decoration:none; color:#8c5020;'> &#x2713; </a></td>
				<td><a href='remove.php?id=".$row['userID']."' style='text-decoration:none; color:#8c5020;'> &#x2715; </a></td>
  			</tr>
			<tr>
    				<td>#</td>
    				<td>#</td> 
    				<td style="color: #8c5020;" data-bs-toggle="modal" data-bs-target="#userModal3">Click
					<div class="modal fade" id="userModal3">
			   		<div class="modal-dialog">
			     		<div class="modal-content">
			       		<!-- Modal Header 
				 		<div class="modal-header">
				    		<h4 style="text-align:center; color:black;" class="modal-title">User #3's request</h4>
				    		<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				 		</div>
			       		<!-- Modal body
			         		<div class="modal-body">
			           		<p style="font-size:16px; color:black;"> This is the third test description of a user's need's description. </p>
			         		</div>
			       		</div>
			     		</div>
			   		</div>
				</td>
				<td><a href='contact.php?id=".$row['userID']."' style='text-decoration:none; color:#8c5020;'> &#x2713; </a></td>
				<td><a href='remove.php?id=".$row['userID']."' style='text-decoration:none; color:#8c5020;'> &#x2715; </a></td>
  			</tr>
			<tr>
    				<td>#</td>
    				<td>#</td> 
    				<td style="color: #8c5020;" data-bs-toggle="modal" data-bs-target="#userModal4">Click
					<div class="modal fade" id="userModal4">
			   		<div class="modal-dialog">
			     		<div class="modal-content">
			       		<!-- Modal Header
				 		<div class="modal-header">
				    		<h4 style="text-align:center; color:black;" class="modal-title">User #4's request</h4>
				    		<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				 		</div>
			       		<!-- Modal body 
			         		<div class="modal-body">
			           		<p style="font-size:16px; color:black;"> This is the fourth test description of a user's need's description. </p>
			         		</div> 
			       		</div>
			     		</div>
			   		</div>
				</td>
				<td><a href='contact.php?id=".$row['userID']."' style='text-decoration:none; color:#8c5020;'> &#x2713; </a></td> 
				<td><a href='remove.php?id=".$row['userID']."' style='text-decoration:none; color:#8c5020;'> &#x2715; </a></td> -->
  			</tr>
			</table>
  		</div>	
		</div>
		</div>
		</div>	
		<div class="row" style="text-align:center; background-color: white; border-radius:10px; border-style:solid; margin: 10px auto; width: 99%;">
			<a style="text-decoration:none; color:black;" href="logout.php">Logout</a>
		</div>
		
</body>
</html>