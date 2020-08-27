<?php
	// See all errors and warnings
	error_reporting(E_ALL);
	ini_set('error_reporting', E_ALL);

	$server = "localhost";
	$username = "root";
	$password = "";
	$database = "dbUser";
	$mysqli = mysqli_connect($server, $username, $password, $database);

	$email = isset($_POST["loginName"]) ? $_POST["loginName"] : false;
	$pass = isset($_POST["loginPassw"]) ? $_POST["loginPassw"] : false;	
	// if email and/or pass POST values are set, set the variables to those values, otherwise make them false

	$query = "SELECT * FROM tbusers WHERE email = '$email' AND password = '$pass'";

	$res = mysqli_query($mysqli, $query);

	$row = mysqli_fetch_array($res);
	$userid = $row["user_id"];

	$folderName = "gallery/";

	if(isset($_FILES["picToUpload"]))
	{
		$uploadFile = $_FILES["picToUpload"];
		// Profile pic is being updated
		$numFiles = count($uploadFile["name"]);

		$uploadSuccess = false;

		for($i = 0; $i < $numFiles; $i++)
		{
			if( ($uploadFile["type"][$i] == "image/jpeg" 
			|| $uploadFile["type"][$i] == "image/pjpeg"
			|| $uploadFile["type"][$i] == "image/png") && $uploadFile["size"][$i] < 1000000){
				if($uploadFile["error"][$i] > 0)
				{
					echo "Error: " . $uploadFile["error"][$i] . "<br/>";
				}
				else
				{
					// Add new entry to table
					$uploadFileName = $uploadFile["name"][$i];

					$sql = "INSERT INTO tbgallery (user_id, filename) VALUES ($userid, '$uploadFileName')";
					$mysqli->query($sql);

					// Optional
					// Get imageid of new entry to generate unique filename
					$sql = "SELECT LAST_INSERT_ID() FROM tbgallery;";
					$result = $mysqli->query($sql);
					$row = mysqli_fetch_assoc($result);
					$imageid = implode("", $row);

					$newFileName = $imageid . "_" . $userid . "_" . $uploadFileName;
					move_uploaded_file($uploadFile["tmp_name"][$i], $folderName .  $newFileName);
					$sql = "UPDATE tbgallery SET filename = '" . $newFileName . "' WHERE image_id = " . $imageid;
					$mysqli->query($sql);
					$uploadSuccess = true;
				}
			}
		}	
		if($uploadSuccess)
			echo 	'<div class="alert alert-primary mt-3" role="alert">
  						Images added to gallery
  					</div>';
  		else{
  			echo 	'<div class="alert alert-danger mt-3" role="alert">
  						Could not upload images to gallery
  					</div>';
  		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>IMY 220 - Assignment 2</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="style.css" />
	<meta charset="utf-8" />
	<meta name="author" content="Ronald Looi">
	<!-- Replace Name Surname with your name and surname -->
</head>
<body>
	<div class="container">
		<?php
			if($email && $pass)
			{
				$query = "SELECT * FROM tbusers WHERE email = '$email' AND password = '$pass'";
				$res = $mysqli->query($query);
				if($row = mysqli_fetch_array($res))
				{
					echo 	"<table class='table table-bordered mt-3'>
								<tr>
									<td>Name</td>
									<td>" . $row['name'] . "</td>
								<tr>
								<tr>
									<td>Surname</td>
									<td>" . $row['surname'] . "</td>
								<tr>
								<tr>
									<td>Email Address</td>
									<td>" . $row['email'] . "</td>
								<tr>
								<tr>
									<td>Birthday</td>
									<td>" . $row['birthday'] . "</td>
								<tr>
							</table>";
				
					echo 	"<form action='' method='POST' enctype='multipart/form-data'>
								<div class='form-group'>
									<input type='file' class='form-control' name='picToUpload[]' id='picToUpload' /><br/>
									<input type='hidden' class='form-control' name='loginName' value='" . $_POST["loginName"] . "' />
									<input type='hidden' class='form-control' name='loginPassw' value='" . $_POST["loginPassw"] . "' />
									<input type='submit' class='btn btn-standard' value='Upload Image' name='submit' />
								</div>
						  	</form>";

				  	$query = "SELECT * FROM tbgallery WHERE user_id = $userid";			
					$res = $mysqli->query($query);

					if($res->num_rows != 0)
					{
						echo "<h1 class='mt-3'>Image Gallery</h1><div class='gallery row'>";
						while($row = mysqli_fetch_array($res))
						{
							echo "<div class='col-3' style='background-image: url(" . $folderName .  $row["filename"] . ")'></div>";
						}
						echo "</div>";
					}					
				}
				else
				{
					echo 	'<div class="alert alert-danger mt-3" role="alert">
	  							You are not registered on this site!
	  						</div>';
				}
			} 
			else
			{
				echo 	'<div class="alert alert-danger mt-3" role="alert">
	  						Could not log you in
	  					</div>';
			}
		?>
	</div>
</body>
</html>