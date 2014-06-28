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
 
		 <?php include "menu.php" ?> 
		<div id="content">
        	<h2>Train Reservation</h2>
			
     
	  <?php include "db.php";
	if (!isset($_SESSION['ID']))
	{
		echo "You are not logged in, redirecting....";
	
		header( "refresh:2;url=login.php" );
	
	}
	else
{	  
	  
	  if(isset($_POST['submit']))
	  {
	  		connect();
			$query = "SELECT * FROM trains WHERE ID =" . $_POST['submit'];
			$result = mysql_query($query);
			if($row = mysql_fetch_array($result))
			{
				?>

				<table border="1" cellspacing="2" cellpadding="4" width="700px" align="center">
					  <tr>
						<td bgcolor="#336600"><span class="style4">Train Number </span></td>
						<td bgcolor="#336600"><span class="style4">Departure Station </span></td>
						<td bgcolor="#336600"><span class="style4">Arrival Station </span></td>
						<td bgcolor="#336600"><span class="style4">Departure Time</span></td>
						<td bgcolor="#336600"><span class="style4">Arrival Time </span></td>
						
					  </tr>
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
					
					</tr>
					  
				
				
				<?php					  
	  		}
			?>
			  </table>
			  
			<?php	
			
//				check conflict
				$r = check_conflict($row['ID']);
				if($r)
				{
					?>
				<br /><br />The train you have chosen has conflicts with the following reservation(s): <br />
				<table border="1" cellspacing="2" cellpadding="4" width="700px" align="center">
					  <tr>
						<td bgcolor="#336600"><span class="style4">Train Number </span></td>
						<td bgcolor="#336600"><span class="style4">Departure Station </span></td>
						<td bgcolor="#336600"><span class="style4">Arrival Station </span></td>
						<td bgcolor="#336600"><span class="style4">Departure Time</span></td>
						<td bgcolor="#336600"><span class="style4">Arrival Time </span></td>
						
					  </tr>
					  <tr>
						<td>
							<?php echo $r['trainnumber']; ?>
						</td>
						<td>
							<?php echo $r['dep']; ?>
						</td>
						<td>
							<?php echo $r['arr']; ?>
						</td>
						<td>
							<?php echo $r['deptime']; ?>
						</td>
						<td>
							<?php echo $r['arrtime']; ?>
						</td>
					
					</tr>
					  </table>
					  
					  <br />
						<a href="index.php">  Go back and try again.</a>
				<?php	
				}
				else
				{
				
				
					insert_to_trips($_POST['submit']);
					echo "successfully added";
					header( "refresh:2;url=trips.php" );
				
				
				}
				
				
	  }
	  }
	  
	  
	  ?>
	
		

<p>&nbsp;</p>
            
      </div>
	  	<?php include 'footer.php' ?>
   </div>
</body>
</html>
