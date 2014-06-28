<?php include 'check.php' ?>
<?php

include 'db.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>  </title>
<script type="text/javascript" language="javascript1.5">
function validate_form()
{
	var message = "";

	var user = document.forms["login"]["txtusername"].value;
	var pass = document.forms["login"]["txtpassword"].value;
	
		if (user==false)
		{
			message = message + "Enter your username <br>";
		}
		if (pass == false)
		{
			message = message + "Enter your password <br>";
		}

		document.getElementById('message').innerHTML=message;
		if (message == "")
			return true;
		return false;
}

</script>

</head>

<body>

<div id="container">
	  <?php include 'header.php' ?>
      <?php include 'menu.php';
	  

	  
	   ?>
        
		<div id="content">
		
		  
		
				  <?php
				  	  if (isset($_SESSION['ID'])) 
					  {
					  
							echo "You are already logged in. </br> You can continue surfing or either use log off.";
					  
					  
					  }
					  else
					  {
				  	if(isset($_POST['Submit']))
					{
						
						
						   		connect();
   		
								$succ = login($_POST['txtusername'],$_POST['txtpassword']);
								
								if ($succ == 1)
								{
										echo "<div id ='message'>";
					  					
										echo "Logging in.....<br> ";
									
										
										echo "Please wait, redirecting....";
										
										if ($_SESSION['username'] == "admin")
											header( "refresh:2;url='controlpanel.php'" );
										else
											header( "refresh:2;url='index.php'" );
					
										echo "</div>";
								
								}
						
						
						
					}
					if(!isset($_POST['Submit']) || $succ != 1)

					{					
				  ?>
				  
				  
        	<h2>Login</h2>
        	<p>&nbsp;</p>
        	<p>Please enter your username and password </p>
        	<p>&nbsp;</p>
        	<form action="login.php" method="post" name="login" id="login" onsubmit="return validate_form()">
              <table width="550" border="0" cellspacing="2" cellpadding="4">
                <tr>
                  <td colspan="2"><div id ="message">
				  
					<?php 
					if(isset($_POST['Submit']) && $succ != 1)
					{
						echo "Username or password is incorrect.";
					}
                	?>
                  </div></td>
                </tr>
                <tr>
                  <td>Username:</td>
                  <td><input type="text" name="txtusername" /></td>
                </tr>
                <tr>
                  <td>Password:</td>
                  <td><input type="password" name="txtpassword" /></td>
                </tr>

                <tr>
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="1">&nbsp;</td>
                  <td><div align="right">
                      <input type="submit" name="Submit" value="Submit" />
                  </div></td>
                </tr>
              </table>
      	  </form>
		  <?php } ?>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
<p>&nbsp;</p>
            
      </div>
	  
	  <?php } ?>
	  	<?php include 'footer.php' ?>
   </div>
</body>
</html>
