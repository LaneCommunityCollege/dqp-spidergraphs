<?php 
	include("common.php"); 
	is_logged_in();			// See if we're logged in
?>
<?php 
	/*
		This page shows a list of programs and courses in the database for
		a particular institution.  
		
		It also links you to the add/edit pages for each and deletes courses and programs.
	*/
	
	if(isset($_GET['action']) && $_GET['action'] == "delete")
		{
			// Add an error message and a way back
			if(!$_GET['confirmed'])
				{
					die("<p>You're about to delete something!  Are you sure?</p>
						<p>If so, <a href='$PHP_SELF?action=delete&confirmed=yes&crs_id=$_GET[crs_id]&program_id=$_GET[program_id]'>CLICK HERE</a> to continue.</p><p>If you didn't mean to delete something, just use your browser's back button.</p>");
				}
				
			// If we're deleting a Program (there's no crs_id in the link)
			if($_GET['program_id'] && $_GET['crs_id'] == "" && $_GET['confirmed'] == 'yes')
				{
					// Set the program to inactive
					$update = mysql_query("UPDATE spidergraph_programs SET prog_active='n' WHERE prog_id='$_GET[program_id]' AND inst_id='$SESSION[inst_id]'");
					// Delete the connections to all courses
					$delete = mysql_query("DELETE FROM spidergraph_course_to_program WHERE prog_id='$_GET[program_id]' AND inst_id='$SESSION[inst_id]'");
				}
				
			// If we're deleting a Course (both crs_id and program_id are set in the link)	
			elseif($_GET['program_id'] > 0 && $_GET['crs_id'] > 0 && $_GET['confirmed'] == 'yes')
				{
					// Delete all connections to this course from this program
					$delete = mysql_query("DELETE FROM spidergraph_course_to_program WHERE crs_id='$_GET[crs_id]' AND prog_id='$_GET[program_id]' AND inst_id='$SESSION[inst_id]'");
				}
		}


	
	include("header.inc.php"); 
?>

    	<h1>Program &amp; Course List</h1>

		<h2 align="center"><?php echo $institutions[$user_info['inst']]; ?></h2>
		<blockquote>
		  <p>	      Below is a list of programs associated with your institution as well as the courses tied to those programs.  Click the name of either a program or a course to view/add/edit its outcomes.
	      </p>
	    </blockquote>
        <div id="TwoCol_left_60">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="67%" align="left" valign="top">
      <ul>
        <?php
		$result_programs = mysql_query("SELECT * FROM spidergraph_programs WHERE inst_id = '$user_info[inst]' AND prog_active='y' ORDER BY prog_name");
		while($row_programs = mysql_fetch_array($result_programs))
			{
				extract($row_programs);
				echo "<li>". $prog_name ."
					    <a href='$_SERVER[PHP_SELF]?action=delete&program_id=$prog_id'><img src='images/button_delete_tiny.png' align='right' width='20' height='20' alt='Delete Program' title='Delete' hspace='8' /></a>
						<a href='program_outcomes.php?program_id=$prog_id#outcomes'><img src='images/icon_EDIT.png' align='right' alt='Edit Outcome' title='Edit' hspace='4' /></a>
						<a href='program_outcomes_report.php?program_id=$prog_id'><img src='images/icon_REPORT.png' align='right' alt='View Report' title='Report' hspace='4' /></a>
					  </li><hr />";
		?>			
        <ul>
          <?php
                    // Get courses associated with this program
					$result_c2p = mysql_query("SELECT * FROM spidergraph_course_to_program WHERE inst_id = '$user_info[inst]' 
																								AND prog_id='$prog_id'");
                    while($row_c2p = mysql_fetch_array($result_c2p))
                        {
                            extract($row_c2p);
                            
							$result_course = mysql_query("SELECT * FROM spidergraph_courses WHERE crs_id='$crs_id'");
							$row_course = mysql_fetch_array($result_course);
							extract($row_course);
							// Get the course name
							echo "<li>". $crs_number ."
					    			<a href='$_SERVER[PHP_SELF]?action=delete&crs_id=$crs_id&program_id=$prog_id'><img src='images/button_delete_tiny.png' align='right' width='20' height='20' alt='Delete Program' title='Delete' hspace='8' /></a>
									<a href='course_outcomes.php?course_id=$crs_id#outcomes'><img src='images/icon_EDIT.png' align='right' alt='Edit Outcome' title='Edit' hspace='4' /></a>
									<a href='course_outcomes_report.php?crs_id=$crs_id'><img src='images/icon_REPORT.png' align='right' alt='View Report' title='Report' hspace='4' /></a>
								  </li><hr />";
                        }
                ?>
          </ul>
        <?php
			}
	?>
        </ul>
      </td>
  </tr>
</table>
</div>

<div id="TwoCol_right_40">
  <table border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td><?php include("admin_menu.inc.php"); ?></td>
    </tr>
  </table>
</div>
<div class="clear"></div>
<p>&nbsp;</p>


<?php include("footer.inc.php"); ?>
