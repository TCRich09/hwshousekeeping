<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id FROM admin WHERE username = '$myusername' and passcode = '$mypassword'";
      $result = mysqli_query($db,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         session_register("myusername");
         $_SESSION['login_user'] = $myusername;
         
         header("location: welcome.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>
	<head>
		<body>
		<?php if(isset($response)) { echo $response; } ?>
		<div id="templatemo_main_wrapper">
		<div id="templatemo_header_wrapper">
		<div id="templatemo_header">
			<div id="site_title"> <a href="#">All in one place!</a> </div>
			<p id="intro_text">A site created for housekeeping. Making it easier to complete the day to day duties by having everything all in one place.</p>
			</div>
		</div>
		<?php echo password_hash( "SecretPassword", PASSWORD_BCRYPT); ?>
		<div id="templatemo_main">
		<div id="content">
			<div class="section" id="login_form">
			<div class="half left">
				<h1>LOGIN</h1>
				<form action="#" id="login_form form" method="post" name="login">
					<label for="username">Username:</label>
					<input class="required input_field" id="Username" name="username" type="text" />
					<div class="cleaner h10"></div>
					<label for="password">Password:</label>
					<input class="required input_field" id="Password" name="pass" type="password" />
					<div class="cleaner h10"></div>
					<input class="login_btn left" id="login" name="login" type="submit" value="Login" />
				</form>
			</div>
			</div>
		</div>
		</div>
		</div>
		</body>
	</head>
</html>
		
		