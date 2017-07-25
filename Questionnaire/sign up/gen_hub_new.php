<?php
	
if($_SERVER["REQUEST_METHOD"]== "POST"){
    if (isset($_POST['GDG'])) {
        $hub_id="GDG";
    }
    else if (isset($_POST['IEEE'])) {
        $hub_id="IEEE";
    }
    else if (isset($_POST['UCR'])) {
        $hub_id="UCR";
    }
    else if (isset($_POST['THESPIAN'])) {
        $hub_id="THESPIAN";
    }
    else if (isset($_POST['MMV'])) {
        $hub_id="MMV";
    }
    else if (isset($_POST['KNUTH'])) {
        $hub_id="KNUTH";
    }
	
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

	mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>General hub page</title>
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
	</style>
     <div class="top_bar">
	    <h1>JIIT UNITED</h1>
		<a href="default.html"><button style="margin:0px 15px 0px 1160px;background-color:#B2DFDB; font-size:18px;"><i class="fa fa-arrow-circle-left"></i> GO BACK</button></a>
	 </div>
	 <div class="hub_name">
	 <img src="backgrounds/<?php echo $hub_id;?>.jpg"  style='height: 180px; width:180px; margin-left:10px;margin-top:10px; object-fit: contain'>
	 <p id="nameofhub"><?php echo $hub_name?></p>
	 </div>
	 <div class="back">
	   <div class="about_hub">
	    <div style="font-size:40px; color:black; margin-left:20px; font-family:cormorant garamond;">About the Hub...<br></div>
		<p id="hub_text" style="color:black; font-size:20px;"><?php echo $hub_desc;?></p>
		<div style="font-size:30px; color:black; margin-top:500px; margin-left:20px; font-family:cormorant garamond;">Faculty Co-ordinator:<br></div>
		<h2 id="faculty_name" style=" margin-left:20px; font-size:20px; color:black;"><?php echo $fname;?></h2>
		<h4 id="faculty_phno" style=" margin-left:20px; font-size:20px; color:black;"><?php echo $fdept;?></h4>
		<h4 id="faculty_email" style=" margin-left:20px; font-size:20px; color:black;"><?php echo $femail;?></h4>
		<div style="font-size:30px; color:black; margin-left:20px; font-family:cormorant garamond;">Student Co-ordinators:<br></div>
		<p><div id="stud1_name" style=" margin-left:20px; text-align:left; font-size:20px; color:black;"></div>
		<div id="stud2_name" style="margin-right:20px;  text-align:right; font-size:20px; color:black;"></div></p><br>
		<p><div id="stud1_phno" style=" margin-left:20px; text-align:left; font-size:20px; color:black;"></div>
		<div id="stud2_phno" style="margin-right:20px; text-align:right; font-size:20px; color:black;"></div></p>
	   </div>
	 </div>
	 
	</body>
</html>