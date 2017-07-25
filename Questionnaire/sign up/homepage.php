<?php  
session_start();//session starts here  
  
  if(isset($_POST['login']))  
{  
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "jiit united";

		// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
    $enroll=$_POST['enroll'];  
    $pwd=$_POST['pwd'];  
  
    $check_user="select * from user WHERE enroll='$enroll' AND password='$pwd'";  
  
    $run=mysqli_query($conn,$check_user);  
  
    if(mysqli_num_rows($run))  
	{  
		$_SESSION['enroll']=$enroll;//here session is used and value of $user_email store in $_SESSION. 
		while($row = mysqli_fetch_assoc($run)) {
			$_SESSION['name']=$row["name"];
			$_SESSION['email']=$row["email"];
			$_SESSION['year']=$row["year"];
			$_SESSION['pwd']=$row["password"];
		}
        echo "<script>window.open('myhub.php','_self')</script>";  
  
    }  
    else  
    {  
		
      echo "<script>alert('Enrollment or password is incorrect!')</script>";  
	  
    }  
}  
?> 

<!DOCTYPE html>
<html lang="en">

    <head>
		<script>
			function IsEmpty()
			{
				if(document.loginform.enroll.value=="" || document.loginform.pwd.value=="")
				{
					alert("Enrollment or password should not be empty");
					return false;
				}
				return true;
			}
		</script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home Page</title>
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:400,700">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">
    </head>
    <body>
	<style>
		h1,p
   {
    font-family: 'Lato', sans-serif;
    text-align: center;
	margin-top: 120px;
	font-size: 100px;
    font-weight: 700;
    color: #fff;
    line-height: 54px;
   }
   p
   {
	font-size:30px;
	margin-top:10px;
   }
   .line
   {
     font-size:18px;
	 color:black;
	 text-align:right;
	 margin-right:175px;
   }
   </style>
	<div class="container-fluid">
      <div class="top_bar">
	   <form class="form-inline" name="loginform" action="homepage.php" method="POST" onsubmit="return(IsEmpty())">
         <div class="form-group">
           <label for="email">Enrollment no.:</label>
             <input type="number" class="form-control" name="enroll" placeholder="Enrollment no.">
         </div>
         <div class="form-group">
           <label for="pwd">Password:</label>
            <input type="password" class="form-control" name="pwd" placeholder="Enter password">
         </div>
		 
         <button type="submit" class="btn btn-warning" name="login">Login</button>
       </form>
	   <a href="hub_login_new.php"><div class="line">Are you a hub co-ordinator ?CLICK HERE</div></a>
     </div>
	 <div class="top_content">
	 <div class="top-content-text wow fadeInUp">
	 <div class="divider-2"><span></span></div>
	 <h1>JIIT UNITED</h1>
	 <div class="divider-2"><span></span></div>
     <p>ALL AT ONE DESTINATION...</p>
	 </div>
	 <div class="top-content-bottom-link">
            		<a class="big-link-1" href="sign_up.php">SignUp</a>
					<a class="big-link-1" href="default.html">Guest User</a>
     </div>
	 </div>
	</div>
	
	
	</body>
</html>s
</html>