<?php include 'check.php' ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>  </title>
<script type="text/javascript" language="javascript1.5">
function validate_form()
{


	var y = document.forms["search"]["year"].value;


		if (y == "" || y == null || y==false)
		{
			return false;
		}
	return true;

}

</script>
</head>

<body>

<div id="container">

		<?php include 'header.php' ?>
        <?php include 'db.php' ?>
        <?php include 'menu.php' ?>
		
		<?php
			
			connect();	
			if(isset($_SESSION['ID']))
			{
				$query = "SELECT changed FROM users WHERE ID = " . $_SESSION['ID'];
				$result = mysql_query($query);
						
						
				if($row = mysql_fetch_array($result))
				{
					if($row['changed'] == 1 || $row['changed'] == 2)
					{
						echo        "<div id='message2'>";
						if ($row['changed'] == 1)
							echo "There has been a change in your reserved trains schedule.";
						elseif ($row['changed'] == 2)
							echo "One of your trains has been canceled.";
						echo 		"</div>";			
					}
				}
				
				$query = "UPDATE users SET changed = NULL  WHERE ID = " . $_SESSION['ID'];
				$result = mysql_query($query);
			}					
		?>
		<div id="content">
        	<h2>Home</h2>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
			
			<?php
			
				if(isset($_POST['Submit']))
				{
					$deptime = $_POST['year'] . "-" . $_POST['month'] . "-" . $_POST['day'] . " " . $_POST['hour'] . ":" .$_POST['minute'] . ":" . "00";
					$query = "SELECT * FROM trains WHERE arr = '" . $_POST['arr'] . "' and dep ='" . $_POST['dep'] . "' and deptime >'" . $deptime . "'";
					$result = mysql_query($query);
					if(!$row = mysql_fetch_array($result))
					{
						echo "no train found with that specifications.";
					
					}
					else
					{
					?>
					<form method="post" action="trainreservation.php"> 
					<table border="1" cellspacing="2" cellpadding="4" width="700px" align="center">
					  <tr>
						<td bgcolor="#336600"><span class="style4">Train Number </span></td>
						<td bgcolor="#336600"><span class="style4">Departure Station </span></td>
						<td bgcolor="#336600"><span class="style4">Arrival Station </span></td>
						<td bgcolor="#336600"><span class="style4">Departure Time</span></td>
						<td bgcolor="#336600"><span class="style4">Arrival Time </span></td>
						<td bgcolor="#336600"><span class="style4">&nbsp;</span></td>
					  </tr>
					
					<?php
					do
					{
					?>
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
							<input type='image' name='submit' src='images/Check.png' value='<?php echo $row['ID'];?>' width='30' height='30'/>
						
						</td>
					</tr>
					<?php					
					}while($row = mysql_fetch_array($result));
					?>
					</table>
					</form>
					<?php
				}}
				else
				{
			
			
			?>

			<form action="index.php" method="post" name="search" onsubmit="return validate_form()">
        	<table width="500" border="1" cellspacing="2" cellpadding="4">
              <tr>
                <td>Departure Station:</td>
                <td><select name="dep">
				<?php
				connect();
				$query = "SELECT distinct dep FROM trains";
				$result = mysql_query($query);
				while($row = mysql_fetch_array($result))
				{?>
                  <option>  <?php echo $row['dep']; ?>	</option>
                  <?php } ?>
                </select>
                </td>
              </tr>
              <tr>
                <td>Arrival Station: </td>
                <td><select name="arr">
				<?php
				$query = "SELECT distinct arr FROM trains";
				$result = mysql_query($query);
				while($row = mysql_fetch_array($result))
				{?>
                  <option><?php echo $row['arr']; ?></option>
				<?php } ?>
                </select></td>
              </tr>
              <tr>
                <td>Departure Date and Time: </td>
                <td>
				(Year /         
				 Month / Day - Hour / Minute) <br />
				<input name= "year" type="text" size="20" maxlength="4" style="width:50px;"/>
				<select name="month">
				<?php 
				$i=1;
				while ($i<13)
				{
                 echo "<option>" . $i . "</option>";
				 $i = $i+1;
				}
				?>
                </select>
				<select name="day">
				<?php 
				$i=1;
				while ($i<31)
				{
                 echo "<option>" . $i . "</option>";
				 $i = $i+1;
				}
				?>
                </select>
-				
				<select name="hour">
				<?php 
				$i=0;
				while ($i<24)
				{
                 echo "<option>" . $i . "</option>";
				 $i = $i+1;
				}
				?>
                </select>
				<select name="minute">
				<?php 
				$i=0;
				while ($i<60)
				{
                 echo "<option>" . $i . "</option>";
				 $i = $i+1;
				}
				//disconnect();
				?>
                </select>
				</td>
              </tr>
       
              <tr>
                <td>&nbsp;</td>
                <td><input type="submit" name="Submit" value="Search" /></td>
              </tr>
            </table>
			</form>
			<?php } ?>
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
