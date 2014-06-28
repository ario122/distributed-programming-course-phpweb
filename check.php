

<noscript><meta http-equiv="refresh" content="1;url=error.html"></noscript>


<?php

if (!isset($_COOKIE['cookietesting']))
{
	setcookie ('cookietesting', 'cookietesting', time() + 60);
	header ('Location: check2.php');
}

?>

