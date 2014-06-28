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
				
				if (isset($_POST['submit']))
				{
					$sql = "DELETE FROM trips WHERE tripID = " . $_POST['submit'];
					$result = mysql_query($sql);
				}
				
				
				$sql = "SELECT * FROM trips tr, trains t WHERE tr.trainID = t.ID AND userID =" . $_SESSION['ID'];
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
				<form action="trips.php" method="post">
				<table border="1" cellspacing="2" cellpadding="4" width="700px" align="center">
					  <tr>
						<td bgcolor="#336600"><span class="style4">Train Number </span></td>
						<td bgcolor="#336600"><span class="style4">Departure Station </span></td>
						<td bgcolor="#336600"><span class="style4">Arrival Station </span></td>
						<td bgcolor="#336600"><span class="style4">Departure Time</span></td>
						<td bgcolor="#336600"><span class="style4">Arrival Time </span></td>
						<td bgcolor="#336600"><span class="style4">&nbsp;</span></td>
						
					  </tr>
					  <?php do { ?>
					  <tr>
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
						<td>
							<input type='image' name='submit' src='images/DeleteRed.png' value='<?php echo $row['tripID'] ?>' width='30' height='30'/>
						</td>
					
					</tr>
					<?php }while($row = mysql_fetch_array($result)); ?>
					  </table>
					  </form>
				<p>&nbsp;</p>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
			<?php
			
				$sql = "select TotalSeconds / 3600 as Hours, (TotalSeconds % 3600) / 60 as Minutes, TotalSeconds % 60 as Seconds \n"
				. "from ( \n"
				. "\n"
				. "select sum(TIMESTAMPDIFF(second, deptime, arrtime)) as TotalSeconds\n"
				. "\n"
				. "\n"
				. " from trains t, trips tr\n"
				. "\n"
				. "WHERE t.ID = tr.trainID AND userID = 5\n"
				. "\n"
				. "\n"
				. " ) as times";
				$result = mysql_query($sql);
				$row = mysql_fetch_array($result);				
				echo "Your total time onboard in this trip will be: ";
				echo intval($row['Hours']) . ":" . intval($row['Minutes']) . ":" . intval($row['Seconds']);
			
			
			
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
