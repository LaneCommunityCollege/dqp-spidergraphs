<?php
	include("common.php");

	function create_table($file)
		{
			$file_content = file($file);
			$query = "";
			foreach($file_content as $sql_line){
				if(trim($sql_line) != "" && strpos($sql_line, "--") === false){
					$query .= $sql_line;
					if (substr(rtrim($query), -1) == ';'){
						//echo $query;
						$result = mysql_query($query)or die(mysql_error());
						$query = "";
				  	}
				}
			}	
		}
	
	if(isset($_POST['install']))
		{
			// Make sure the passwords are both filled in and match and there's an admin email address
			if(isset($_POST['pass']) && $_POST['pass'] != "" && isset($_POST['confirm']) && $_POST['confirm'] != "" && isset($_POST['email']) &&  $_POST['email'] != "")
				{
					if(trim($_POST['pass']) === trim($_POST['confirm']))
						{ 
							// Everything looks right.  Install the Spidergraphs
							
							// Set up the database structure
							$tables = array(
											"spidergraph_course_outcomes",
											"spidergraph_course_to_program",
											"spidergraph_courses",
											"spidergraph_inst_outcomes",
											"spidergraph_program_outcomes",
											"spidergraph_programs",
											"institutions"
											);
							
							// Structure and Data
							if(isset($_POST['sample_data']) && $_POST['sample_data'] == "yes")
								{
									foreach($tables as $table)
										{ create_table("sql/". $table ."_withData.sql"); }
								}
							// Structure Only
							else
								{
									foreach($tables as $table)
										{ create_table("sql/". $table .".sql"); }
								}

							// Protect login email from SQL Injection
							$clean_email = mysql_real_escape_string($_POST['email']);
							
							// Crypt the password and put it in the database
							$crypt_pw = crypt(mysql_real_escape_string($_POST['pass'])); 
							create_table("sql/users.sql");
							$insert = mysql_query("INSERT INTO users (user_id, user_institution, user_name, user_title, user_email, 
														  user_phone, user_ext, user_pass, user_active)
										  			VALUES ('', '0', 'admin', '', '$clean_email', '', '', '$crypt_pw', 'y')");
							
							// Rename the install.php file
							if(!unlink("install.php")) { echo "Install File Not Deleted!"; }
							
							// Set a message and forward to the login page
							$msg->add("i", "<p>Admin Account and Database have been set up and the install.php file has been deleted.</p>
											<p>If you need to reset the database, please upload install.php from the original archive and run it again.</p>
											<p>You may now continue to the <a href='admin_index.php'>Spidergraph Admin</a>.");
							//header("Location: index.php");
						}
					else
						{ $msg->add("e", "Your PASSWORD and CONFIRMATION don't match."); }
				}
			else
				{ $msg->add("e", "Email Address and both Password and Confirmation fields are required."); }
		}	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Untitled Document</title>
	<link href="styles_spidergraph.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="header">
	<img src="images/DQP color logo.png" alt="DQP Logo" width="300" height="103">
</div>
<div class="clear"></div>

<?php echo $msg->display(); ?>
<div id="sg_wrap">
<h2 align="center">This file  sets up the DQP Spidergraph application on your own server. </h2>
<div id="TwoCol_left_50">
	<p>&nbsp;</p>
	<blockquote>
		<p><strong class="big_number">1.</strong> Before you do anything, rename the file: common-sample.php to common.php and edit the top section of common.php to match your server environment.</p>
		<p><span class="big_number">2.</span> Create an admin account with a good, strong password. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="big_number">&rarr;</span></p>
		<p><span class="big_number">3.</span> Decide if you want to pre-populate the database with some data. <br />
	  (You can always delete it later, but if you install the sample data you'll be able to make sure everything works right away.) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="big_number">&rarr;</span></p>
	</blockquote>
</div>

<div id="TwoCol_right_50">
  <form id="form1" name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <blockquote>
      <h1>Environment Setup</h1>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>Admin Email Address: 
        <input type="text" name="email" id="textfield" />
      (Will be your user name)</p>
      <p>Admin Password:
        <input type="password" name="pass" id="pass" />
      </p>
      <p>Confirm Admin Password:
        <input type="password" name="confirm" id="confirm" />
      </p>
      <p>&nbsp;</p>
      <p>Install Sample Data 
        <input name="sample_data" type="checkbox" id="sample_data" value="yes" checked="checked" />
      </p>
      <p>&nbsp;</p>
      <p>
        <input type="submit" name="install" id="button" value="Install Spidergraphs" />
      </p>
    </blockquote>
  </form>

</div>
</div>
</body>
</html>
