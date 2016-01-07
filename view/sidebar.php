<?php include_once("config/connection.php"); ?>
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
		</div>