<?php 
session_start();

	if(isset($_POST['submit'])) {
		include_once("config/connection.php");
		$username = strip_tags($_POST['username']);
		$password = strip_tags($_POST['password']);
		$sqli = "SELECT * FROM members WHERE username='$username'";
		$res = mysqli_query($dbCon,$sqli);
		if(mysqli_num_rows($res)>0) {//if there is a result means the username exists
			echo "<script> alert('That username already exists. Please choose a different one.');
				window.location.href='register.php'; </script>";
		} else {
			$sql = "INSERT INTO members (username,password) VALUES ('$username','$password')";
			mysqli_query($dbCon,$sql);
			echo "<script> alert('You have been registered. Please log in.');
					window.location.href='login.php'; </script>";
		}
	}


?>


<!DOCTYPE html>
<html>
<?php include_once("view/head.html"); ?>
<body>
	<!--NAVBAR-->
	<?php
	if(isset($_SESSION['username'])) {
		include_once("view/navbarloggedin.php");
		echo "<br>","<p>You are already logged in. Please log out first.</p>";
		die();
	} else {
		include_once("view/navbarloggedout.html");
	}
	?>

	<div class="container">
	  <!--Title-->
      <?php include_once("view/title.html"); ?>

      <div class="row">
      	<div class="col-sm-8 blog-main">

		<h1>Create a New Account</h1>
		<form method="POST" action="register.php">
			<input type="text" placeholder="Choose a username" name="username"><br>
			<input type="password" placeholder="Choose a password" name="password"><br>
			<input type="submit" name="submit" value="Register">
		</form>
	   
	   </div><!--/blogmain-->
	   <!--sidebar-->
	   <?php include_once("view/sidebar.php"); ?>

	  </div><!--/row-->
	</div><!--/container-->

	<!--footer-->
	<?php include_once("view/footer.html"); ?>

	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>

</body>
</html>