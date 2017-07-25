<?php  
session_start();  
  
if(!$_SESSION['hub_id'])  
{  
    header("Location: hub_login_new.php");//redirect to login page to secure the welcome page without login access	
}  
	
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "jiit united";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		if(isset($_POST['updateinfo']))
		{
			$newname=$_POST['new_name'];
			$newdesc=$_POST['new_desc'];
			$hub_id=$_SESSION['hub_id'];
			$update_info="update hubs set hubname='$newname',hub_desc='$newdesc' WHERE hub_id='$hub_id'";
			$run=mysqli_query($conn,$update_info); 
			$_SESSION['hub_name']=$newname;
			$_SESSION['hub_desc']=$newdesc;
			echo "<script>alert('Updated Successfully');</script>";
		}
		if(isset($_POST['changepwd']))
		{
			$newpwd=$_POST['new_pwd'];
			$hub_id=$_SESSION['hub_id'];
			$update_info="update hub_login set hub_pwd='$newpwd' WHERE hub_id='$hub_id'";
			$run=mysqli_query($conn,$update_info); 
			$_SESSION['pwd']=$newpwd;
			echo "<script>alert('Password Changed Successfully');</script>";
		}
		if(isset($_POST['addevent']))
		{
				$hub_id=$_SESSION['hub_id'];
				$eid=$_POST['e_id'];
				$ename=$_POST['e_name'];
				$edesc=$_POST['e_desc'];
				$estart=$_POST['e_startdate'];
				$eend=$_POST['e_enddate'];
				$startt=$_POST['e_starttime'];
				$endt=$_POST['e_endtime'];
				$venue=$_POST['e_venue'];
				$regis=$_POST['e_link'];
				$sql1 = "INSERT INTO events VALUES ('$eid','$ename','$edesc','$estart','$eend','$startt','$endt','$venue','$regis')";
				$sql2 = "INSERT INTO hub_wise_event VALUES ('$hub_id','$eid')";
				$run1=mysqli_query($conn,$sql1); 
				$run2=mysqli_query($conn,$sql2); 
				echo "<script>alert('Event Added!');</script>";
		}
			
			$x="";
			$hub_id=$_SESSION['hub_id'];
			$sql="SELECT * FROM events e1,hub_wise_event e2 where e2.hub_id='$hub_id' AND e1.e_id=e2.event_id order by start";
			$run1=mysqli_query($conn,$sql); 
			if (mysqli_num_rows($run1) > 0) {
    
					while($row = mysqli_fetch_assoc($run1)) {
						$x=$x."<tr><td><a href='co_event.php?v=".$row["e_id"]."'target='_blank' style='color:black;'>".$row["e_name"]."</a></td><td>".$row["start"]."</td><td>".$row["start_time"]."</td><td>".$row["venue"]."</td></tr>";
					}
			}			
				
