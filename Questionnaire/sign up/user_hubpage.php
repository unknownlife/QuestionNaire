<?php
	session_start();
    if (isset($_POST['GDG'])) {
        $_SESSION['hub_id']="GDG";
    }
    else if (isset($_POST['IEEE'])) {
        $_SESSION['hub_id']="IEEE";
    }
    else if (isset($_POST['UCR'])) {
        $_SESSION['hub_id']="UCR";
    }
    else if (isset($_POST['THESPIAN'])) {
        $_SESSION['hub_id']="THESPIAN";
    }
    else if (isset($_POST['MMV'])) {
        $_SESSION['hub_id']="MMV";
    }
    else if (isset($_POST['KNUTH'])) {
        $_SESSION['hub_id']="KNUTH";
    }
	$hub_id=$_SESSION['hub_id'];
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "jiit united";

		// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);

	$sql = "SELECT * FROM hubs WHERE (hub_id='$hub_id')";
	
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
    
		while($row = mysqli_fetch_assoc($result)) {
			$hub_name=$row["hubname"];
			$hub_desc=$row["hub_desc"];
			$fname=$row["f_name"];
			$fdept=$row["f_dept"];
			$femail=$row["f_email"];
		}
	} 
	$x="";
	$sql="SELECT * FROM events e1,hub_wise_event e2 where e2.hub_id='$hub_id' AND e1.e_id=e2.event_id order by start";
	$run1=mysqli_query($conn,$sql); 
	if (mysqli_num_rows($run1) > 0) {

			while($row = mysqli_fetch_assoc($run1)) {
				$x=$x."<tr><td><a href='eventforuser.php?v=".$row["e_id"]."'target='_blank' style='color:black;'>".$row["e_name"]."</a></td><td>".$row["start"]."</td><td>".$row["start_time"]."</td><td>".$row["venue"]."</td></tr>";
			}
	}		
	mysqli_close($conn);

?>


<!DOCTYPE html>
<html lang="en">

    <head>
	<script>
	
		function allevent()
		{
			var x="<?php echo $x;?>";
			document.getElementById('display_area').innerHTML="<div style='font-size:40px; color:black; margin-left:25px; font-family:cormorant garamond;'>List of events<br></div>"+
	 "<table class='table table-hover table-bordered table-info' style='margin-left:25px; margin-top:70px; width:60%;'>"+
     "<thead style='font-size:20px;'>"+
      "<tr>"+
        "<th>Name</th>"+
		"<th>Date</th>"+
		"<th>Time</th>"+
		"<th>Venue</th>"+
    "</thead>"+
    "<tbody>"+x+"</tbody></table>";
			
		}	
	</script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User Hub page</title>
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:400,700">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    </head>
    <body>
	<style>
	h1
	{
	  font-size:58px;
	  text-align:left;
	  color:#fff;
	  margin-top:10px;
	  margin-left:15px;
	  font-family:"cormorant garamond";
    }
	.about_hub
	{
	  width:1080px;
    }
	.back
	{
	  width:250px;
	}
	.btn
	{
	  background-color:#26969A;
	}
	</style>
     <div class="top_bar">
	    <h1>JIIT UNITED</h1>
		<a href="myhub.php"><button style="margin:0px 15px 0px 1160px;background-color:#B2DFDB; font-size:18px;"><i class="fa fa-arrow-circle-left"></i> GO BACK</button></a>
	 </div>
	 <div class="hub_name">
	 <img src="backgrounds/<?php echo $hub_id;?>.jpg"  style='height: 180px; width:180px; margin-left:10px;margin-top:10px; object-fit: contain'>
	 <p id="nameofhub"><?php echo $hub_name?></p>
	 </div>
	 <div class="back">
	   <div class="btn-group-vertical" style="width:250px;">
	      <button type="button" class="btn btn-primary" onclick="window.location='user_hubpage.php'">HOME</button>
		  <button type="button" class="btn btn-primary" onclick="allevent()">ALL EVENTS</button>
       </div>
	 </div>
	   <div class="about_hub" id="display_area">
	   
		<div style='font-size:40px; color:black; margin-left:20px; font-family:cormorant garamond;'>About the Hub...<br></div>
		<p id='hub_text' style='color:black; font-size:20px; margin-left:20px;'><?php echo $hub_desc;?></p>
		<div style='font-size:30px; color:black; margin-top:50px; margin-left:20px; font-family:cormorant garamond;'>Faculty Co-ordinator:<br></div>
		<h2 id='faculty_name' style=' margin-left:20px; font-size:20px; color:black;'><?php echo $fname;?></h2>
		<h3 id='faculty_dept' style=' margin-left:20px; font-size:20px; color:black;'><?php echo $fdept;?></h3>
		<h5 id='faculty_email' style=' margin-left:20px; font-size:20px; color:black;'><?php echo $femail;?></h5>
		<div style='font-size:30px; color:black; margin-left:20px; font-family:cormorant garamond;'>Student Co-ordinators:<br></div>
		<p><div id='stud1_name' style=' margin-left:20px; text-align:left; font-size:20px; color:black;'></div>
		<div id='stud2_name' style='margin-right:20px;  text-align:right; font-size:20px; color:black;'></div></p><br>
		<p><div id='stud1_phno' style=' margin-left:20px; text-align:left; font-size:20px; color:black;'></div>
		<div id='stud2_phno' style='margin-right:20px; text-align:right; font-size:20px; color:black;'></div></p>
		</div>
		
	   </div>
	 </body>
	 </html>