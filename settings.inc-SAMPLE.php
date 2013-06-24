<?php

	/*
		This is your settings file.  For now, all this holds is your database connection info.
		That may change at some point, but probably not.		
	*/



	//=------------------------------------------------------------------------- DB CONFIG
		$host="localhost"; 				// Usually localhost
		$database="NAME OF YOUR DB";	// The name of your database
		$user="DB USER NAME";			// User name to connect to your database
		$password="DB PASSWORD";		// Password to connect to your database
		
		$connection = mysql_connect($host,$user,$password)
			or die ("Unable to connect to database server". mysql_error());
		$db = mysql_select_db($database,$connection)
			or die ("Unable to select database". mysql_error());
	


?>