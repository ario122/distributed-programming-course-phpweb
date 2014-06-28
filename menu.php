<div id="menu">
        	<ul>
            	<li class="menuitem"><a href="index.php">Home</a></li>
				<?php
				session_start();

				$inactive = 300;
 				
				if(isset($_SESSION['username']))
				{
					if(isset($_SESSION['timeout']) ) 
					{
						$session_life = time() - $_SESSION['timeout'];
						
						if($session_life > $inactive)
						{ 
							session_destroy(); 
							header("Location: signout.php"); 
						}
					}
					$_SESSION['timeout'] = time();
				}
				
				
				if(!isset($_SESSION['username']))
				{
				?>
                <li class="menuitem"><a href="signup.php">Sign up</a></li>
                <li class="menuitem"><a href="login.php">Log in</a></li>
				<?php } elseif ($_SESSION['username']=="admin") {?>
					<li class="menuitem"><a href="controlpanel.php?user">Travellers Trips</a></li>
					<li class="menuitem"><a href="controlpanel.php">Trains List</a></li>
				  <li class="menuitem"><a href="signout.php">Log off</a></li>
				
				
				
				<?php }else{ ?>
					<li class="menuitem"><a href="trips.php">My trips</a></li>
					<li class="menuitem"><a href="validation.php">Validate Journey</a></li>
				  <li class="menuitem"><a href="signout.php">Log off</a></li>
				 <?php } ?>
				  
            </ul>
			<div class ="welcome">
			<?php
					
					if(isset($_SESSION['username']))
					{
						echo "Logged in as:  " . $_SESSION['username'];
					}
			?>
			</div>
</div>
