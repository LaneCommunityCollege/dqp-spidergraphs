<?php 
	include("common.php"); 
	is_logged_in();			// See if we're logged in
?>
<?php 
	/*
		Adds a course to the spidergraph_courses table.
		No weights or anything.  Simply attaches a course to an institution so
		it can be chosen later and added to programs.
	*/
	
	
	if(isset($_POST['add_course']) && $_POST['number'] != "" && $_POST['name'] != "")
		{
			// Put the number and name together
			$number_name = $_POST['number'] ." - ". $_POST['name'];
			
			// Clean up the name and comments
			$number_name = htmlentities($number_name, ENT_QUOTES);
			$comments = htmlentities($_POST['comments'], ENT_QUOTES);

			//  Make sure this program isn't already in the db for this institution
			$result = mysql_query("SELECT * FROM spidergraph_courses WHERE inst_id = '$user_info[inst]' AND crs_name = '$number_name'");
			$num = @mysql_num_rows($result);
			if($num > 0)
				{ $msg->add('e', 'A course with this name already exists for '. $institutions[$user_info['inst']] .'.'); }
			else
				{
					// Insert the program into the db
					$insert = mysql_query("INSERT INTO spidergraph_courses (crs_id, inst_id, crs_number, crs_comments)
																VALUES ('', '$user_info[inst]', '$number_name', '$comments')")
														or die(mysql_error());
																
					header("Location: admin_course_to_program.php");
				}
		}
	elseif(isset($_POST['add_course']) && ($_POST['number'] == "" || $_POST['name'] == ""))
		{ $msg->add('e', 'Course Number and Name are required.  Comments/Description are also helpful, but are optional.'); }

	
	
	
	include("header.inc.php"); 
?>
	  	<h1>Create a Course</h1>

		<h2 align="center"><?php echo $institutions[$user_info['inst']]; ?></h2>
		<blockquote>
		  <p>	      This page is for adding courses for your institution.  A simple number, name and description or comments about the course are all that is required.  You will be asked to link this course to a program and add outcomes and weights in that program connection after you submit this very basic information.
	      </p>
	    </blockquote>
		
        <div id="TwoCol_left_60">
        <form id="form1" name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">
		    <tr>
		      <td width="30%" align="right" valign="top"><label for="number"><strong>Course Number</strong></label></td>
		      <td width="70%" align="left" valign="top">
		        <input name="number" type="text" id="number" value="<?php if(isset($_POST['number'])) { echo $_POST['number']; } ?>" size="15" />
	            <span class="text_small">(Something like &quot;BA 151&quot;)</span>
              </td>
	        </tr>
		    <tr>
		      <td align="right" valign="top"><label for="name"><strong>Course Name</strong></label></td>
		      <td align="left" valign="top"><input name="name" type="text" id="name" value="<?php if(isset($_POST['name'])) { echo $_POST['name']; } ?>" size="30" />
		        <br />
              <span class="text_small">(Something like &quot;Practical Accounting&quot;)</span></td>
	        </tr>
		    <tr>
		      <td align="right" valign="top"><label for="comments"><strong>Comments / Description</strong></label></td>
		      <td align="left" valign="top"><textarea name="comments" id="comments" cols="45" rows="5"><?php if(isset($_POST['comments'])) { echo $_POST['comments']; } ?>
	            </textarea></td>
	        </tr>
		    <tr>
		      <td align="right" valign="top">&nbsp;</td>
		      <td align="left" valign="top"><input type="submit" name="add_course" id="button" value="Submit" /></td>
	        </tr>
	      </table>
	    </form>
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
