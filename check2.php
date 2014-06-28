

<noscript><meta http-equiv="refresh" content="1;url=error.html"></noscript>


<?php

if (!isset($_COOKIE['cookietesting']))
{
	header ('Location: error.html');
}
else
{
	header ('Location: index.php');
}
?>

