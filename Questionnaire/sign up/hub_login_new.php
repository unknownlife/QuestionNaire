<?php  
session_start();//session starts here  
  if(isset($_POST['hub_login']))  
	{  
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "jiit united";

		// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
    $hub_id=$_POST['hub_id'];  
    $pwd=$_POST['pwd'];  
  
    $check_hub="select * from hub_login WHERE hub_id='$hub_id' AND hub_pwd='$pwd'";  
  
    $run=mysqli_query($conn,$check_hub);  
  
    if(mysqli_num_rows($run))  
	{  
		$_SESSION['hub_id']=$hub_id;//here session is used and value of $user_email store in $_SESSION. 
		$_SESSION['pwd']=$pwd;
	$sql = "SELECT * FROM hubs WHERE (hub_id='$hub_id')";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
    
		while($row = mysqli_fetch_assoc($result)) {
			$_SESSION['hub_name']=$row["hubname"];
			$_SESSION['hub_desc']=$row["hub_desc"];
			$_SESSION['fname']=$row["f_name"];
			$_SESSION['fdept']=$row["f_dept"];
			$_SESSION['femail']=$row["f_email"];
		}
	}
	
        echo "<script>window.open('hub_desc.php','_self')</script>";  
  
    }  
    else  
    {  
		
      echo "<script>alert('Enrollment or password is incorrect!')
	  </script>";
    }  
}  
?> 

<!DOCTYPE html>
<html lang="en">

    <head>
		<script>
			function IsEmpty()
			{
				if(document.hubloginform.hub_id.value=="" || document.hubloginform.pwd.value=="")
				{
					alert("HUB ID or password should not be empty");
					return false;
				}
				return true;
			}
		</script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>co_login page</title>
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:400,700">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
    </head>
<body style="height:1500px" class="default-background">

<style>
  .form-group
 {
	margin-top:20px;
	width:470px;
	margin-left:5px;
	font-size:20px;
 }
.box1
{
	margin:120px 400px 400px;
	height:420px;
	background-color:#fff;
}
h1
{
	color:#8BC34A;
	text-align:center;
	font-size:40px;
}
</style>
<div class="box1">
<br><h1>LOG INTO YOUR HUB</h1>
<div class="container">
  <form name="hubloginform" action="hub_login_new.php"  method="post"  onsubmit="return(IsEmpty())">
	  <div class="form-group">
      <label for="hub_id">HUB ID:</label>
      <input name ="hub_id" type="text" class="form-control" placeholder="Enter ID" required>
      </div>
	  <div class="form-group">
      <label for="password">Password:</label>
      <input name ="pwd" type="password" class="form-control" placeholder="Enter password" required>
      </div>
	  <button type="submit" class="btn btn-success" style="margin-top:20px; margin-left:5px;" name="hub_login">Submit</button>
   </form>
 </div>
</div>

</body>