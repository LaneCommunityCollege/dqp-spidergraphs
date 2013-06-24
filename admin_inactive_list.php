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
	
	if(isset($_GET['action']) && $_GET['action'] == "activate")
		{
			// If we're deleting a Program (there's no crs_id in the link)
			if($_GET['program_id'])
				{
					// Set the program to active
					$update = mysql_query("UPDATE spidergraph_programs SET prog_active='y' WHERE prog_id='$_GET[program_id]'");
				}
		}
	
	
	include("header.inc.php"); 
?>

    	<h1>Inactive Program List</h1>

		<h2 align="center"><?php echo $institutions[$user_info['inst']]; ?></h2>
		<blockquote>
		  <p>	      Below is a list of programs associated with your institution that have been deactivated.  You can re-activate or view/edit a program or course by clicking the appropriate button.
	      </p>
	    </blockquote>
        <div id="TwoCol_left_60">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="67%" align="left" valign="top">
      <ul>
        <h2>Inactive Programs</h2>
		<?php
		$result_programs = mysql_query("SELECT * FROM spidergraph_programs WHERE inst_id = '$user_info[inst]' AND prog_active='n' ORDER BY prog_name");
		while($row_programs = mysql_fetch_array($result_programs))
			{
				extract($row_programs);
				echo "<li>". $prog_name ."
					    <a href='$_SERVER[PHP_SELF]?action=activate&program_id=$prog_id'><img src='$images_url/button_activate_tiny.png' align='right' width='20' height='20' alt='Delete Program' title='Delete' hspace='8' /></a>
						<a href='program_outcomes_report.php?program_id=$prog_id'><img src='$images_url/icon_REPORT.png' align='right' alt='View Report' title='Report' hspace='4' /></a>
					  </li><hr />";
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
