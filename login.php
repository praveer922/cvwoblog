<?php
session_start();

if(isset($_POST['submit'])) {
	include_once("config/connection.php");
	$username = strip_tags($_POST['username']);
	$password = strip_tags($_POST['password']);

	$sql = "SELECT id,username,password FROM members WHERE username='$username' LIMIT 1";

	$query = mysqli_query($dbCon, $sql);

	if ($query) {
		$row = mysqli_fetch_row($query);
		$userID = $row[0];
		$dbUsername = $row[1];
		$dbPassword = $row[2];
	}

	if($username == $dbUsername && $password == $dbPassword) {
		$_SESSION['userID'] = $userID;
		$_SESSION['username'] = $username;
		echo "<script> alert('You have successfully logged in.');
				window.location.href='index.php'; </script>";
	} else {
		echo "<script> alert('Incorrect username or password. Please try again.');
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
		echo "<br>","<p>You are already logged in.</p>";
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

		<h1>Login</h1>
		<form method="POST" action="login.php">
			<input type="text" placeholder="Username" name="username"><br>
			<input type="password" placeholder="Password" name="password"><br>
			<input type="submit" name="submit" value="Log In">
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