?>  
<!DOCTYPE html>
<html lang="en">

    <head>
	<script>
	function validatepwdchange(x,y,z)
	{
		if(x.localeCompare($_SESSION['pwd'])==0)
		{
			if(y.localeCompare(z)==0) return true;
			else 
			{
				alert("Passwords do not match");
				return false;
			}
		}
		else 
		{
			alert("Original Password wrong")
			return false;
		}
	}
		function changepwd()
		{
			document.getElementById('display_area').innerHTML="<br><form name='changepwd' onsubmit='return (validatepwdchange(old_pwd,new_pwd,cnfrm_pwd))' action='hub_desc.php' method='post' style='margin-top:20px; width:500px; margin-left:30px;'>"+
	      "<div class='form-group'>"+
          "<label for='old_password'>Old Password:</label>"+
          "<input name ='old_pwd' type='password' class='form-control' placeholder='Enter old password' required>"+
          "</div>"+
		  "<div class='form-group'>"+
          "<label for='new_password'>New Password:</label>"+
          "<input name ='new_pwd' type='password' class='form-control' placeholder='Enter new password' required>"+
          "</div>"+
		  "<div class='form-group'>"+
          "<label for='cnfrm_password'>Confirm Password:</label>"+
          "<input name ='cnfrm_pwd' type='password' class='form-control' placeholder='Enter new password' required>"+
          "</div>"+
		  "<button type='submit' class='btn btn-success' style='margin-top:20px; margin-left:5px;' name='changepwd'>Change Password</button>"+
         "</form>";
		}
		function Updateinfo()
		{
			document.getElementById('display_area').innerHTML="<div style='font-size:40px; color:black; margin-left:30px; font-family:cormorant garamond;'>Update info<br></div>"+
					"<form name='hub_info_change' action='hub_desc.php' method='post' style='margin-top:70px; width:500px; margin-left:30px;'>"+
	      "<div class='form-group'>"+
          "<label for='new_name'>Hub Name:</label>"+
          "<input name ='new_name' type='text' class='form-control' placeholder='Enter new name' value='<?php echo $_SESSION['hub_name'];?>' required>"+
          "</div>"+
	      "<div class='form-group'>"+
          "<label for='desc'>Description:</label>"+
		  "<textarea name ='new_desc'  class='form-control' placeholder='Enter description'><?php echo $_SESSION['hub_desc'];?></textarea>"+
		  "</div>"+
		  "<button type='submit' class='btn btn-success' style='margin-top:20px; margin-left:5px;' name='updateinfo'>Submit</button>"+
         "</form>"+
		 "<div style='font-size:20px; color:black; margin-left:30px; margin-top:10px; font-family:cormorant garamond;'><a href='#' onclick='changepwd()' style='color:blue;'>Change Password</a><br></div>";
		}
		function addevent()
		{
				document.getElementById('display_area').innerHTML=""+
				"<div style='font-size:40px; color:black; margin-left:30px; font-family:cormorant garamond;'>Event info<br></div>"+
		 "<form name='myForm' action='hub_desc.php' method='post' style='margin-top:70px; width:500px; margin-left:30px;'>"+
	      "<div class='form-group'>"+
          "<label for='e_id'>Event ID:</label>"+
          "<input name ='e_id' type='text' class='form-control' placeholder='Enter event id' required>"+
          "</div>"+
		  "<div class='form-group'>"+
          "<label for='e_name'>Event Name:</label>"+
          "<input name ='e_name' type='text' class='form-control' placeholder='Enter event name' required>"+
          "</div>"+
		  "<div class='form-group'>"+
          "<label for='e_desc'>Event Description:</label>"+
          "<textarea name ='e_desc'  class='form-control' placeholder='Enter description'></textarea>"+
          "</div>"+
		  "<div class='form-group'>"+
          "<label for='e_startdate'>Event Starts On:</label>"+
          "<input name ='e_startdate' type='date' class='form-control' required>"+
          "</div>"+
		  "<div class='form-group'>"+
          "<label for='e_enddate'>Event Ends On:</label>"+
          "<input name ='e_enddate' type='date' class='form-control'required>"+
          "</div>"+
		   "<div class='form-group'>"+
          "<label for='e_starttime'>Event Starts At:</label>"+
          "<input name ='e_starttime' type='time' class='form-control' required>"+
          "</div>"+
		  "<div class='form-group'>"+
          "<label for='e_endtime'>Event Ends At:</label>"+
          "<input name ='e_endtime' type='time' class='form-control'required>"+
          "</div>"+
		  "<div class='form-group'>"+
          "<label for='e_venue'>Event Venue:</label>"+
          "<input name ='e_venue' type='text' class='form-control' placeholder='Enter venue' required>"+
          "</div>"+
		  "<div class='form-group'>"+
          "<label for='e_link'>Event Registration Link:</label>"+
          "<input name ='e_link' type='text' class='form-control' placeholder='Enter registration link' required>"+
          "</div>"+
		  "<button type='submit' class='btn btn-success' style='margin-top:20px; margin-left:5px;' name='addevent'>Add this event</button>"+
		  "</form>";
		}
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
        <title>Hub page</title>
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
	 </div>
	 <div class="hub_name">
	 <img src="backgrounds/<?php echo $_SESSION['hub_id'];?>.jpg"  style='height: 180px; width:180px; margin-left:10px;margin-top:10px; object-fit: contain'>
	 <p id="nameofhub"><?php echo $_SESSION['hub_name']?></p>
	 </div>
	 <div class="back">
	   <div class="btn-group-vertical" style="width:250px;">
          <button type="button" class="btn btn-primary" onclick="window.location='hub_desc.php'">HOME</button>
          <button type="button" class="btn btn-primary" onclick="Updateinfo();">UPDATE INFO</button>
          <button type="button" class="btn btn-primary" onclick="addevent()">ADD EVENT</button>
		  <button type="button" class="btn btn-primary" onclick='allevent()'>ALL EVENT</button>
		  <button type="button" class="btn btn-primary" onclick="window.location='logout.php'">LOGOUT</button>
       </div>
	 </div>
	   <div class="about_hub" id="display_area">
	   
		<div style='font-size:40px; color:black; margin-left:20px; font-family:cormorant garamond;'>About the Hub...<br></div>
		<p id='hub_text' style='color:black; font-size:20px; margin-left:20px;'><?php echo $_SESSION['hub_desc'];?></p>
		<div style='font-size:30px; color:black; margin-top:50px; margin-left:20px; font-family:cormorant garamond;'>Faculty Co-ordinator:<br></div>
		<h2 id='faculty_name' style=' margin-left:20px; font-size:20px; color:black;'><?php echo $_SESSION['fname'];?></h2>
		<h3 id='faculty_dept' style=' margin-left:20px; font-size:20px; color:black;'><?php echo $_SESSION['fdept'];?></h3>
		<h5 id='faculty_email' style=' margin-left:20px; font-size:20px; color:black;'><?php echo $_SESSION['femail'];?></h5>
		<div style='font-size:30px; color:black; margin-left:20px; font-family:cormorant garamond;'>Student Co-ordinators:<br></div>
		<p><div id='stud1_name' style=' margin-left:20px; text-align:left; font-size:20px; color:black;'></div>
		<div id='stud2_name' style='margin-right:20px;  text-align:right; font-size:20px; color:black;'></div></p><br>
		<p><div id='stud1_phno' style=' margin-left:20px; text-align:left; font-size:20px; color:black;'></div>
		<div id='stud2_phno' style='margin-right:20px; text-align:right; font-size:20px; color:black;'></div></p>
		</div>
		
	   </div>
	 </body>
	 </html>