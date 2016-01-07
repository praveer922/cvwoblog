<?php
session_start();

if(isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
	$userID = $_SESSION['userID'];

	if(isset($_POST['submit'])) {
		include_once("config/connection.php");
		$title = mysqli_real_escape_string($dbCon,$_POST['title']);
		$subtitle = mysqli_real_escape_string($dbCon,$_POST['subtitle']);
		$content = mysqli_real_escape_string($dbCon,$_POST['content']);
		
		$sql = "INSERT INTO blog (title,subtitle,content,user,created) VALUES ('$title','$subtitle','$content','$userID',NOW())";
		mysqli_query($dbCon,$sql);
		echo "<script> alert('Blog Entry Posted');
				window.location.href='index.php'; </script>";
		
	}
} else {
	header('Location: login.php');
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

		<h1>New Post</h1>
		<form method="POST" action="newpost.php">
		Title: <br><input type ="text" name = "title"><br>
		Subtitle: <br><input type="text" name = "subtitle"><br>
		Content: <br><textarea name="content" rows="15" cols="50"></textarea><br>
		<input type ="submit" name = "submit" value = "Post Blog Entry">
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
