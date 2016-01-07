<?php
session_start();

if(isset($_SESSION['username'])) {
	$username = $_SESSION['username'];
	$postID = $_SESSION['id'];
	include_once("config/connection.php");

	$sql = "SELECT * FROM blog WHERE id='$postID' LIMIT 1";
	$result = mysqli_query($dbCon,$sql);
	$blogpost = mysqli_fetch_array($result);

	if(isset($_POST['submit'])) {
		
		$title = mysqli_real_escape_string($dbCon,$_POST['title']);
		$subtitle = mysqli_real_escape_string($dbCon,$_POST['subtitle']);
		$content = mysqli_real_escape_string($dbCon,$_POST['content']);
		
		$sql = "UPDATE blog SET title ='$title', subtitle='$subtitle',content='$content',created = NOW() WHERE id='$postID'";
		mysqli_query($dbCon,$sql);
		echo "<script> alert('Blog Entry Saved');
				window.location.href='manage.php'; </script>";
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

		<h1>Edit Your Post</h1>
		<form method="POST" action="editpost.php">
		Title: <br><input type ="text" name = "title" value="<?php echo $blogpost['title']; ?>"><br>
		Subtitle: <br><input type="text" name = "subtitle" value="<?php echo $blogpost['subtitle']; ?>"><br>
		Content: <br><textarea name="content" rows="15" cols="50"><?php echo $blogpost['content']; ?></textarea><br>
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