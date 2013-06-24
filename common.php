<?php

//=---------------------------  NO NEED TO EDIT THIS FILE ----------------------------
/*
	Everything in this file deals with the funtion of the spidergraph application.
	You should only edit the code below if you know what you are doing.
	If you do make changes and the application stops working you can always go back to
	github and grab a current version of this file.
*/
//=------------------------------------------------------------------------------------








	session_start();
	
	require("settings.inc.php"); // DB Settings File
	


//=------------------------------------------------------------------------- SEE IF WE'VE INSTALLED YET
	// Check for our db tables.  If they're not there, forward to install.php
	// Select 1 from table_name will return false if the table does not exist.
	$val = mysql_query('SELECT * FROM `spidergraph_programs`');	
	if($val == FALSE && $_GET['already_run'] != 1)
		{
			// Table isn't there.  Forward to install.php
			// Need already_run=1 so we don't have an endless forward loop
			header("Location: install.php?already_run=1"); 
		}






//=------------------------------------------------------------------------- SESSION VARIABLES
	
	// Set the session variables for user_id and inst_id so we have them everywhere.
	if(!isset($_SESSION['user_id'])) { $_SESSION['user_id'] = 0; }
	if(!isset($_SESSION['inst_id'])) { $_SESSION['inst_id'] = 0; }
	
	
	
	
//=------------------------------------------------------------------------- LOGGED IN?
	// See if we're logged in as an admin
	// If so, user_id won't be 0
	// To use:  is_logged_in();
	
	function is_logged_in() 
		{
			if(isset($_SESSION['user_id']) && $_SESSION['user_id'] > 0)
				{ 
					// Logged in 
				}
			else 
				{ 
					// Not an admin.  Forward away from the admin pages
					header("Location: admin_login.php");
				}
		}



//=------------------------------------------------------------------------- CREATE INSTITUTION ARRAY
	//  Use: echo $institutions[$inst_id] 
	$result_inst = mysql_query("SELECT * FROM institutions");
	while(@$row_inst = mysql_fetch_array($result_inst))
		{
			extract($row_inst);
			$institutions[$inst_id] = $inst_name;
		}



//=------------------------------------------------------------------------- GET USER'S INFO
	// To use: echo $user_info['inst'];
	// We can just echo directly becasue we actually run the function right after we create it.
	// Figure out the user's info so we can display it if we want to.
	function user_info()
		{
			$result_name = mysql_query("SELECT * FROM users WHERE user_id='$_SESSION[user_id]'");
			$row_name = mysql_fetch_array($result_name);
			extract($row_name);
			
			return array(
							   	'name' 	=> $user_name,
								'title' => $user_title,
								'email' => $user_email,
								'phone' => $user_phone,
								'ext'	=> $user_ext,
								'inst'  => $user_institution
							);
		}
	$user_info = @user_info();




//=------------------------------------------------------------------------- ERROR MESSAGE CLASS
	/*
		Usage: <?php $msg->add('s', 'This is a sample Success Message'); ?>
		s = Success - green check
		e = Error - red x
		w = Warning - yellow !
		i = Information - blue ?
		
		Display all messages:
		<?php echo $msg->display(); ?>
		
		Display one type:
		<?php echo $msg->display('e'); // only print error messages ?>
		<?php echo $msg->display('s'); // only print success messages ?>
		<?php echo $msg->display('i'); // only print information messages ?>
		<?php echo $msg->display('w'); // only print warning messages ?>
	*/
	
	require_once("scripts/class.messages.php");
	$msg = new Messages();
	
	// Set a variable so we know there was an error.
	// The session var $msg is killed after the errors are echoed.
	if($msg->hasErrors()) 
		{ $errors = 1; } 

?>