<style type="text/css">
.txt {
	width: 90px;
}
.tables
{
font-size:12px;
}

</style>
<a href="controlpanel.php?act=a"><img src="images/Button-Add-icon.png" width="30" height="30" border="0"></a>
<?php
	include "db.php";

	connect();
//	$query = "SELECT count(*) FROM trains";
//	$result = mysql_query($query);
//	$row = mysql_fetch_array($result);
//	print_r($row);



	if (isset($_POST['submit']))
	{
		
		if ($_GET['act'] == 'd')
		{
			if ($_POST['submit']=='yes')
			{
				$query = "DELETE FROM trains WHERE ID = " . $_GET['id'];
				//echo $query;
				$result = mysql_query($query);
				
				$sql = "UPDATE users \n"
				. "SET changed = 2 \n"
				. "WHERE ID in \n"
				. "(SELECT userID FROM trains t, trips tr WHERE t.ID = tr.trainID AND t.ID =". $_GET['id'] .")";
				$result = mysql_query($sql);
				
				
				echo "Record successfully deleted.";
				header( "refresh:1;url=controlpanel.php" );
			}
			header( "location:controlpanel.php" );
		}
		if ($_GET['act'] == 'e')
		{
			if ($_POST['submit']=='yes')
			{
				$query = "UPDATE trains SET arr ='" . $_POST["txteditarr"] . "', dep = '" . $_POST["txteditdep"] . "', arrtime='" . $_POST["txteditarrtime"] . "', deptime='" . $_POST["txteditdeptime"]  .  "', trainnumber='" . $_POST["txtedittrainnumber"] . "' WHERE ID = " . $_GET['id'];
				//echo $query;
				$result = mysql_query($query);
				
				$sql = "UPDATE users \n"
						. "SET changed = 1 \n"
						. "WHERE ID in \n"
						. "(SELECT userID FROM trains t, trips tr WHERE t.ID = tr.trainID AND t.ID =". $_GET['id'] .")";
				$result = mysql_query($sql);
				
				echo "Record successfully updated.";
				header( "refresh:1;url=controlpanel.php" );
			}
			header( "location:controlpanel.php" );
		}
		if($_GET['act'] == 'a')
		{
			if ($_POST['submit']=='yes')
			{
			
				$query = "INSERT INTO trains (trainnumber,arr,dep,arrtime,deptime) VALUES ('" . $_POST["txtaddtrainnumber"] . "','" . $_POST["txtaddarr"]. "','" .  $_POST["txtadddep"] . "','" . $_POST["txtaddarrtime"] . "','" . $_POST["txtadddeptime"] . "')";
				$result = mysql_query($query);
				echo "Record successfully added.";
				header( "refresh:1;url=controlpanel.php" );
			}
			else
			{
				header( "location:controlpanel.php" );
			}
		}
	}
	$query = "SELECT * FROM trains";
				
	$result = mysql_query($query);
	
	
	if (!$row = mysql_fetch_array($result))
	{
	echo "No train entered yet.<br>";
	
	if(isset($_GET['act']) && 	$_GET['act'] == 'a')
	{
	?>
	
<table border="1" cellspacing="2" cellpadding="4" width="600px" align="center" class="tables">
  <tr>
    <td bgcolor="#336600"><span class="style4">Train Number </span></td>
    <td bgcolor="#336600"><span class="style4">Departure Station </span></td>
    <td bgcolor="#336600"><span class="style4">Arrival Station </span></td>
    <td bgcolor="#336600"><span class="style4">Departure Time</span></td>
    <td bgcolor="#336600"><span class="style4">Arrival Time </span></td>
    <td bgcolor="#336600"><span class="style4">&nbsp;</span></td>
	</tr>
	<form id='form1' name='form1' method='post' action='controlpanel.php?act=a'>

	<tr>
	<td> 
		<input type='text' name ='txtaddtrainnumber' class="txt" />
	</td>
	<td> 
		<input type='text' name ='txtadddep' class="txt" />
	</td>
	<td> 
		<input type='text' name ='txtaddarr' class="txt" />
	</td>
	<td> 
		<input type='text' name ='txtadddeptime' />
	</td>
	<td> 
		<input type='text' name ='txtaddarrtime' />
	</td>
	<td> 
		<input type='image' name='submit' src='images/Check.png' value='yes' width='30' height='30'/>
		<input type='image' name='submit' src='images/no.png' value='no' width='30' height='30'/>
	</td>
	</tr>
	</form>
</table>
	<?php
	}
	
	
	}
	else
	{
	?>
<table border="1" cellspacing="2" cellpadding="4" width="700px" align="center" class="tables">
  <tr>
    <td bgcolor="#336600"><span class="style4">Train Number </span></td>
    <td bgcolor="#336600"><span class="style4">Departure Station </span></td>
    <td bgcolor="#336600"><span class="style4">Arrival Station </span></td>
    <td bgcolor="#336600"><span class="style4">Departure Time</span></td>
    <td bgcolor="#336600"><span class="style4">Arrival Time </span></td>
    <td bgcolor="#336600"><span class="style4">
	<?php
	if (isset($_GET['act']) && $_GET['act'] == 'd')
		echo "Delete?";
	?>
	&nbsp;</span></td>
  </tr>

	
	<?php
	do
	{

 	echo  "<tr>";
	if(isset($_GET['act']) && 	$_GET['act'] == 'e' && $row['ID'] == $_GET['id'])
	{
		echo "<form id='form1' name='form1' method='post' action='controlpanel.php?act=e&id=";
		echo $_GET['id'] ;
		echo "'>";
				
		echo   "<td>";
		echo "  <input type='text' value='";
		echo $row['trainnumber'];
		echo "' name ='txtedittrainnumber' class='txt' />";
		echo "</td>";
		echo   "<td>";
		echo "  <input type='text' value='";
		echo $row['dep'];
		echo "' name ='txteditdep' class='txt' />";
		echo "</td>";
		echo   "<td>";
		echo "  <input type='text' value='";
		echo $row['arr'];
		echo "' name ='txteditarr' class='txt'/>";
		echo "</td>";
		echo   "<td>";
		echo "  <input type='text' value='";
		echo $row['deptime'];
		echo "' name ='txteditdeptime' />";
		echo "</td>";
		echo   "<td>";
		echo "  <input type='text' value='";
		echo $row['arrtime'];
		echo "' name ='txteditarrtime' />";
		echo "</td>";
		echo   "<td>";
		echo "<input type='image' name='submit' src='images/Check.png' value='yes' width='30' height='30'/>";
		echo "<input type='image' name='submit' src='images/no.png' value='no' width='30' height='30'/>";
		echo "</td>";
		echo "</from>";
		
	}
	else
	{
		echo   "<td>";
		echo	$row['trainnumber'];
		echo "</td>";
		echo   "<td>";
		echo	$row['dep'];
		echo "</td>";
		echo   "<td>";
		echo	$row['arr'];
		echo "</td>";
		echo   "<td>";
		echo	$row['deptime'];
		echo "</td>";
		echo   "<td>";
		echo	$row['arrtime'];
		echo "</td>";
		if(isset($_GET['act'])) 
		{
			if(	$_GET['act'] == 'd')
			{
				echo "<td>";
				if ($row['ID'] == $_GET['id'])
				{	
					echo "<form id='form1' name='form1' method='post' action='controlpanel.php?act=d&id=";
					echo $_GET['id'] ;
					echo "'>";
					echo "<input type='image' name='submit' src='images/Check.png' value='yes' width='30' height='30'/>";
					echo "<input type='image' name='submit' src='images/no.png' value='no' width='30' height='30'/>";
					echo "</from>";
				}
				echo "</td>";
			}
			
		}
		else
		{
			echo "<td><a href='controlpanel.php?act=e&id=";
			echo $row['ID'] ;
			echo " '><img src='images/edit-icon.png' alt='edit' width='30' height='30' /> </a> &nbsp; <a href='controlpanel.php?act=d&id=" ;
			echo $row['ID'] ;
			echo " '><img src='images/DeleteRed.png' alt='delete' width='30' height='30' /></a></td>";
		}		
	}
	echo  "</tr>";


 }while($row = mysql_fetch_array($result));
 
 	if(!isset($_POST['submit']) && isset($_GET['act']) && 	$_GET['act'] == 'a')
	{
	?>
	<form id='form1' name='form1' method='post' action='controlpanel.php?act=a'>
	<tr>
	<td> 
		<input type='text' name ='txtaddtrainnumber'  class="txt" />
	</td>
	<td> 
		<input type='text' name ='txtadddep'  class="txt"/>
	</td>
	<td> 
		<input type='text' name ='txtaddarr'  class="txt"/>
	</td>
	<td> 
		<input type='text' name ='txtadddeptime' />
	</td>
	<td> 
		<input type='text' name ='txtaddarrtime' />
	</td>
	<td> 
		<input type='image' name='submit' src='images/Check.png' value='yes' width='30' height='30'/>
		<input type='image' name='submit' src='images/no.png' value='no' width='30' height='30'/>
	</td>
	</tr>
	</form>
	<?php
	}
 }
 
 
 ?>
</table>
