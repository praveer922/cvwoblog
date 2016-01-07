<?php
session_start();
/*This is to check if the user is looking at someone else's profile, or is logged in and looking at his own profile. If it is his own profile,
we will allow the user to edit his info. */
if(isset($_GET['user'])) {
	$user = $_GET['user'];
} else {
	$user = $_SESSION['username'];
}

include_once("config/connection.php");

$sql = "SELECT * FROM members WHERE username = '$user' LIMIT 1";
$result = mysqli_query($dbCon,$sql);
$userarr = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html>
<?php include_once("view/head.html"); ?>
<body>
	<!--NAVBAR-->
	<?php
	if(isset($_SESSION['username'])) {
		include_once("view/navbarloggedin.php");
	} else {
		include_once("view/navbarloggedout.html");
	}
	?>

	<div class="container">
	  <!--Title-->
      <?php include_once("view/title.html"); ?>

      <div class="row">
      	<div class="col-sm-8 blog-main">

		<h1 style="text-align: center;"><?php echo $user ?>'s Profile</h1>
		<hr style="height:1px;border:none;color:#333;background-color:#333;" />

		<h2>About Me:</h2>
		<br>
		Name: <?php echo $userarr['name']; ?><br>
		Age: <?php echo $userarr['age']; ?><br>
		Bio: <?php echo $userarr['bio']; ?><br><br>
		<?php 
		//checking if it is user's own profile and if so, allowing him to edit info.
		if (isset($_SESSION['username']) && $_SESSION['username'] == $user) { ?>
			<form method="GET" action="editinfo.php">
			<input type ="submit" name = "justalink" value = "Edit Info">
		</form>
		<?php 
		} ?>
		<hr style="height:1px;border:none;color:#333;background-color:#333;" />
		<h2>My Posts:</h2>
		<br>

		<?php 
			$userID = $userarr['id'];
			include_once("config/connection.php");

			$sql = "SELECT blog.*,members.username as user FROM blog LEFT JOIN members ON blog.user = members.id WHERE user = '$userID' ORDER BY id DESC";
			$result = mysqli_query($dbCon,$sql);

			if(mysqli_num_rows($result)==0) {
				echo "{$user} has no posts yet.","<hr>";

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
					<h3><?php echo $title; ?> - <small><?php echo $subtitle; ?></small></h3>
					<p class="blog-post-meta"><?php echo $created; ?> by <a href="profile.php?user=<?php echo$user;?>"><?php echo $user; ?></a></p>
					<p><?php echo $content; ?></p>
					<hr style="height:1px;border:none;color:#333;background-color:#333;" />
					</div>
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



