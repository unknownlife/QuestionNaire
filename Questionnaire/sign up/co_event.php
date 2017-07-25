<?php 
session_start();  
  
if(!$_SESSION['hub_id'])  
{  
    header("Location: hub_login_new.php");//redirect to login page to secure the welcome page without login access	
}  	
	$v=$_GET['v'];
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "jiit united";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	$sql="SELECT * FROM events where e_id='$v'";
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
	if(isset($_POST['update']))
		{
				$hub_id=$_SESSION['hub_id'];
				$e_name=$_POST['e_name'];
				$e_desc=$_POST['e_desc'];
				$estart=$_POST['e_startdate'];
				$eend=$_POST['e_enddate'];
				$startt=$_POST['e_starttime'];
				$endt=$_POST['e_endtime'];
				$venue=$_POST['e_venue'];
				$regis=$_POST['e_link'];
				$sql1 = "UPDATE events set e_name='$e_name',e_desc='$e_desc',start='$estart',end='$eend',start_time='$startt',end_time='$endt',venue='$venue',register_link='$regis' where e_id='$v'";
				$run1=mysqli_query($conn,$sql1);  
				echo "<script>alert('Event Details Updated!');</script>";
		}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
	<script>
	function update()
	{
		document.getElementById('display_area').innerHTML=""+
				"<div style='font-size:40px; color:black; margin-left:30px; font-family:cormorant garamond;'>Event info<br></div>"+
		 "<form name='myForm' action='co_event.php?v=<?php echo $v;?>' method='post' style='margin-top:70px; width:500px; margin-left:30px;'>"+
	      "<div class='form-group'>"+
          "<label for='e_id'>Event ID:</label>"+
          "<input name ='e_id' type='text' class='form-control' placeholder='Enter event id' value='<?php echo $e_id;?>'required>"+
          "</div>"+
		  "<div class='form-group'>"+
          "<label for='e_name'>Event Name:</label>"+
          "<input name ='e_name' type='text' class='form-control' placeholder='Enter event name' value='<?php echo $e_name;?>' required>"+
          "</div>"+
		  "<div class='form-group'>"+
          "<label for='e_desc'>Event Description:</label>"+
          "<textarea name ='e_desc'  class='form-control' placeholder='Enter description'><?php echo $e_desc;?></textarea>"+
          "</div>"+
		  "<div class='form-group'>"+
          "<label for='e_startdate'>Event Starts On:</label>"+
          "<input name ='e_startdate' type='date' class='form-control' value='<?php echo $start;?>' required>"+
          "</div>"+
		  "<div class='form-group'>"+
          "<label for='e_enddate'>Event Ends On:</label>"+
          "<input name ='e_enddate' type='date' class='form-control' value='<?php echo $end;?>' required>"+
          "</div>"+
		   "<div class='form-group'>"+
          "<label for='e_starttime'>Event Starts At:</label>"+
          "<input name ='e_starttime' type='time' class='form-control' value='<?php echo $startt;?>' required>"+
          "</div>"+
		  "<div class='form-group'>"+
          "<label for='e_endtime'>Event Ends At:</label>"+
          "<input name ='e_endtime' type='time' class='form-control' value='<?php echo $endt;?>' required>"+
          "</div>"+
		  "<div class='form-group'>"+
          "<label for='e_venue'>Event Venue:</label>"+
          "<input name ='e_venue' type='text' class='form-control' placeholder='Enter venue' value='<?php echo $venue;?>' required>"+
          "</div>"+
		  "<div class='form-group'>"+
          "<label for='e_link'>Event Registration Link:</label>"+
          "<input name ='e_link' type='text' class='form-control' placeholder='Enter registration link' value='<?php echo $link;?>' required>"+
          "</div>"+
		  "<button type='submit' class='btn btn-success' style='margin-top:20px; margin-left:5px;' name='update'>Save Changes</button>"+
		  "</form>";
		}
	function deleted()
	{
		var x=confirm("Are you sure you want to delete?");
		if(x==true) window.location='delete.php?v=<?php echo $v;?>';
	}
	</script>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hub page</title>
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:400,700">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
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
    
	</head>
    <body>
	 <div class="top_bar">
	    <h1>JIIT UNITED</h1>
	 </div>
	 <div class="hub_name">
	 <img src="backgrounds/<?php echo $_SESSION['hub_id'];?>.jpg"  style='height: 180px; width:180px; margin-left:10px;margin-top:10px; object-fit: contain'>
	 <p id="nameofhub"><?php echo $_SESSION['hub_name']?></p>
	 </div>
	 <div class="back">
	   <div class="btn-group-vertical" style="width:250px;">
          <button type="button" class="btn btn-primary" onclick="window.location='#'">HOME</button>
          <button type="button" class="btn btn-primary" onclick="update()">UPDATE EVENT</button>
          <button type="button" class="btn btn-primary" name="delete" onclick="deleted()">DELETE EVENT</button>
	  </div>
	 </div>
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
		
	 </body>
	 </html>