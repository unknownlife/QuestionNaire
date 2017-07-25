<html>
<head>
<script type="text/javascript" >
function chncol1()
{var refa=document.getElementById("uid");
refa.style.color="white";
}
function chncol2()
{var refa=document.getElementById("fid");
refa.style.color="white";
}
function chncol3()
{var refa=document.getElementById("lid");
refa.style.color="white";
}
function chncol4()
{var refa=document.getElementById("eid");
refa.style.color="white";
}
function chncol5()
{var refa=document.getElementById("pid");
refa.style.color="white";
}
</script>
<title>
Sign Up
</title>
<link rel="stylesheet" href="dbms4.css">
</head>
<body background="Images\adi.jpg" style="background-size:cover;">
<div class="box">
<center><strong><h1 style="color:#13232f;font-size:40px;margin-top:5%;position:absolute;margin-left:35%;font-size:70px;font-weight:bold;">SIGN UP </h1></strong></center>
<center><form method="post">
<input type="number" placeholder="User Id*" id="uid" name="enroll" style="font-size:26px;width:125%;margin-top:25%;margin-left:-10%;background-color:#13232f;" required onKeyUp="chncol1();"><br>
<input type="text" placeholder="First Name*" name="first"  id="fid"style="font-size:26px;width:125%;margin-top:4%;margin-left:-10%;background-color:#13232f;"  required onKeyUp="chncol2();">
<input type="text" placeholder="Last Name*" name="last" id="lid" style="font-size:26px;width:125%;margin-top:4%;margin-left:-10%;background-color:#13232f" required onKeyUp="chncol3();"><br>
<input type="text" placeholder="Email id*" name="email" id="eid" style="font-size:26px;width:125%;margin-top:4%;margin-left:-10%;background-color:#13232f" required onKeyUp="chncol4();">
<input type="password" placeholder="Set a Password*" name="pass" id="pid"  style="font-size:26px;width:125%;margin-left:-10%;margin-top:4%;background-color:#13232f" required>
<center><input type="submit" name="submit" value="GET STARTED !" style="color:white;margin-top:6%;width:50%;background-color:#0e4c93;margin-left:-10%;font-size:40px;border-radius:5px" onKeyUp="chncol5();"></center>
</form></center>
</div>
</body>
</html>
<?php
$v1=$v2=$v3=$v4=$v5="";
if(isset($_POST["submit"]))
{$v1=$_POST["enroll"];
$v2=$_POST["first"];
$v3=$_POST["last"];
$v4=$_POST["email"];
$v5=$_POST["pass"];
mysql_connect("localhost","root","aditya");
mysql_select_db("database1");
$ritik="INSERT INTO login1 VALUES('$v1','$v2','$v3','$v4','$v5')" ;
mysql_query($ritik);
}
?>