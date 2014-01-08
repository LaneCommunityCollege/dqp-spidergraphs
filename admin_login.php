<?php 
	include("common.php"); 

	// If we're coming from the login form
	if(isset($_POST['Login']) && $_POST['email'] != "" && $_POST['pass'] != "")
		{
			// Clean the user name
			$clean_email = mysql_real_escape_string($_POST['email']);
			// Clean the password
			$clean_pass = mysql_real_escape_string($_POST['pass']);
							
			$result = mysql_query("SELECT * FROM users WHERE user_email='$clean_email'")
					or die("ERROR: ". mysql_error());
			$num = mysql_num_rows($result);
			if($num == 1)
				{
					$row = mysql_fetch_array($result);
					extract($row);
					
					if($user_active == 'y')
						{
							if(crypt($_POST['pass'], $user_pass) == $user_pass)
								{
									$_SESSION['user_id'] = $user_id;
									$_SESSION['inst_id'] = $user_institution;
									
									// We're logged in.  Show a message and go to the admin page.
									$msg->add("s", "You are now logged in.");
									header("Location: admin_index.php"); 
								}
							else
								{
									// We failed the password check.
									// Set the error and redirect back to the login page.
									$msg->add("e", "Password mismatch.  Please try again.");
								}
						}
					else
						{
							// User not active
							$msg->add("e", "User account is inactive.  Please <a href='mailto:danskinem@lanecc.edu'>contact the webmaster</a>
											 if you need some help.");
						}
				}
			else
				{
					// Not logged in.  User/Pass didn't match
					$msg->add("e", "User Name/Password didn't match.  Please try again.");
				}
		}

	include("header.inc.php"); 
?>

	  	<h1>Log In to Spidergraph Admin</h1>
	  	<p>&nbsp;</p>
        <div id="TwoCol_left_50">
        <form id="form1" name="form1" method="post" action="">
	  	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	  	    <tr>
	  	      <td width="28%" align="right">
	  	      	<label for="email"><strong>User Name:</strong></label>
	  	      </td>
	  	      <td width="72%" align="left"><input type="text" name="email" id="email" /> 
	  	        (email address)</td>
  	        </tr>
	  	    <tr>
	  	      <td align="right">
	  	      	<label for="password"><strong>Password:</strong></label>
	  	      </td>
	  	      <td align="left"><input type="password" name="pass" id="pass" /></td>
  	        </tr>
	  	    <tr>
	  	      <td align="right">&nbsp;</td>
	  	      <td align="left"><input type="submit" name="Login" id="button" value="Submit" /></td>
  	        </tr>
  	      </table>
		</form>
</div>

        <div id="TwoCol_right_50">
		<div align="center"><img src="images/Spidergraph-Locked.jpg" width="250" height="240" /></div>
		</div>
	  	<p>&nbsp;</p>




<?php include("footer.inc.php"); ?>
