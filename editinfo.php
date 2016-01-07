<?php
session_start();

if(isset($_SESSION['username'])) {
	include_once("config/connection.php");
	$username = $_SESSION['username'];
	//Get previously saved user info, if any
	$sql = "SELECT * FROM members WHERE username='$username'";
	$result = mysqli_query($dbCon,$sql);
	$arr = mysqli_fetch_array($result);
	$name = $arr['name'];
	$age = $arr['age'];
	$bio = $arr['bio'];

	if(isset($_POST['submit'])) {
		
		$name = mysqli_real_escape_string($dbCon,$_POST['name']);
		if(is_numeric($_POST['age'])) {
			$age = (int)$_POST['age'];
		} else {
			echo "<script> alert('Invalid age. Please try again.');
				window.location.href='editinfo.php'; </script>";
			die();
		}
		$bio = mysqli_real_escape_string($dbCon,$_POST['bio']);
		
		$sql = "UPDATE members SET name ='$name', age='$age',bio='$bio' WHERE username='$username'";
		mysqli_query($dbCon,$sql);
		echo "<script> alert('Profile information saved.');
				window.location.href='profile.php'; </script>";
	}



} else {
	header('Location : login.php');
	die();
}

?>

<!DOCTYPE html>
<html>
<?php include_once("view/head.html"); ?>
<body>
	<!--NAVBAR-->
	<?php
	include_once("view/navbarloggedin.php")
	?>

	<div class="container">
	  <!--Title-->
      <?php include_once("view/title.html"); ?>

      <div class="row">
      	<div class="col-sm-8 blog-main">

		<h1>Edit Your Information</h1>
		<form method="POST" action="editinfo.php">
		Name: <br><input type ="text" name = "name" value="<?php echo $name; ?>"><br>
		Age: <br><input type="text" name = "age" value="<?php echo $age; ?>"><br>
		Bio: <br><textarea name="bio" rows="15" cols="50"><?php echo $bio; ?></textarea><br>
		<input type ="submit" name = "submit" value = "Save">
		</form>
	   <br>
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