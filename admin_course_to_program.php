<?php 
	include("common.php"); 
	is_logged_in();			// See if we're logged in
?>
<?php 
		/*
		Adds courses to programs for a particular institution.
		Populates the spidergraph_course_to_program table with weights.
		The weights in that table refer to the weight of a course in that particular program.
		The same course can have multiple weights because it can appear in multiple programs.		
	
		This page also lets you edit and delete courses from a program.
	*/
	
	
	
	// Put the program_id and course_id in a session so we can use them later
	if(isset($_POST['program'])) 
		{ $_SESSION['program_id'] = $_POST['program_id']; }
	if(isset($_POST['course'])) 
		{ $_SESSION['course_id'] = $_POST['course_id']; }
		
	// If we have everything, insert it into the db
	if(isset($_POST['insert']) && $_POST['weight'] != "")
		{
			// See if this program/course is already in the db
			$result = mysql_query("SELECT * FROM spidergraph_course_to_program WHERE
											crs_id = '$_SESSION[course_id]' AND
											prog_id = '$_SESSION[program_id]' AND
											inst_id = '$user_info[inst]'");
			$num = mysql_num_rows($result);
			if($num < 1)
				{ 
					// If it wasn't alreay there, add it to the db
					
					// Check the format of the weight and make sure it's consistent
					if($_POST['weight'] > 1) { $_POST['weight'] = $_POST['weight'] / 100; }
					
					$insert = mysql_query("INSERT INTO spidergraph_course_to_program
												(ctp_id, crs_id, prog_id, inst_id, ctp_weight)
											VALUES('','$_SESSION[course_id]', '$_SESSION[program_id]', '$user_info[inst]', '$_POST[weight]')")
									or die("ERROR: ". mysql_error());
											
					$msg->add('s', 'Course added successfully.');
					
					// Leave the program in case we're adding multiple courses for the same program
					unset($_SESSION['course_id'], $_POST['weight']); 				
				}
			elseif($num == 1)
				{ 
					// If this Program/Course is already in the db, drop the course and weight and show an error
					$msg->add('e', 'Course already present for this program.'); 
					unset($_SESSION['course_id'], $_POST['weight']);				
				}
		
			// Get the total weight for courses in this program
			$result_weight = mysql_query("SELECT SUM(ctp_weight) AS total_weight FROM spidergraph_course_to_program WHERE prog_id='$_SESSION[program_id]'");
			$row_weight = mysql_fetch_assoc($result_weight);
			$total_weight = $row_weight['total_weight']; 
			
			$msg->add('i', $total_weight .'/100 total weight for this program.');	
		}
		
		
		// Update weights from the right column
		if(isset($_POST['update_weight']) && $_POST['ctp_id'] != "")
			{
				if($_POST['new_weight'] > 1) { $_POST['new_weight'] = $_POST['new_weight'] / 100; }
				$result = mysql_query("UPDATE spidergraph_course_to_program SET ctp_weight='$_POST[new_weight]' WHERE ctp_id='$_POST[ctp_id]'");
			}
			
			
		// Delete a course from this program
		if((isset($_GET['action']) && $_GET['action'] == "delete") && (isset($_GET['ctp_id']) && $_GET['ctp_id'] != ""))
			{
				$delete = mysql_query("DELETE FROM spidergraph_course_to_program WHERE ctp_id='$_GET[ctp_id]'");
			}
		

	
	include("header.inc.php"); 
?>
	  	<h1>Add a Course to a Program</h1>

		<div id="TwoCol_left_60">
        <h2>Graph a Course</h2> 
		<p align="center">Institution:&nbsp;&nbsp;&nbsp;<strong><?php echo $institutions[$user_info['inst']]; ?></strong>
        <br />
        Program:&nbsp;&nbsp;&nbsp;<strong> 
        	<?php  
				$result_prog_name = mysql_query("SELECT * FROM spidergraph_programs WHERE prog_id='$_SESSION[program_id]'");
				$row_prog_name = mysql_fetch_array($result_prog_name);
				extract($row_prog_name);
				echo stripslashes($prog_name);
			?>
        </strong></p> 
		<table border="0" cellpadding="0" cellspacing="0">
		  <tr>
		    <td width="50%">
            <h3>Programs</h3>
            <p><img src="images/badge_1.png" alt="Step 1" width="58" height="58" align="left" /><strong><br />
            This form field includes all the PROGRAMS already in the database for <?php echo $institutions[$user_info['inst']]; ?>. 
            If the program you need to map isn't there you will need to <a href="create_program.php">add it here</a>.</strong></p>
            <p>&nbsp;</p>
              <form id="Programs" name="Programs" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#step2">
                <label for="program_id">Program: </label>
                <select name='program_id' id='program_id'>
                  <?php
						// If we haven't already chosen a program...
						if(!isset($_SESSION['program_id']) && !$_SESSION['program_id'])
							{ echo "<option value='' selected='selected'>Choose a Program</option>"; }
						
						$result_prog = mysql_query("SELECT * FROM spidergraph_programs WHERE inst_id='$user_info[inst]' AND prog_active='y' ORDER BY prog_name");
						while($row_prog = mysql_fetch_array($result_prog))
							{
								extract($row_prog);
								
								// If we've already chosen a program, make sure it's selected in the form field
								if(isset($_SESSION['program_id']) && $_SESSION['program_id'] == $prog_id) 
									{ $selected = "selected='selected'"; }
								else { $selected = ""; }
								
								echo "<option value='$prog_id' ". $selected .">". stripslashes($prog_name) ."</option>";
							}
					?>
                </select>
              &nbsp;&nbsp;
              <input type="submit" name="program" id="button" value="Go" />
              </form>
            </td>
	      </tr>
	    </table>
		<p>&nbsp;</p>
        <?php
			if(isset($_SESSION['program_id']))
				{
		?>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
		  <tr>
		    <td><a name="step2"></a><h3>Courses</h3>
              <p><img src="images/badge_2.png" alt="Step 2" width="58" height="58" align="left" /><strong><br />
              This form field includes all the COURSES already in the database for <?php echo $institutions[$user_info['inst']]; ?>. 
              If the course you need to map isn't there you will need to <a href="create_course.php">add it here</a>.</strong></p>
              <p>&nbsp;</p>
              <form id="Courses" name="Courses" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>#step3">
                <label for="course_id">Course: </label>
                <select name='course_id' id='course_id'>
                  <?php
						// If we haven't already chosen a course...
						if(!isset($_SESSION['course_id']) && !$_SESSION['course_id'])
							{ echo "<option value='' selected='selected'>Choose a Course</option>"; }
						
						// Only show courses if we've chosen a program
						$result_crs = mysql_query("SELECT * FROM spidergraph_courses WHERE inst_id='$user_info[inst]' ORDER BY crs_number");
						while($row_crs = mysql_fetch_array($result_crs))
							{
								extract($row_crs);
								
								// If we've already chosen a program, make sure it's selected in the form field
								if(isset($_SESSION['course_id']) && $_SESSION['course_id'] == $crs_id) 
									{ $selected = "selected='selected'"; }
								else { $selected = ""; }  
								
								echo "<option value='$crs_id' $selected>". stripslashes($crs_number) ."</option>";
							}
					?>
                </select>
                  &nbsp;&nbsp;
                  <input type="submit" name="course" id="button" value="Go" />
              </form>
                </td>
	      </tr>
	    </table>
        <?php 
				} 
		?>
<p>&nbsp;</p>
		<?php
			if(isset($_SESSION['program_id']) && isset($_SESSION['course_id']))
				{
		?>
		<table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="10"><a name="step3" id="step3"></a>
              <h3>Weight</h3>
              <p><img src="images/badge_3.png" alt="Step 3" width="58" height="58" align="left" /><strong><br />
              You have chosen a program and a course. Now give this course a weight. </strong><strong>Please remember that weights for courses in this program need to add up to 100%.</strong></p>
              <h3>&nbsp;</h3>
              <form id="Weight" name="Weight" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="weight">Weight: </label>
                <input name="weight" type="text" id="weight" value="<?php if(isset($_POST['weight'])) { echo $_POST['weight']; } ?>" />
                &nbsp;&nbsp;
                <input type="submit" name="insert" id="button" value="Go" />
                <br />
                <span class="text_small">Course weight should look like either .24 or 24. Either way it will be converted to an integer before being saved.</span>
              </form></td>
          </tr>
        </table>
        <?php 
				} 
		?>
		</div>
        <p>&nbsp;</p>
        <div id="TwoCol_right_40">
        
        
        <table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><?php include("admin_menu.inc.php"); ?></td>
          </tr>
        </table>
        <p>&nbsp;</p>
        <h3 align="center">Courses in this Program<!-- Get all the courses from this program and allow editing the weights -->
        </h3>
        <p>Once all courses are added to this program, their total weights should add up to 100. You can adjust weights at any time using the form below, but please only update one weight at a time.</p>
        <table>
          <tr class="text_invert">  
            <td width="37%" bgcolor="#000000">WEIGHT</td>
            <td width="53%" bgcolor="#000000">COURSE <br />              <span class="text_small">(click to add course outcomes)</span></td>
            <td width="10%" bgcolor="#000000">&nbsp;</td>
          </tr>			
        <?php
			$total_prog_weight = 0;  // just set this so I don't get an error later.
			
			$result_all = mysql_query("SELECT * FROM spidergraph_course_to_program WHERE prog_id='$_SESSION[program_id]'");
			while($row_all = mysql_fetch_array($result_all))
				{
					extract($row_all);
					
					// Get the textual course and program names
					$result_prog = mysql_query("SELECT prog_name FROM spidergraph_programs WHERE prog_id='$_SESSION[program_id]' AND inst_id='$user_info[inst]'");
					$row_prog = mysql_fetch_array($result_prog);
					extract($row_prog);
					
					$result_crs = mysql_query("SELECT crs_number FROM spidergraph_courses WHERE crs_id='$crs_id' AND inst_id='$user_info[inst]'");
					$row_crs = mysql_fetch_array($result_crs);
					extract($row_crs);
		?>
          <tr>  
            <td width="37%">
            	<form id="form1" name="form1" method="post" action="">
					<input name="new_weight" type="text" size="3" maxlength="3" value="<?php echo $ctp_weight * 100; ?>" />
                  <input name="ctp_id" type="hidden" id="hiddenField" value="<?php echo $ctp_id; ?>" />
                  <input type="submit" name="update_weight" id="button2" value="Update" />
            	</form>
            </td>
            <td width="53%"><a href="course_outcomes.php?course_id=<?php echo $crs_id; ?>#outcomes"><?php echo $crs_number; ?></a></td>
            <td width="10%"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=delete&amp;ctp_id=<?php echo $ctp_id; ?>"><img src="images/button_delete_tiny.png" width="20" height="20" alt="Delete Button" /></a></td>
          </tr>			
        <?php			
					$total_prog_weight += $ctp_weight; 
				}
		?>
          <tr><td colspan="3"><h2><?php echo $total_prog_weight * 100; ?>/100</h2>
          <span class="text_small">Please make sure this ends up being 100/100 when you're all done with this program.</span></td></tr>
        </table>
        </div>
        <div class="clear"></div>
        
        <p>&nbsp;</p>




<?php include("footer.inc.php"); ?>
