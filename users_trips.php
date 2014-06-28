
<?php
	include "db.php";
	connect();
?>

<p> Showing trips for this user: </p>
<form action="controlpanel.php" method="get">
  <select name="user">
  <?php
  				$query = "SELECT username FROM users where username <> 'admin'";
				$result = mysql_query($query);
				while($row = mysql_fetch_array($result))
				{?>
                <option>  <?php echo $row['username']; ?>	</option>
				<?php } ?>
  </select>
	<input type="submit" name="" value="Go" />
</form>


<p>&nbsp;</p>
<p>&nbsp;</p>


<?php

	if (isset($_GET['user']) && $_GET['user']!="")
	{
		$sql = "SELECT t.arr, t.dep, t.deptime, t.arrtime, t.trainnumber  FROM trips tr, trains t, users u WHERE tr.trainID = t.ID AND u.ID = tr.userID AND u.username ='" . $_GET['user'] . "'";
		$result = mysql_query($sql);
		if(!$row = mysql_fetch_array($result))
		{
			echo "<p>This user has no trips.</p>";
		}
		else
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
					</tr>
					<?php }while($row = mysql_fetch_array($result)); ?>
				</table>
<?php
		}			
	}
?>
