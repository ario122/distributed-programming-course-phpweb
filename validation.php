<?php include 'check.php' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>  </title>
<style type="text/css">
<!--
.style4 {color: #FFFFFF; font-weight: bold; text-decoration:none; }
-->
</style>
</head>

<body>
<div id="container">
		<?php include 'header.php' ?>   
        <?php include 'db.php' ?>
        <?php include 'menu.php' ?>
        
		<div id="content">
        	<h2>Your Trip</h2>
        	<?php
			
				connect();
				if (!isset($_SESSION['ID']))
				{
					echo "You are not logged in, redirecting....";
				
					header( "refresh:2;url=login.php" );
				
				}
				else
				{
				$sql = "SELECT * FROM trips tr, trains t WHERE tr.trainID = t.ID AND userID =" . $_SESSION['ID'] . " ORDER BY deptime";
				$result = mysql_query($sql);
				if (!$row = mysql_fetch_array($result))
				{
					echo " You do not have any reservation for your trip.";
				}
				else{
				?>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<table border="1" cellspacing="2" cellpadding="4" width="700px" align="center">
					  <tr>
						<td bgcolor="#336600"><span class="style4">Train Number </span></td>
						<td bgcolor="#336600"><span class="style4">Departure Station </span></td>
						<td bgcolor="#336600"><span class="style4">Arrival Station </span></td>
						<td bgcolor="#336600"><span class="style4">Departure Time</span></td>
						<td bgcolor="#336600"><span class="style4">Arrival Time </span></td>
						
					  </tr>
					  <?php 
					  
					$good = 1;
					  $state = "good";
					  
					  do { 
					  if (isset($prevCity))
					  {
							if ($prevCity == $row['dep'])
								$state="good";
							else
								$state="bad";
					  }
					  $prevCity = $row['arr'];
					  if ($state == "bad")
					  	$good = 0;
					  
					  
					  ?>
					  <tr 
					  <?php if ($state == "bad") echo "style='background-color:#FF6F84'"; ?>
					  
					  >
						<td>
							<?php echo $row['trainnumber']; ?>
						</td>
						<td>
							<?php echo $row['dep']; ?>
						</td>
						<td>
							<?php echo $row['arr']; ?>
						</td>
						<td>
							<?php echo $row['deptime']; ?>
						</td>
						<td>
							<?php echo $row['arrtime']; ?>
						</td>
					
					</tr>
					<?php }while($row = mysql_fetch_array($result)); ?>
					  </table>
					  	<p>&nbsp;</p>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
			
			<?php
				if ($good == 0)
					echo "Above issues were found analyzing your trip.";
				else
					echo "No issue was found analyzing your trip.";
			
			
			
			 }} ?>
			<p>&nbsp;</p>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
			
			
			
			
		    <p>&nbsp;</p>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
<p>&nbsp;</p>
            
      </div>
	  	<?php include 'footer.php' ?>
   </div>
</body>
</html>
