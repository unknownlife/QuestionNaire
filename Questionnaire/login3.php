<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'aditya');
   define('DB_DATABASE', 'database1');
   $count=0;
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
 session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $username = mysqli_real_escape_string($db,$_POST['enroll']);
      $password = mysqli_real_escape_string($db,$_POST['pass']); 
      
      $sql = "SELECT * FROM login1 WHERE enrollment_no = '$username' and password = '$password'";
      $result=mysqli_query($db,$sql);
}
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      //$active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $username and $password, table row must be 1 row
		
      if($count == 1) {
		  echo "Login Successfull";
          //header("location: pappu.html");
      }else {
         $error = "Your Login Name or Password is invalid";
		 echo "$error";
      }
?>