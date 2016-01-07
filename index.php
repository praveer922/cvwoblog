<?php
session_start();
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
	} ?>

	<!--BLOGMAIN-->

	<div class="container">
	  <!--Title-->
      <?php include_once("view/title.html"); ?>

      <div class="row">

        <div class="col-sm-8 blog-main">
		
			<!--BLOG POSTS-->
			<?php 

			include_once("config/connection.php");
			/*query to get all blog posts and username of the poster(blog and members tables
			related - blog.user field is the same as members.id field)
			*/
			$sql = "SELECT blog.*,members.username as user FROM blog LEFT JOIN members ON blog.user = members.id ORDER BY id DESC";
			$result = mysqli_query($dbCon,$sql);

			while ($row = mysqli_fetch_array($result)) {
				$title = $row['title'];
				$subtitle = $row['subtitle'];
				$content = $row['content'];
				$user = $row['user'];
				$created = $row['created'];
			?>
				<div class="blog-post">
		            <h2 class="blog-post-title"><?php echo $title; ?> - <small><?php echo $subtitle; ?></small></h2>
		            <p class="blog-post-meta"><?php echo $created; ?> by <a href="profile.php?user=<?php echo$user;?>"><?php echo $user; ?></a></p>

		            <p><?php echo $content; ?></p>
		            <hr style="height:1px;border:none;color:#333;background-color:#333;" />
		        </div>
			<?php
				}
			?>
	
		</div>
		<!--BLOG SIDEBAR-->
		<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Simple blog maintained by multiple writers. Anyone can view but you have to be a member to post. You can register 
            	<a href="register.php">here</a>.</p>
          </div>
          <div class="sidebar-module">
            <!--Blog Writers-->
            <?php 
				$query = "SELECT username FROM members";
				$res = mysqli_query($dbCon,$query);
			?>
            <h4>Blog Writers</h4>
            <ol class="list-unstyled">
            <?php
            	while ($row = mysqli_fetch_row($res)) {
					?><li><a href="profile.php?user=<?php echo $row[0];?>"><?php echo $row[0];?></a></li><?php
				}
			?>
			</ol>
		   </div>
		   <?php
		   if(isset($_SESSION['username'])) { ?>
			   <form action="newpost.php" method="GET">
			   	<input type="submit" value="Create a new post">
			   </form>
			<?php } ?>
		</div>

	   </div><!--/row-->
	</div><!--/container-->

	<!--footer-->
	<?php 
	include_once("view/footer.html");
	?>

	<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>

</body>
</html>