<?php 
session_start();  
$v=$_GET['v'];
if(!$_SESSION['hub_id'])  
{  
    header("Location:co_event.php?v='$v'.php");//redirect to login page to secure the welcome page without login access	
}  
	
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "jiit united";
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		$sql="delete from hub_wise_event where event_id='$v'";
		mysqli_query($conn,$sql);
		$sql1="delete from events where e_id='$v'";
		if(mysqli_query($conn,$sql1))
		{
			echo "Event deleted";
		}
	mysqli_close($conn);
?>