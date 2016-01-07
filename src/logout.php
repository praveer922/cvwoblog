<?php
session_start();
session_destroy();

?>


<!DOCTYPE html>
<html>
<?php include_once("view/head.html"); ?>
<body>
	<!--NAVBAR-->
	<?php
	include_once("view/navbarloggedout.html");
	?>

	<div class="container">
	  <!--Title-->
      <?php include_once("view/title.html"); ?>

      <div class="row">
      	<div class="col-sm-8 blog-main">

		<h2>You have logged out.</h2>
	   
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