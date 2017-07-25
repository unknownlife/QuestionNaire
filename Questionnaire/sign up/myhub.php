<?php
session_start();  
  
if(!$_SESSION['enroll'])  
{  
  
    header("Location: homepage.php");//redirect to login page to secure the welcome page without login access.  
}  
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "jiit united";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	$x="";
	$sql="SELECT * FROM events order by start";
	$run1=mysqli_query($conn,$sql); 
	if (mysqli_num_rows($run1) > 0) {

			while($row = mysqli_fetch_assoc($run1)) {
				$x=$x."<tr><td><a href='eventforuser.php?v=".$row["e_id"]."'target='_blank' style='color:black;'>".$row["e_name"]."</a></td><td>".$row["start"]."</td><td>".$row["start_time"]."</td><td>".$row["venue"]."</td></tr>";
			}
	}	
		if(isset($_POST['changepwd']))
		{
			$newpwd=$_POST['new_password'];
			$enroll=$_SESSION['enroll'];
			$update_info="update user set password='$newpwd' WHERE enroll='$enroll'";
			$run=mysqli_query($conn,$update_info); 
			$_SESSION['pwd']=$newpwd;
			echo "<script>alert('Password Changed Successfully');</script>";
		}	
		if(isset($_POST['edit']))
		{
			$newname=$_POST['name'];
			$enroll=$_SESSION['enroll'];
			$newyear=$_POST['year'];
			$newemail=$_POST['email'];
			$update_info="update user set name='$newname',year='$newyear',email='$newemail' WHERE enroll='$enroll'";
			$run=mysqli_query($conn,$update_info); 
			$_SESSION['name']=$newname;
			$_SESSION['year']=$newyear;
			$_SESSION['email']=$newemail;
			echo "<script>alert('Changes Saved Successfully');</script>";
		}	
?>  
  
<!DOCTYPE html>
<html lang="en">
<head>
<script>

	function validatepwdchange()
	{
		var x=document.changepwdForm.old_password.value;
		var y=document.changepwdForm.new_password.value;
		var z=document.changepwdForm.cnfrm_password.value;
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
			alert("Original Password wrong");
			return false;
		}
	}
	
	function time()
	{
			var x="<?php echo $x;?>";
			document.getElementById('box2').innerHTML="<h2 style='color:black;'>Recent Events</h2>"+
	 " <table class='table table-hover table-bordered table-info' style='margin-top:10px; width:100%;'>"+
     "<thead style='font-size:20px;'>"+
      "<tr>"+
        "<th>Name</th>"+
		"<th>Date</th>"+
		"<th>Time</th>"+
		"<th>Venue</th>"+
    "</thead>"+
    "<tbody>"+x+"</tbody></table>";
	
		}	
	function changepwd()
	{
			document.getElementById('box1').innerHTML="<form name='changepwdForm' action='myhub.php' onsubmit='return (validatepwdchange())'  method='post' style='margin-top:20px; width:470px; margin-left:5px; font-size:20px;'>"+
	      "<div class='form-group'>"+
          "<label for='old_password'>Old Password:</label>"+
          "<input name ='old_password' type='password' class='form-control' placeholder='Enter old password' required>"+
          "</div>"+
		  "<div class='form-group'>"+
          "<label for='new_password'>New Password:</label>"+
          "<input name ='new_password' type='password' class='form-control' placeholder='Enter new password' required>"+
          "</div>"+
		  "<div class='form-group'>"+
          "<label for='cnfrm_password'>Confirm Password:</label>"+
          "<input name ='cnfrm_password' type='password' class='form-control' placeholder='Enter new password' required>"+
          "</div>"+
		  "<button type='submit' class='btn btn-success' style='margin-top:20px; margin-left:5px;' name='changepwd'>Change Password</button>"+
         "</form> ";
	}	 
	/*function editinfo()
	{
		document.getElementById('box1').innerHTML="<form name='myForm' action='#' method='post' style='margin-top:20px; width:470px; margin-left:5px; font-size:20px;'>"+
      "<div class='form-group'>"+
      "<label for='name'>Name:</label>"+
      "<input type='name' class='form-control' name='name' placeholder='Enter name' value='"+<?php echo $_SESSION['name'];?>"'>"+
	  "</div>"+
	  "<div class='form-group'>"+
	  "<label for='number'>Year:</label>"+
      "<input type='number' class='form-control' name='year' placeholder='Enter year' value='"+<?php echo $_SESSION['year'];?>"'>"+
	  "</div>"+
	  "<div class='form-group'>"+
      "<label for='email'>Email:</label>"+
      "<input type='email' class='form-control' name='email' placeholder='Enter email' value='"+<?php echo $_SESSION['email'];?>"'>"+
      "</div>"+
	  "<button type='submit' class='btn btn-success' style='margin-top:20px; margin-left:5px;' name='edit'>Save</button>"+
	  "</form>";
	}*/
	</script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User</title>
        <link rel="stylesheet" href="htp://fonts.googleapis.com/css?family=Lato:400,700">
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Great+Vibes">
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=cormorant+garamond">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="css/style.css">
</head>
<body style="height:1500px" class="default-background">
<style>
  .row
 {
  margin-left:140px;
  margin-top:40px;
 }
	h1
	{
	  font-size:65px;
	  text-align:left;
	  color:#fff;
	  margin-top:20px;
	  margin-left:15px;
	  font-family:"cormorant garamond";
    }
	h2
	{
	  text-align:center;
	  color:#fff;
	  font-family:'Great Vibes';
	  font-size:70px;
	  margin-top:35px;
	}
	.info
	{
	  margin-left:40px;
	  font-size:26px;
	}
