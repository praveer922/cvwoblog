<?php
session_start();

if(isset($_SESSION['username'])) {
	$username = $_SESSION['username'];

	# DELETE POST
	if(isset($_POST['delete'])) {
		include_once("config/connection.php");
		$postID = $_POST['id'];

		$sql = "DELETE FROM blog WHERE id='$postID' LIMIT 1";
		$query = mysqli_query($dbCon, $sql);
		echo "<script> alert('Your post has been deleted.');
				window.location.href='manage.php'; </script>";
	}

	#EDIT POST
	if(isset($_POST['edit'])) {
		$_SESSION['id'] = $_POST['id'];
		header('Location: editpost.php');
		die();
	}


} else {
	header('Location: login.php');
	die();
}

?>

<!DOCTYPE html>
<html>
<!--head-->
<?php include_once("view/head.html"); ?>
<body>
	<!--Navbar-->
	<?php 
	include_once("view/navbarloggedin.php"); ?>
	
	<div class="container">
	<!--Title-->
    <?php include_once("view/title.html"); ?>
	
	<div class="row">
      	<div class="col-sm-8 blog-main">

		<h1 style="text-align: center">Your Posts</h1>
		<hr style="height:1px;border:none;color:#333;background-color:#333;" />

			<!--DISPLAY YOUR POSTS-->
			<?php 
			$userID = $_SESSION['userID'];

			include_once("config/connection.php");

			$sql = "SELECT blog.*,members.username as user FROM blog LEFT JOIN members ON blog.user = members.id WHERE user = '$userID' ORDER BY id DESC";
			$result = mysqli_query($dbCon,$sql);

			if(mysqli_num_rows($result)==0) {
				echo "You have no posts.";
			} else {

				while ($row = mysqli_fetch_array($result)) {
					$title = $row['title'];
					$subtitle = $row['subtitle'];
					$content = $row['content'];
					$user = $row['user'];
					$created = $row['created'];
					$id = $row['id'];
				?>
					<div class="blog-post">
					<h2 class="blog-post-title"><?php echo $title; ?> - <small><?php echo $subtitle; ?></small></h2>
					<p class="blog-post-meta"><?php echo $created; ?> by <a href="profile.php?user=<?php echo$user;?>"><?php echo $user; ?></a></p>
					<p><?php echo $content; ?></p>
					
					<form method="POST" action="manage.php">
						<input type="hidden" name="id" value="<?php echo $id; ?>">  
						<input type="submit" name="edit" value="Edit Post">
						<input type="submit" name="delete" value="Delete Post">
					</form>
					<hr style="height:1px;border:none;color:#333;background-color:#333;" />
					</div><!--/blogpost-->
				<?php
					}
			} ?>
		
	   
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