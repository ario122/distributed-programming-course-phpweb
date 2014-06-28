<?php


function connect()
{

		$db = "s196065";
		$link = mysql_connect('localhost', 's196065', 'tersupse');
		if (!$link) {
			die('Could not connect: ' . mysql_error());
		}
		
		$r2 = mysql_select_db($db);

		if (!$r2) {
			echo "Cannot select database\n";
			trigger_error(mysql_error(), E_USER_ERROR); 
		} 		
}

function disconnect()
{	
	mysql_close();
}

function login($user,$pass)
{
		$query = "SELECT ID, password FROM users WHERE username = '" . $user . "' and password='" . $pass . "'";
		//echo $query;
		$result = mysql_query($query);
		$ret = 0;
		if ($result)
			if($row = mysql_fetch_array($result))
			{
				$_SESSION['username']= $user;
				$_SESSION['ID'] = $row['ID'];
				$ret = 1;
			}
		return $ret;	
}

function check_conflict($trainID)
{
$sql = "SELECT trs.trainnumber, trs.arr, trs.dep, trs.deptime, trs.arrtime\n"
    . "FROM\n"
    . " (SELECT trainnumber, arr, dep, deptime, arrtime \n"
    . " FROM users u,trains t,trips tr \n"
    . " WHERE u.username ='" . $_SESSION['username'] . "' \n"
    . " and t.ID = tr.trainID \n"
    . " and tr.userID=u.ID) trs, (SELECT * FROM trains WHERE ID =" . $trainID . ") AS t\n"
    . "WHERE (trs.deptime <= t.deptime AND trs.arrtime >= t.deptime) OR (trs.deptime <= t.arrtime AND trs.arrtime >= t.arrtime) OR (trs.deptime >= t.deptime				 AND trs.arrtime <= t.arrtime) ";
//	echo $sql;
$result = mysql_query($sql);
$r = mysql_fetch_array($result);
return $r;


}

function insert_to_trips($trainID)
{
	$sql= "SELECT ID FROM users WHERE username='" . $_SESSION['username'] . "'";
	$result = mysql_query($sql);
	$r = mysql_fetch_array($result);
	$sql= "INSERT INTO trips (userID, trainID) VALUES (" . $r['ID'] ."," . $trainID . ")";
	$result = mysql_query($sql);
}



?>