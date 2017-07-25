<?php 
	$v=$_GET['v'];
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "jiit united";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	$sql="SELECT * FROM events where e_id='$v'";
	$sql1="SELECT * FROM hub_wise_event where event_id='$v'";
	$run=mysqli_query($conn,$sql); 
	if (mysqli_num_rows($run) > 0) {
    
					while($row = mysqli_fetch_assoc($run)) {
							$e_id=$row["e_id"];
							$e_name=$row["e_name"];
							$e_desc=$row["e_desc"];
							$start=$row["start"];
							$end=$row["end"];
							$startt=$row["start_time"];
							$endt=$row["end_time"];
							$venue=$row["venue"];
							$link=$row["register_link"];
					}
	}
	$run1=mysqli_query($conn,$sql1); 
	if (mysqli_num_rows($run1) > 0) {
    
					while($row = mysqli_fetch_assoc($run1)) {
							$hub_id=$row["hub_id"];
					}
	}
	$sql2="select * from hubs where hub_id='$hub_id'";
	$run2=mysqli_query($conn,$sql2); 
	if (mysqli_num_rows($run2) > 0) {
    
					while($row = mysqli_fetch_assoc($run2)) {
							$hub_name=$row["hubname"];
					}
	}
?>	
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Events</title>
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:400,700">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
    </head>
    <body>
	<style>
	h1
	{
	  font-size:65px;
	  text-align:left;
	  color:#fff;
	  margin-top:20px;
	  margin-left:15px;
	  font-family:"cormorant garamond";
    }
	.btn
	{
	  background-color:#26969A;
	}
	h3
	{
	margin-left:15px;
	}
	</style>
    <div class="top_bar">
	 <h1>JIIT UNITED</h1>
	 </div>
	 <div class="hub_name">
	 <img src="backgrounds/<?php echo $hub_id;?>.jpg"  style='height: 180px; width:180px; margin-left:10px;margin-top:10px; object-fit: contain'>
	 <p id="nameofhub"><?php echo $hub_name?></p>
	 </div>
	 <div class="back">
	   <div class="about_hub" id="display_area">
		<div style='font-size:40px; color:black; margin-left:20px; font-family:cormorant garamond;'><?php echo $e_name;?><br></div>
		<p id='hub_text' style='color:black; font-size:20px; margin-left:20px;'><?php echo $e_desc;?></p>
		<p id='faculty_name' style=' margin-left:20px; font-size:20px; color:black;'><b>Start Date: </b><?php echo $start;?></p>
		<p id='faculty_name' style=' margin-left:20px; font-size:20px; color:black;'><b>Start Time: </b><?php echo $startt;?></p>
		<p id='faculty_name' style=' margin-left:20px; font-size:20px; color:black;'><b>End Date: </b><?php echo $end;?></p>
		<p id='faculty_name' style=' margin-left:20px; font-size:20px; color:black;'><b>End Time: </b><?php echo $endt;?></p>
		<p id='faculty_name' style=' margin-left:20px; font-size:20px; color:black;'><b>Venue: </b><?php echo $venue;?></p>
		<p id='faculty_name' style=' margin-left:20px; font-size:20px; color:black;'><b>Register Here: </b><?php echo $link;?></p>
		
		</div>
	 </div>
	  
	 </body>
	 </html>