</style>
     <div class="top_bar">
	    <h1 style="float:left;">JIIT UNITED</h1>
		<h2 style="float:right;  font-size:50px;">Welcome <?php echo $_SESSION["name"];?>!</h2>
	 </div>
<nav class="navbar navbar-inverse navbar-fixed nav-tabs" style="background-color:#B2DFDB; margin-top:120px;">
  <div class="container-fluid">
    <!--<div class="navbar-header">
      <a class="navbar-brand"  style="font-size:25px;" data-toggle="tab" href="#home">Home</a>
    </div>-->
    <ul class="nav navbar-nav navbar-right" style="font-size:25px;">
	<li><a class="navbar-brand"  style="font-size:25px;" data-toggle="tab" href="#home">Home</a></li>
      <li><a data-toggle="tab" href="#timeline" onclick="time();">Timeline</a></li>
      <li><a data-toggle="tab" href="#profile">My Profile</a></li>
	  <li><a href="logout.php" >Logout</a></li>
    </ul>
  </div>
</nav>
<div class="tab-content">
<div id="home" class="tab-pane fade in active">
<h2>Our Hubs...</h2>
<form action="user_hubpage.php" method="POST">
  <div class="row">
    <div class="col-md-4" style=" margin-top:40px;" >
      <button  type="submit" class="btn btn-link" name="IEEE">
        <img src="backgrounds/IEEE.jpg" class="img-circle" style="width:300px;height:200px">
      </button>
    </div>
    <div class="col-md-4"style=" margin-top:40px;" >
      <button  type="submit" class="btn btn-link" name="GDG">
        <img src="backgrounds/GDG.jpg" class="img-circle" style="width:300px;height:200px">
      </button>
    </div>
	<div class="col-md-4" style=" margin-top:40px;">
      <button  type="submit" class="btn btn-link" name="THESPIAN">
        <img src="backgrounds/THESPIAN.jpg" class="img-circle" style="width:300px;height:200px">
      </button>
    </div>
  </div>
    <div class="row">
    <div class="col-md-4">
      <button  type="submit" class="btn btn-link" name="UCR">
        <img src="backgrounds/UCR.png" class="img-circle" style="width:300px;height:200px">
      </button>
    </div>
    <div class="col-md-4">
      <button  type="submit" class="btn btn-link" name="KNUTH">
        <img src="backgrounds/KNUTH.jpg" class="img-circle" style="width:300px;height:200px">
      </button>
    </div>
	    <div class="col-md-4">
      <button  type="submit" class="btn btn-link" name="MMV">
        <img src="backgrounds/MMV.jpg" class="img-circle" style="width:300px;height:200px">
      </button>
    </div>
  </div>
  </form>
 </div>
<div id="profile" class="tab-pane fade">
  <div class="box" id="box1">
  <div class="info">
	   Name:<p id="name"><?php echo $_SESSION['name'];?></p>
	   Enrollment No:<p id="e_no"><?php echo $_SESSION['enroll'];?></p>
	   Year:<p id="year"><?php echo $_SESSION['year'];?></p>
	   Email:<p id="email"><?php echo $_SESSION['email'];?></p>
	</div>
	   <button type="submit" class="btn btn-default" style="margin-top:40px; margin-left:20px;" onclick="changepwd()">Change Password</button>
	  <button type="submit" class="btn btn-default" style="margin-top:40px; margin-left:240px;" onclick="editinfo()">Edit Info</button>
  </div>
</div>
<div id="timeline" class="tab-pane fade">
<div class="box" id="box2">
</div>
</div>
</div>
</body>
</html>

