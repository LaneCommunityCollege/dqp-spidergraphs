<?php 
	include("common.php"); 
	is_logged_in();			// See if we're logged in
	
	if(isset($_POST["Delete_Sample_Data"]) && (isset($_POST['understood']) && $_POST['understood']  == 'yes'))
		{
			$tables = array(
							"institutions",
							"spidergraph_course_outcomes",
							"spidergraph_course_to_program",
							"spidergraph_courses",
							"spidergraph_inst_outcomes",
							"spidergraph_program_outcomes",
							"spidergraph_programs"
							);
			foreach($tables as $table)
				{
					$delete = mysql_query("TRUNCATE TABLE `$table`");
					header("Location: admin_index.php");
				}
		}
	elseif(isset($_POST["Delete_Sample_Data"]) && (!isset($_POST['understood'])))
		{ $msg->add("e", "Please confirm that you understand that you are about to delete all your data by checking the box to proceed."); }
	
	
	include("header.inc.php"); 
	
?>
        <h1 align="center">Remove Sample Data</h1>
        <p>&nbsp;</p>
        <div id="TwoCol_left_50">
        	<h2 class="red">!!!!!!!!!! WARNING !!!!!!!!!!</h2>
        	<h4>Running this script will delete ALL data in the database except for the users.</h4>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
        	<form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        	  <p align="center">
   	        <input name="understood" type="checkbox" id="understood" value="yes">
   	      I understand and wish to proceed</p>
        	  <p align="center">
        	    <input type="submit" name="Delete_Sample_Data" id="button" value="Delete All Sample Data">
        	  </p>
        	</form>
        	<p>&nbsp;</p>
        	<p>&nbsp;</p>
        </div>
        
        <div id="TwoCol_right_50">
            <?php include("admin_menu.inc.php"); ?>
            <p>&nbsp;</p>
        </div>
<?php include("footer.inc.php"); ?>
