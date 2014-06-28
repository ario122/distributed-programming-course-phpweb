<?php include 'check.php' ?>
<?php
include 'db.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" language="javascript1.5">
function validate_form()
{
	var message = "";

	var name = document.forms["register"]["txtname"].value;
	var email1 = document.forms["register"]["txtemail"].value;
	var email2 = document.forms["register"]["txtemail2"].value;
	var pass1 = document.forms["register"]["txtpass"].value;
	var pass2 = document.forms["register"]["txtpass2"].value;
	var ack = document.forms["register"]["chkack"].checked;

		if (name = "" || name == null)
		{
			message = message + "Enter a valid name <br>";
		}
		if (email1 != email2)
		{
			message = message + "Email addresses do not match <br>";
		}
		if (pass1 != pass2)
		{
			message = message + "Passwords do not match <br>";
		}
		if (pass1 == "" || pass1 ==null)
		{
			message = message + "Passwords do not match <br>";
		}
		
		var x=email1;
		var atpos=x.indexOf("@");
		var dotpos=x.lastIndexOf(".");
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
  		{
 			 message = message + "Please enter a valid email address <br>";
  		}
		
		
		if (!ack)
		{
			message = message + "You should agree with terms of service. <br>";
		}
		document.getElementById('message').innerHTML=message;
		if (message == "")
			return true;
		return false;
}

</script>



<title>  </title>
</head>

<body>
<div id="container">
	   <?php include 'header.php' ?>
       <?php include 'menu.php' ?>
        
		<div id="content">
		
		
	<?php		
		if (isset ($_POST['Submit'])) // if the form was submitted
		{
			connect();
			
			
			$query = "SELECT * FROM users WHERE email = '" . $_POST['txtemail'] . "'";
			
			$r1 = mysql_fetch_array(mysql_query($query));
			if($r1)
			{
				
				header( "Location:signup.php?e=1");
				

			}
			else
			{
			
				$query = "SELECT * FROM users WHERE username = '" . $_POST['txtusername'] . "'";
				
				$r2 = mysql_fetch_array(mysql_query($query));
				if($r2)
				{
					header( "Location:signup.php?e=2" );
									
				}

				else{
			
			
			
			
				$query = "INSERT INTO users(name, email, password, username) VALUES('" . $_POST['txtname'] . "','" . $_POST['txtemail'] . "','" . $_POST['txtpass'] . "','" . $_POST['txtusername'] . "')";
			

	
				$result = mysql_query($query);
				if (!$result)
				{
						echo "Could not execute query: $query\n";
						trigger_error(mysql_error(), E_USER_ERROR); 
				} 	
				else 
				{
?>	
				<div id ="message">
					You are successfully registered. Please log in now. <br /> Redirecting ....
				</div>
<?php
				header( "refresh:2;url=login.php" );
			} 
}}
				
		}
		else
		{
?>	
		
        	<h2>Home</h2>
        	<p>&nbsp;</p>
        	<p>Please fill in the following form in order to register </p>
        	<p>&nbsp;</p>
			<form name="register" action="signup.php" method="post" onsubmit="return validate_form()">
        	<table width="550" border="0" cellspacing="2" cellpadding="4">
			<tr>
			<td colspan="2">
				<div id ="message">
					<?php 		if (isset($_GET['e'])){
									if ($_GET['e'] == 1)
									{
									echo "Email Address already registered.";
									}
									if ($_GET['e'] == 2)
									{
									echo "Username is already taken";
									}
									}
									?>
				</div>
				</td>
			</tr>	
              <tr>
                <td>Name:</td>
                <td><input type="text" name="txtname" /></td>
              </tr>
			  <tr>
                <td>Username:</td>
                <td><input type="text" name="txtusername" /></td>
              </tr>
              <tr>
                <td>Email Address: </td>
                <td><input type="text" name="txtemail" /></td>
              </tr>
              <tr>
                <td>Repeat Email:</td>
                <td><input type="text" name="txtemail2" /></td>
              </tr>
              <tr>
                <td>Password:</td>
                <td><input name="txtpass" type="password"  maxlength="10" /></td>
              </tr>
              <tr>
                <td>Confirm Password: </td>
                <td><input name="txtpass2" type="password" maxlength="10" /></td>
              </tr>
              <tr>
                <td colspan="2">
				<input type="checkbox" name="chkack" />&nbsp;&nbsp;I hereby acknowlegde terms of service </td>
              </tr>
              <tr>
                <td colspan="1">&nbsp;</td>
				<td><div align="right">
				  <input type="submit" name="Submit" value="Submit" />
			    </div></td>
              </tr>
            </table>
			</form>
<?php
}
?>
	<?php include 'footer.php' ?>
            
      </div>
   </div>
</body>
</html>
