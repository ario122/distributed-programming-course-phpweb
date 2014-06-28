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
										if(isset($_SESSION['username']))
										  unset($_SESSION['username']);
										session_destroy();

											
										echo "<div id ='message'>";
										echo "You are logged off......<br> ";
										echo "Redirecting Now ....";
										header( "refresh:4;url=index.php" );
										echo "</div>";

?>
<p>&nbsp;</p>
            
      </div>
	  	<?php include 'footer.php' ?>
   </div>
</body>
</html>
