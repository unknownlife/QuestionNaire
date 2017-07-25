<?php
// Start the session
session_start();
?>
<html>
<head>
	<title></title>
</head>
<body>
<?php
$check=0;
$enum=$_POST['enroll'];
$_SESSION["enroll"] = $enum;
$password=$_POST['pass'];
$con=mysqli_connect('localhost','root','aditya','database1')or die(mysql_error());
$qu="Select name from login1 where enrollment_no=$enum";
$quq=mysqli_query($con,$qu);
$ro=mysqli_fetch_assoc($quq);
//$_SESSION['name']=$ro['name'];
$que="Select password from login1 where enrollment_no=$enum";
$retval=mysqli_query($con,$que);
while($row=mysqli_fetch_assoc($retval))
{
	if($row['pass']==$password)
		$check=1;
}
if($check)
{
	//header('.php');
echo "Login done";}
else
{
	echo "Error !!! Try again";
	//echo "<a href='login.html'>Try Again</a>";
}
?>
</body>
</html>