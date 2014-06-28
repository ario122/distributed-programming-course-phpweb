<?php include 'check.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>  </title>

</head>

<body>
<div id="container">
		<?php include 'header.php' ?>
        
        <?php include 'menu.php' ?>
        
		<div id="content">
		<?php
				if (!isset($_SESSION['ID']))
				{
					echo "You are not logged in, redirecting....";
					header( "refresh:2;url=login.php" );
				
				}
				elseif ($_SESSION['username'] != "admin")
				{
					echo "You are not allowed to view these contents, redirecting....";
					header( "refresh:2;url=index.php" );
				}
				else
				{
		
		
		?>
        	<h2>Contorl Panel</h2>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
			
			<?php
				if (isset($_GET['user']))
					include 'users_trips.php'; 
				else	
					include 'traintable.php';
			?>
			
			
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
        	<p>&nbsp; </p>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
<p>&nbsp;</p>
            
      </div>
	  
	  <?php } ?>
	  	<?php include 'footer.php' ?>
   </div>
</body>
</html>
