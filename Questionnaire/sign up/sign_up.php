
<?php
$name=$enroll=$year=$email=$password="";
$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "jiit united";

		// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql="Create trigger checkuser before insert on user for each row 
			begin
				declare x int;
				select enroll into x from user where enroll=new.enroll;
				if x=new.enroll then set new.enroll=NULL;
				end if;
			end;";
	//if(mysqli_query($conn,$sql))echo "trigger";
if(isset($_POST['signup'])){
	
	
	$name= $_POST['name'];
	
	$enroll= $_POST['enroll'];
	
	$year= $_POST['year'];
	
	$email= $_POST['email'];
	
	$password= $_POST['password'];
	
	$sql1 = "INSERT INTO user VALUES ('$enroll','$year','$name','$email','$password')";

	if(mysqli_query($conn,$sql1)){
		echo "<script>alert('You have successfully signed up!');</script>";
		}
	else echo"<script>alert('Already exist');</script>";
	mysqli_close($conn);
	}

?>

<!DOCTYPE html>
<html lang="en">

    <head>
		<script>
		
		function Validateform()
		{
			var pw=document.myForm.password.value;
			var cpw=document.myForm.confirm_password.value;
			var enroll=document.myForm.eno.value;
			var flag=0;
			if(isNaN(enroll))
			{
				flag=1;
				document.myForm.confirm_password.focus();
				document.getElementById("en_err").innerHTML="* Contains only digits";
			}
			else document.getElementById("en_err").innerHTML=""; 
			
			if(pw.localeCompare(cpw)!=0) {
				//document.myForm.password.focus();
				flag=1;
				document.getElementById("perr").innerHTML="* passwords do not match";
			}
			else document.getElementById("perr").innerHTML="";
			if(flag==0)
			return true;
			else return false;
		}
		</script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sign up</title>
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
	margin:10px 400px 400px;
	height:750px;
	background-color:#fff;
}
h1
{
	color:#8BC34A;
	text-align:center;
	font-size:50px;
}

</style>
<div class="box1">
<h1>SIGN UP</h1>
<div class="container">
  <form name="myForm" action="sign_up.php" onsubmit="return (Validateform())"  method="post">
      <div class="form-group">
      <label for="name">Name:</label>
      <input name ="name" type="name" class="form-control" id="name" placeholder="Enter name" required>
	  </div>
	  <div class="form-group">
	  <label for="number">Enrollment No:</label>
      <input name ="enroll" type="name" class="form-control" id="eno" placeholder="Enter enrollment no" required>
	  </div>
	  <p style="color:red;" id="en_err"></p>
	  <div class="form-group">
	  <label for="number">Year:</label>
	  <select input type="name" class="form-control" id="year" placeholder="Enter year" name="year" required>
	  <option selected disabled>Enter year</option>
      <option value="1">First</option>
      <option value="2">Second</option>
      <option value="3">Third</option>
	  <option value="4">Fourth</option>
	  </select>
	  <div class="form-group">
      <label for="email">Email:</label>
      <input name ="email" type="email" class="form-control" id="email" placeholder="Enter email" required>
	  </div>
	  <div class="form-group">
      <label for="password">Password:</label>
      <input name ="password" type="password" class="form-control" id="pwd" placeholder="Enter password" required>
      </div>
	  <div class="form-group">
      <label for="confirm_password">Confirm Password:</label>
      <input type="password" name="confirm_password" class="form-control" id="confirm_pwd" placeholder="Enter password" required>
      </div>
	  <p style="color:red;" id="perr"></p>
	  <button type="submit" class="btn btn-success" style="margin-top:20px; margin-left:5px;" name="signup">Submit</button>
  </form>
 </div>
</div>

</body>